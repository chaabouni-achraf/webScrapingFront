<?php

namespace App\Http\Controllers;

use App\Galerie;
use App\Cliente;
use App\Commande;
use App\LigneCommande;
use App\PhotoGalerie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Stevebauman\Location\Facades\Location;
use PDF;
use App;
use Milon\Barcode\DNS1D;
use SoapClient;
use Session;



class CommandeController extends Controller
{

  public function ListCommande()
  {
    if(!Auth::guard('admin')->check()) 
    {
       return  redirect()->route('/');           
    }
    else
    {
      $commandestotal=Commande::count();
      $commandes = DB::select("SELECT * , commandes.id as id_commande , commandes.reference as ref_commande  from    commandes ,clientes 
           WHERE commandes.cliente_id=clientes.id_client ORDER BY `id_commande` DESC");
          
          foreach($commandes as $commande){
            $countArticles=LigneCommande::where('commande_id',$commande->id_commande)->count();
            $commande->countArticle=$countArticles;

           }
      return view('listeCommande', compact('commandes','commandestotal'));
      
      
    }

  }
  public function PDFCommande(Request $request)
  {
    if(!Auth::guard('admin')->check()) 
    {
       return  redirect()->route('/');           
    }
    else
    {  
      $id_commande=$request->id_commande;
        if($id_commande=="")
        {
         $session=Session::get('id_commande');
        }
        else
        {
         session()->forget('id_commande');
         Session()->put('id_commande', $id_commande);
         $session=Session::get('id_commande');      
        }
        $commande1 = Commande::join('clientes', 'commandes.cliente_id', '=', 'clientes.id_client')
        ->select('commandes.*', 'commandes.id as id_commande', 'clientes.*')
        ->where('commandes.id', '=', $session)
        ->first();
      
      $commandestotal=Commande::count();
      $commandes = DB::select("SELECT * , commandes.id as id_commande  from commandes,lignecommandes,galeries,clientes 
           WHERE commandes.id=lignecommandes.commande_id   and lignecommandes.galerie_id=galeries.id_galerie and  commandes.cliente_id=clientes.id_client and commandes.id=$session ORDER BY `id_commande` DESC");
        $totalcommande=Commande::where('id',$session)->first();
      return view('pdf', compact('commandes','commandestotal','commande1','totalcommande'));
      
      
    }

  }
  
  public function AjoutCommande()
  {
    if(!Auth::guard('admin')->check()) 
        {
           return  redirect()->route('/');           
        }
        else
        {
       $clientes=Cliente::get();
      return view('Ajouter_Commande',compact('clientes'));
  }

  }

    
  public function createcommande(Request $request)
  {
    if(!Auth::guard('admin')->check()) 
        {
           return  redirect()->route('/');           
        }
        else
        {
      $total = 0;
      $date_commande=$request->date_commande;
      $cliente_id=$request->cliente_id;
      $commandecreate = Commande::create([
        "cliente_id"=>$cliente_id, 
         "statut"=>'en cours',
         "date_commande"=>$date_commande,
         ]);

         $annee=date('Y');
         $id = $commandecreate->id;
         Commande::where('id','=', $id)
         ->update([
           'reference' => 'CM -'.$annee . '-' . $id,
         ]);
         $lastcommande = Commande::latest('id')->first(); 
         $lastcomm=$lastcommande->id;
         $countnb3=$request->countnb3;

         for ($i = 1; $i <= $countnb3+1; $i++) 
         {

          $critere1= 'critere1_'.$i;
          $crt1=$_POST[$critere1];
          $critere2= 'critere2_'.$i;
          $crt2=$_POST[$critere2];
          $critere3= 'critere3_'.$i;
          $crt3=$_POST[$critere3];
          $critere4= 'critere4_'.$i;
          $crt4=$_POST[$critere4];
          $couleur= 'couleur_'.$i;
          $coul=$_POST[$couleur];
          $description= 'description_'.$i;
          $desc=$_POST[$description];
          $prix= 'prix_'.$i;
          $pri=$_POST[$prix];
          $type= 'type_'.$i;
          $tp=$_POST[$type];
          $date_livraison= 'date_livraison_'.$i;
          $datelivraison=$_POST[$date_livraison];
          $consigne= 'consigne_'.$i;
          $consigneliv=$_POST[$consigne];
          $note= 'note_'.$i;
          $noteliv=$_POST[$note];
          if ($request->file("photo_$i") != null )
          {
          if($photo=$request->file("photo_$i"))
          {
           $file=time()."2$i.".$photo->getClientOriginalExtension();
           $photo->move("images/galerie/",$file);
          $inputs["photo_$i"]=$file;
          }
        }
          $Galeries= Galerie::create([      
            'photo' => $file,
            'critere1' => $crt1,
            'critere2' => $crt2,
            'critere3' => $crt3,
            'critere4' => $crt4,
            'couleur' => $coul,
            'description' => $desc,
            'temporaire' => 'Yes',
            'type' => $tp,
             ]);
             $lastgalerie = Galerie::latest('id_galerie')->first(); 
            $lastgal=$lastgalerie->id_galerie;
            $PhotoGalerie=LigneCommande ::create([
            'commande_id' => $lastcomm,
            'galerie_id' => $lastgal,  
            'description' => $desc,
            'date_livraison' => $datelivraison,
            'consigne' => $consigneliv,
            'note' => $noteliv,
            'prix' => $pri,
            'type' => $tp,
             ]);
             
             $total += $pri;
         }
      
         Commande::where('id', $lastcomm)
         ->update([
            'total'=>$total,  
                 ]);   
         }

         return redirect()->route('ListCommande')
         ->with('success','les informations ont été ajoutée avec succès.');
  }

  
 
  public function ListeArticle(Request $request)
    {
      if(!Auth::guard('admin')->check()) 
      {
         return  redirect()->route('/');           
      }
      else
      {
        $id_commande=$request->id_commande;
        if($id_commande=="")
        {
         $session=Session::get('id_commande');
        }
        else
        {
         session()->forget('id_commande');
         Session()->put('id_commande', $id_commande);
         $session=Session::get('id_commande');      
        }
       $countArticle=DB::select("SELECT COUNT(*) from    lignecommandes ,galeries 
       WHERE lignecommandes.galerie_id=galeries.id_galerie and commande_id=$session ");
       $Articles=DB::select("SELECT *, galeries.id_galerie as id_galerie , lignecommandes.description as descArticle , lignecommandes.id as lignecommandes_id  from    lignecommandes ,galeries 
       WHERE lignecommandes.galerie_id=galeries.id_galerie and commande_id=$session ORDER BY `lignecommandes_id` DESC");
        return view('listeArticle',compact('Articles','countArticle'));
      }
  
    }



   
  
     public function listephotoArticle( Request $request)
     { 
         if(!Auth::guard('admin')->check()) 
           {
              return  redirect()->route('/');           
           }
           else
           {
            $id_galerie=$request->id_galerie;
            if($id_galerie=="")
            {
             $session=Session::get('id_galerie');
            }
            else
            {
             session()->forget('id_galerie');
             Session()->put('id_galerie', $id_galerie);
             $session=Session::get('id_galerie');      
            }
            $CountPhotoGaleries=PhotoGalerie::where('galerie_id','=', $session)->count();
            $PhotoGaleries=PhotoGalerie::where('galerie_id','=', $session)->get();
            return view('PhotoArticle',compact('PhotoGaleries','CountPhotoGaleries'));
           }
          
      }


      
      public function Ajoutphotogalerie1( Request $request)
      { 
          if(!Auth::guard('admin')->check()) 
            {
               return  redirect()->route('/');           
            }
            else
            {
              $id_galerie=$request->id_galerie;
              if($id_galerie=="")
              {
               $session=Session::get('id_galerie');
              }
              else
              {
               session()->forget('id_galerie');
               Session()->put('id_galerie', $id_galerie);
               $session=Session::get('id_galerie');  
              
              }
              $Galeries=Galerie::where('id_galerie','=', $session)->get();    
              return view('Ajouterphotogalerie1',compact('Galeries'));
            }
           
       }


       public function createphotogalerie1(Request $request)
       {
         if(!Auth::guard('admin')->check()) 
             {
                return  redirect()->route('/');           
             }
             else
             {
              $id_galerie=$request->id_galerie;
              if($id_galerie=="")
              {
               $session=Session::get('id_galerie');
              }
              else
              {
               session()->forget('id_galerie');
               Session()->put('id_galerie', $id_galerie);
               $session=Session::get('id_galerie');  
              
              }
              $countnb1=$request->countnb1;
              //dd($request);
              for ($i = 1; $i <= $countnb1+1; $i++) 
              {

               if ($request->file("photo1_$i") != null )
               {
               if($photo1=$request->file("photo1_$i"))
               {
                $file1=time()."2$i.".$photo1->getClientOriginalExtension();
                $photo1->move("images/galerie/",$file1);
               $inputs["photo1_$i"]=$file1;
               }
               $PhotoGalerie= PhotoGalerie::create([
                 'photo1' => $file1,
                 'galerie_id' => $session,  
                  ]);  
             }
             
                   
              }
   
                     return redirect()->route('listephotoArticle')
       ->with('success','les informations ont été ajoutée avec succès.');
   
       }
       }




       public function Ajoutarticle(Request $request)
       {
         if(!Auth::guard('admin')->check()) 
             {
                return  redirect()->route('/');           
             }
             else
             {

              $id_commande=$request->id_commande;
              if($id_commande=="")
              {
               $session=Session::get('id_commande');
              }
              else
              {
               session()->forget('id_commande');
               Session()->put('id_commande', $id_commande);
               $session=Session::get('id_commande');      
              }
              $commande_id=$session;
            
           return view('Ajouter_article',compact('commande_id'));
       }
     
       }
   
       public function createArticle(Request $request)
       {
         if(!Auth::guard('admin')->check()) 
             {
                return  redirect()->route('/');           
             }
             else
             {
              $id_commande=$request->id_commande;
               if ($request->file('photo') != null )
               {
               if($photo=$request->file('photo'))
               {
                $file=time()."1.".$photo->getClientOriginalExtension();
                $photo->move("images/galerie/",$file);
               $inputs['photo']=$file;
               }  
            }
   
                           $Admin= Galerie::create([
                         
                           'photo' => $file,
                           'critere1' => $request['critere1'],
                           'critere2' => $request['critere2'],
                           'critere3' => $request['critere3'],
                           'critere4' => $request['critere4'],
                           'couleur' => $request['couleur'],
                           'description' => $request['description'],
                           'temporaire' => 'Yes',
                           'type' => $request['type'],
                            ]);
                            $lastgalerie = Galerie::latest('id_galerie')->first(); 
                           $lastgal=$lastgalerie->id_galerie;

                           $PhotoGalerie=LigneCommande ::create([
                            'commande_id' => $id_commande,
                            'galerie_id' => $lastgal,  
                            'description' =>$request['description'],
                            'date_livraison' =>$request['date_livraison'] ,
                            'consigne' =>$request['consigne'] ,
                            'note' => $request['note'] ,
                            'prix' =>$request['prix'] ,
                            'type' =>$request['type'],
                             ]);
                             $commande=Commande::where('id',$id_commande)->first();
                             $total=$commande->total;
                             $total1=$total+$request['prix'];
                             Commande::where('id', $id_commande)
                                 ->update([
                                   'total'=>$total1,  
                                  ]);  
                             
   
                            $countnb1=$request->countnb1;
                            //dd($request);
                            for ($i = 1; $i <= $countnb1+1; $i++) 
                            {
   
                             if ($request->file("photo1_$i") != null )
                             {
                             if($photo1=$request->file("photo1_$i"))
                             {
                              $file1=time()."2$i.".$photo1->getClientOriginalExtension();
                              $photo1->move("images/galerie/",$file1);
                             $inputs["photo1_$i"]=$file1;
                             }
                             $PhotoGalerie= PhotoGalerie::create([
                               'photo1' => $file1,
                               'galerie_id' => $lastgal,  
                                ]);  
                           }
                           
                                 
                            }
                          
   
                     return redirect()->route('ListeArticle')
       ->with('success','les informations ont été ajoutée avec succès.');
   
       }
       }





       
    public function ModifierArticle(request $request)
    {

        if(!Auth::guard('admin')->check()) 
          {
             return  redirect()->route('/');           
          }
          else
          {    $lignecommandes_id=$request->lignecommandes_id;
               $id_galerie=$request->id_galerie;
               if($id_galerie=="")
               {
                $session=Session::get('id_galerie');
               }
               else
               {
                session()->forget('id_galerie');
                Session()->put('id_galerie', $id_galerie);
                $session=Session::get('id_galerie');      
               }

               if($lignecommandes_id=="")
               {
                $session1=Session::get('lignecommandes_id');
               }
               else
               {
                session()->forget('lignecommandes_id');
                Session()->put('lignecommandes_id', $lignecommandes_id);
                $session1=Session::get('lignecommandes_id');      
               }
               $galerie=DB::select("SELECT *, galeries.id_galerie as id_galerie , lignecommandes.description as descArticle , lignecommandes.id as lignecommandes_id  from    lignecommandes ,galeries 
               WHERE lignecommandes.galerie_id=galeries.id_galerie and galeries.id_galerie=$session and lignecommandes.id=$session1 ");
              // dd($galerie);
              //$lignecommande=LigneCommande::where('galerie_id' , '=', $session)->where('id' , '=', $session1)->first();
              // $galerie=Galerie::where('id_galerie' , '=', $session)->first();
        return view('Modifier_Article',compact('galerie'));
    }
    }

    public function UpdateArticle(request $request)
    {

        if(!Auth::guard('admin')->check()) 
          {
             return  redirect()->route('/');           
          }
          else
          {
            $commande_id=$request->commande_id;
            $id_galerie=$request->id_galerie;
            $lignecommandes_id=$request->lignecommandes_id;
            if($id_galerie=="")
            {
             $session=Session::get('id_galerie');
            }
            else
            {
             session()->forget('id_galerie');
             Session()->put('id_galerie', $id_galerie);
             $session=Session::get('id_galerie');      
            }
            if($lignecommandes_id=="")
            {
             $session1=Session::get('lignecommandes_id');
            }
            else
            {
             session()->forget('lignecommandes_id');
             Session()->put('lignecommandes_id', $lignecommandes_id);
             $session1=Session::get('lignecommandes_id');      
            }
               if ($request->file('photo') != null )
               {
               if($photo=$request->file('photo'))
               {
                $file=time()."1.".$photo->getClientOriginalExtension();
                $photo->move("images/galerie/",$file);
               $inputs['photo']=$file;
               }  
               }
               else{
                 $photo=Galerie::where('id_galerie','=', $session)->first();
                 $file=$photo->photo;
               }

                Galerie::where('id_galerie','=', $session)
                    ->update([
                       'photo' => $file,
                       'critere1' => $request['critere1'],
                       'critere2' => $request['critere2'],
                       'critere3' => $request['critere3'],
                       'critere4' => $request['critere4'],
                       'couleur' => $request['couleur'],
                       'description' => $request['description'],
                       'temporaire' => 'Yes',
                       'type' => $request['type'],
                        ]);
                     $lignecommande=LigneCommande ::where('id','=', $session1)->where('galerie_id','=', $session)->first();
                     $prix1=$lignecommande->prix;
                       $PhotoGalerie=LigneCommande ::where('id','=', $session1)
                       ->update([
                        'commande_id' => $commande_id,
                        'galerie_id' => $session,  
                        'description' =>$request['description'],
                        'date_livraison' =>$request['date_livraison'] ,
                        'consigne' =>$request['consigne'] ,
                        'note' => $request['note'] ,
                        'prix' =>$request['prix'] ,
                        'type' =>$request['type'],
                         ]);
                         $commande=Commande::where('id',$commande_id)->first();
                         $total=$commande->total;
                         $total1=($total-$prix1)+$request['prix'];
                         Commande::where('id', $commande_id)
                             ->update([
                               'total'=>$total1,  
                              ]);  
                          return redirect()->route('ListeArticle')
    ->with('success','les information a été modifié avec succès.');
    }

    }

    public function destroyArticle( Request $request)
    { 
        if(!Auth::guard('admin')->check()) 
          {
             return  redirect()->route('/');           
          }
          else
          {
            $id_galerie=$request->id_galerie;
            $lignecommandes_id=$request->lignecommandes_id;
            if($id_galerie=="")
            {
             $session=Session::get('id_galerie');
            }
            else
            {
             session()->forget('id_galerie');
             Session()->put('id_galerie', $id_galerie);
             $session=Session::get('id_galerie');      
            }
          
            if($lignecommandes_id=="")
            {
             $session1=Session::get('lignecommandes_id');
            }
            else
            {
             session()->forget('lignecommandes_id');
             Session()->put('lignecommandes_id', $lignecommandes_id);
             $session1=Session::get('lignecommandes_id');      
            }
            $lignecommande= LigneCommande::where('id', $session1)->first();
            $prix1=$lignecommande->prix;
            $commande_id=$lignecommande->commande_id;
            $commande=Commande::where('id',$commande_id)->first();
            $total=$commande->total;
            $total1=$total-$prix1;
            Commande::where('id', $commande_id)
                ->update([
                  'total'=>$total1,  
                 ]);  
               Galerie::where('id_galerie', $session)
               ->delete();
               LigneCommande::where('id', $session1)
               ->delete();
    return redirect()->route('ListeArticle')->with('success','les information ont été supprimé avec succès.');
          }
    }

    public function ajouterArticleGalerie( Request $request)
    { 
        if(!Auth::guard('admin')->check()) 
          {
             return  redirect()->route('/');           
          }
          else
          {
            $id_galerie=$request->id_galerie;
            if($id_galerie=="")
            {
             $session=Session::get('id_galerie');
            }
            else
            {
             session()->forget('id_galerie');
             Session()->put('id_galerie', $id_galerie);
             $session=Session::get('id_galerie');      
            }

            Galerie::where('id_galerie', $session)
            ->update([
              'temporaire'=>'No',  
             ]);  
             
    return redirect()->route('ListeArticle')->with('success','les information ont été supprimé avec succès.');
          }
    }


    
    public function destroyphotogalerie1( Request $request)
    { 
        if(!Auth::guard('admin')->check()) 
          {
             return  redirect()->route('/');           
          }
          else
          {
            $id=$request->id;
            $id_galerie=$request->id_galerie;
           if($id_galerie=="")
           {
            $session=Session::get('id_galerie');
           }
           else
           {
            session()->forget('id_galerie');
            Session()->put('id_galerie', $id_galerie);
            $session=Session::get('id_galerie');  
           
           }
          
               PhotoGalerie::where('id', $id)->where('galerie_id', $session)
               ->delete();
    return redirect()->route('listephotoArticle')->with('success','les information ont été supprimé avec succès.');
          }
    }

   


    public function Modifierphotogalerie1(request $request)
    {

        if(!Auth::guard('admin')->check()) 
          {
             return  redirect()->route('/');           
          }
          else
          {
           $id=$request->id;
               $id_galerie=$request->id_galerie;
               if($id_galerie=="")
               {
                $session=Session::get('id_galerie');
               }
               else
               {
                session()->forget('id_galerie');
                Session()->put('id_galerie', $id_galerie);
                $session=Session::get('id_galerie');      
               }
               $galerie=PhotoGalerie::where('galerie_id' , '=', $session)->where('id', $id)->first();
        return view('Modifier_photo_galerie1',compact('galerie'));
    }
    }

    public function Updatephotogalerie1(request $request)
    {

        if(!Auth::guard('admin')->check()) 
          {
             return  redirect()->route('/');           
          }
          else
          {
            $id=$request->id;
            $id_galerie=$request->id_galerie;
            if($id_galerie=="")
            {
             $session=Session::get('id_galerie');
            }
            else
            {
             session()->forget('id_galerie');
             Session()->put('id_galerie', $id_galerie);
             $session=Session::get('id_galerie');      
            }
               if ($request->file('photo1') != null )
               {
               if($photo=$request->file('photo1'))
               {
                $file=time()."3.".$photo->getClientOriginalExtension();
                $photo->move("images/galerie/",$file);
               $inputs['photo1']=$file;
               }  
               }
               else{

                 $photo=PhotoGalerie::where('galerie_id' , '=', $session)->where('id', $id)->first();
                 $file=$photo->photo1;
               }

               PhotoGalerie::where('galerie_id' , '=', $session)->where('id', $id)
            ->update([
              'photo1' => $file,
             
              ]);
                          return redirect()->route('listephotoArticle')
    ->with('success','les information a été modifié avec succès.');
    }

    }

}


    



   
