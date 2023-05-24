<?php

namespace App\Http\Controllers;

use App\Galerie;
use App\Cliente;
use App\Locations;
use App\LigneLocation;
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



class LocationController extends Controller
{

  public function ListLocation()
  {
    if(!Auth::guard('admin')->check()) 
    {
       return  redirect()->route('/');           
    }
    else
    {
      $locationstotal=Locations::count();
      $locations = DB::select("SELECT * , locations.id as id_location ,locations.reference as ref_location  from    locations ,clientes 
           WHERE locations.cliente_id=clientes.id_client ORDER BY `id_location` DESC");
          
          foreach($locations as $location){
            $countModeles=LigneLocation::where('location_id',$location->id_location)->count();
            $location->countModele=$countModeles;

           }
      return view('listeLocation', compact('locations','locationstotal'));
      
      
    }

  }
  public function PDFLocation(Request $request)
  {
    if(!Auth::guard('admin')->check()) 
    {
       return  redirect()->route('/');           
    }
    else
    {  
      $id_location=$request->id_location;
        if($id_location=="")
        {
         $session=Session::get('id_location');
        }
        else
        {
         session()->forget('id_location');
         Session()->put('id_location', $id_location);
         $session=Session::get('id_location');      
        }
        $location1 = Locations::join('clientes', 'locations.cliente_id', '=', 'clientes.id_client')
        ->select('locations.*', 'locations.id as id_location', 'clientes.*')
        ->where('locations.id', '=', $session)
        ->first();
      
      $locationstotal=Locations::count();
      $locations = DB::select("SELECT * , locations.id as id_location  from locations,lignelocations,galeries,clientes 
           WHERE locations.id=lignelocations.location_id   and lignelocations.galerie_id=galeries.id_galerie and  locations.cliente_id=clientes.id_client and locations.id=$session ORDER BY `id_location` DESC");
      $totallocation=Locations::where('id',$session)->first();

         
      return view('pdf_location', compact('locations','locationstotal','location1','totallocation'));
      
      
    }

  }
  
  public function AjoutLocation()
  {
    if(!Auth::guard('admin')->check()) 
        {
           return  redirect()->route('/');           
        }
        else
        {
       $clientes=Cliente::get();
       $Galeries=Galerie::where('type','Loc')->where('temporaire','No')->where('suppression','No')->get();
      return view('Ajouter_Location',compact('clientes','Galeries'));
  }

  }

    
  public function createLocation(Request $request)
  {
    if(!Auth::guard('admin')->check()) 
        {
           return  redirect()->route('/');           
        }
        else
        {
      $total = 0;
      $Accompte=$request->Accompte;
      $cliente_id=$request->cliente_id;
      $locationcreate = Locations::create([
        "cliente_id"=>$cliente_id, 
         "statut"=>'en cours',
         "Accompte"=>$Accompte,

         ]);
         $annee=date('Y');
         $id = $locationcreate->id;
         Locations::where('id','=', $id)
         ->update([
           'reference' => 'LOC -'.$annee . '-' . $id,
         ]);
         $lastlocation = Locations::latest('id')->first(); 
         $lastloc=$lastlocation->id;
         $countnb3=$request->countnb3;

         for ($i = 1; $i <= $countnb3+1; $i++) 
         {

          $galerie_id= 'galerie_id_'.$i;
          $galerie=$_POST[$galerie_id];
          $description_loc= 'description_loc_'.$i;
          $description_location=$_POST[$description_loc];
          $date_location= 'date_location_'.$i;
          $date_loc=$_POST[$date_location];
          $date_livraison= 'date_livraison_'.$i;
          $date_liv=$_POST[$date_livraison];
          $prix= 'prix_'.$i;
          $pri=$_POST[$prix];

          $loc_prenom= 'loc_prenom_'.$i;
          $prenom=$_POST[$loc_prenom];
          $loc_name= 'loc_name_'.$i;
          $name=$_POST[$loc_name];
         
          $date_livraison_reel= 'date_livraison_reel_'.$i;
          $date_livraison_reel1=$_POST[$date_livraison_reel];
          $Adresse_livraison= 'Adresse_livraison_'.$i;
          $lieu=$_POST[$Adresse_livraison];
          $date_retoure= 'date_retoure_'.$i;
          $date_ret=$_POST[$date_retoure];
          $retourne= 'retourne_'.$i;
          $retour=$_POST[$retourne];
          $garantie_reser= 'garantie_reser_'.$i;
          $garantie_res=$_POST[$garantie_reser];
          $garantie_livrai= 'garantie_livrai_'.$i;
          $garantie_liv=$_POST[$garantie_livrai];
          $note= 'note_'.$i;
          $noteliv=$_POST[$note];
     
     
            $Lignelocation=Lignelocation ::create([
            'location_id' => $lastloc,
            'galerie_id' => $galerie,  
            'description_loc' => $description_location,
            'date_location' => $date_loc,
            'date_livraison' => $date_liv,
            'prix' => $pri,
            'loc_prenom' => $prenom,
            'loc_name' => $name,
            'date_livraison_reel' => $date_livraison_reel1,
            'Adresse_livraison' => $lieu,
            'date_retoure' => $date_ret,
            'retourne' => $retour,
            'garantie_reser' => $garantie_res,
            'garantie_livrai' => $garantie_liv,
            'note' => $noteliv,
             ]);
             
             $total += $pri;
         }
      
         Locations::where('id', $lastloc)
         ->update([
            'total'=>$total, 
            'reste'=>$total - $Accompte, 
             
                 ]);   
         }

         return redirect()->route('ListLocation')
         ->with('success','les informations ont été ajoutée avec succès.');
  }

  
 
  public function ListeModeleLocation(Request $request)
    {
      if(!Auth::guard('admin')->check()) 
      {
         return  redirect()->route('/');           
      }
      else
      {
        $id_location=$request->id_location;
        if($id_location=="")
        {
         $session=Session::get('id_location');
        }
        else
        {
         session()->forget('id_location');
         Session()->put('id_location', $id_location);
         $session=Session::get('id_location');      
        }
       $countModele=DB::select("SELECT COUNT(*) from    lignelocations ,galeries 
       WHERE lignelocations.galerie_id=galeries.id_galerie and location_id=$session ");
       $Modeles=DB::select("SELECT *, galeries.id_galerie as id_galerie , lignelocations.id as lignelocation_id  from    lignelocations ,galeries 
       WHERE lignelocations.galerie_id=galeries.id_galerie and location_id=$session ORDER BY `lignelocation_id` DESC");
        return view('listeModeleLocation',compact('Modeles','countModele'));
      }
  
    }



   
  
     public function listephotoModeleLocation( Request $request)
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
            return view('PhotoLocation',compact('PhotoGaleries','CountPhotoGaleries'));
           }
          
      }


      
      public function Ajoutphotogalerie11( Request $request)
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
              return view('Ajouterphotogalerie11',compact('Galeries'));
            }
           
       }


       public function createphotogalerie11(Request $request)
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
   
                     return redirect()->route('listephotoModeleLocation')
       ->with('success','les informations ont été ajoutée avec succès.');
   
       }
       }




       public function AjoutModeleLocation(Request $request)
       {
         if(!Auth::guard('admin')->check()) 
             {
                return  redirect()->route('/');           
             }
             else
             {

              $id_location=$request->id_location;
        if($id_location=="")
        {
         $session=Session::get('id_location');
        }
        else
        {
         session()->forget('id_location');
         Session()->put('id_location', $id_location);
         $session=Session::get('id_location');      
        }
              $id_location=$session;
              $Galeries=Galerie::where('type','Loc')->where('temporaire','No')->where('suppression','No')->get();
            
           return view('Ajouter_Modele_location',compact('id_location','Galeries'));
       }
     
       }
   
       public function createModeleLocation(Request $request)
       {
         if(!Auth::guard('admin')->check()) 
             {
                return  redirect()->route('/');           
             }
             else
             {
              $id_location=$request->id_location;
            
             $total=0;
                          
              $countnb3=$request->countnb3;

              for ($i = 1; $i <= $countnb3+1; $i++) 
              {
     
               $galerie_id= 'galerie_id_'.$i;
               $galerie=$_POST[$galerie_id];
               $description_loc= 'description_loc_'.$i;
               $description_location=$_POST[$description_loc];
               $date_location= 'date_location_'.$i;
               $date_loc=$_POST[$date_location];
               $date_livraison= 'date_livraison_'.$i;
               $date_liv=$_POST[$date_livraison];
               $prix= 'prix_'.$i;
               $pri=$_POST[$prix];
     
               $loc_prenom= 'loc_prenom_'.$i;
               $prenom=$_POST[$loc_prenom];
               $loc_name= 'loc_name_'.$i;
               $name=$_POST[$loc_name];
              
               $date_livraison_reel= 'date_livraison_reel_'.$i;
               $date_livraison_reel1=$_POST[$date_livraison_reel];
               $Adresse_livraison= 'Adresse_livraison_'.$i;
               $lieu=$_POST[$Adresse_livraison];
               $date_retoure= 'date_retoure_'.$i;
               $date_ret=$_POST[$date_retoure];
               $retourne= 'retourne_'.$i;
               $retour=$_POST[$retourne];
               $garantie_reser= 'garantie_reser_'.$i;
               $garantie_res=$_POST[$garantie_reser];
               $garantie_livrai= 'garantie_livrai_'.$i;
               $garantie_liv=$_POST[$garantie_livrai];
               $note= 'note_'.$i;
               $noteliv=$_POST[$note];
          
          
                 $Lignelocation=Lignelocation ::create([
                 'location_id' => $id_location,
                 'galerie_id' => $galerie,  
                 'description_loc' => $description_location,
                 'date_location' => $date_loc,
                 'date_livraison' => $date_liv,
                 'prix' => $pri,
                 'loc_prenom' => $prenom,
                 'loc_name' => $name,
                 'date_livraison_reel' => $date_livraison_reel1,
                 'Adresse_livraison' => $lieu,
                 'date_retoure' => $date_ret,
                 'retourne' => $retour,
                 'garantie_reser' => $garantie_res,
                 'garantie_livrai' => $garantie_liv,
                 'note' => $noteliv,
                  ]);
                  
                  $total += $pri;
              }
              $location=Locations::where('id',$id_location)->first();
              $total1=$location->total;
              Locations::where('id', $id_location)
              ->update([
                 'total'=>$total1+$total, 
                 
                      ]); 
                          
   
                     return redirect()->route('ListLocation')
       ->with('success','les informations ont été ajoutée avec succès.');
   
       }
       }





       
    public function ModifierModeleLocation(request $request)
    {

        if(!Auth::guard('admin')->check()) 
          {
             return  redirect()->route('/');           
          }
          else
          {    $lignelocation_id=$request->lignelocation_id;
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

               if($lignelocation_id=="")
               {
                $session1=Session::get('lignelocation_id');
               }
               else
               {
                session()->forget('lignelocation_id');
                Session()->put('lignelocation_id', $lignelocation_id);
                $session1=Session::get('lignelocation_id');      
               }
              
               $galerie=DB::select("SELECT *, galeries.id_galerie as id_galerie , lignelocations.id as lignelocation_id  from    lignelocations ,galeries 
               WHERE lignelocations.galerie_id=galeries.id_galerie and galeries.id_galerie=$session and lignelocations.id=$session1 ");
               $Galeries=Galerie::where('type','Loc')->where('temporaire','No')->where('suppression','No')->where('id_galerie','!=',$session)->get();

        return view('Modifier_Modele_location',compact('galerie','Galeries'));
    }
    }

    public function UpdateModeleLocation(request $request)
    {

        if(!Auth::guard('admin')->check()) 
          {
             return  redirect()->route('/');           
          }
          else
          {
            $location_id=$request->location_id;
            $id_galerie=$request->id_galerie;
            $lignelocation_id=$request->lignelocation_id;
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
            if($lignelocation_id=="")
            {
             $session1=Session::get('lignelocation_id');
            }
            else
            {
             session()->forget('lignelocation_id');
             Session()->put('lignelocation_id', $lignelocation_id);
             $session1=Session::get('lignelocation_id');      
            }
          

                LigneLocation::where('galerie_id','=', $session)->where('location_id','=', $location_id)->where('id','=', $session1)
                    ->update([
                      'description_loc' => $request['description_loc'],
                      'date_location' => $request['date_location'],
                      'date_livraison' => $request['date_livraison'],
                      'prix' => $request['prix'],
                      'loc_prenom' => $request['loc_prenom'],
                      'loc_name' => $request['loc_name'],
                      'date_livraison_reel' => $request['date_livraison_reel'],
                      'Adresse_livraison' => $request['Adresse_livraison'],
                      'date_retoure' => $request['date_retoure'],
                      'retourne' => $request['retourne'],
                      'garantie_reser' => $request['garantie_reser'],
                      'garantie_livrai' => $request['garantie_livrai'],
                      'note' => $request['note'],
                        ]);
                     $lignelocation=lignelocation ::where('id','=', $session1)->where('galerie_id','=', $session)->first();
                     $prix1=$lignelocation->prix;
                      
                         $location=Locations::where('id',$location_id)->first();
                         $total=$location->total;
                         $total1=($total-$prix1)+$request['prix'];
                         Locations::where('id', $location_id)
                             ->update([
                               'total'=>$total1,  
                              ]);  
                          return redirect()->route('ListeModeleLocation')
    ->with('success','les information a été modifié avec succès.');
    }

    }

    public function destroyModeleLocation( Request $request)
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
    return redirect()->route('ListeModeleLocation')->with('success','les information ont été supprimé avec succès.');
          }
    }

    public function ajouterModeleLocationGalerie( Request $request)
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
             
    return redirect()->route('listephotoModeleLocation')->with('success','les information ont été supprimé avec succès.');
          }
    }


    
    public function destroyphotogalerie11( Request $request)
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
    return redirect()->route('listephotoModeleLocation')->with('success','les information ont été supprimé avec succès.');
          }
    }

   


    public function Modifierphotogalerie11(request $request)
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
        return view('Modifier_photo_galerie11',compact('galerie'));
    }
    }

    public function Updatephotogalerie11(request $request)
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
                          return redirect()->route('listephotoModeleLocation')
    ->with('success','les information a été modifié avec succès.');
    }

    }



    public function FetchDate(Request $request)
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('/');
        }
    
        $lignes_locations = LigneLocation::all();
        return response()->json($lignes_locations);

    }
}


    



   
