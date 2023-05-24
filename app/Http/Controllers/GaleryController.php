<?php

namespace App\Http\Controllers;

use App\User;
use App\Contact;
use App\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Session;
use App\Admin;
use App\Cliente;
use App\PhotoGalerie;
use App\Mesure;
use App\Galerie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;


class GaleryController extends Controller
{
    public function ListGalery()
    {
      if(!Auth::guard('admin')->check()) 
      {
         return  redirect()->route('/');           
      }
      else
      {
        $galerietotal= DB::table('galeries')->where('type','Loc')->where('temporaire','No')->where('suppression','No')->count();
        $galeries=DB::table('galeries')->where('type','Loc')->where('temporaire','No')->where('suppression','No')->get();
         return view('listegalerie',compact('galeries','galerietotal'));
      }
  
    }

    public function Ajoutgalerie()
    {
      if(!Auth::guard('admin')->check()) 
          {
             return  redirect()->route('/');           
          }
          else
          {
         
        return view('Ajouter_galerie');
    }
  
    }

    public function creategalerie(Request $request)
    {
      if(!Auth::guard('admin')->check()) 
          {
             return  redirect()->route('/');           
          }
          else
          {
           
            if ($request->file('photo') != null )
            {
            if($photo=$request->file('photo'))
            {
             $file=time()."1.".$photo->getClientOriginalExtension();
             $photo->move("images/galerie/",$file);
            $inputs['photo']=$file;
            }  
         }

              $Galeriee= Galerie::create([
                      
                        'photo' => $file,
                        'critere1' => $request['critere1'],
                        'critere2' => $request['critere2'],
                        'critere3' => $request['critere3'],
                        'critere4' => $request['critere4'],
                        'couleur' => $request['couleur'],
                        'description' => $request['description'],
                    
                         ]);
                         $annee=date('Y');
                         $id = $Galeriee->id;
                         Galerie::where('id_galerie','=', $id)
                         ->update([
                           'reference' => 'MD -'.$annee . '-' . $id,
                         ]);

                         $lastgalerie = Galerie::latest('id_galerie')->first(); 
                        $lastgal=$lastgalerie->id_galerie;

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
                       

                  return redirect()->route('ListGalery')
    ->with('success','les informations ont été ajoutée avec succès.');

    }
    }


    public function Modifiergalerie(request $request)
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
               $galerie=Galerie::where('id_galerie' , '=', $session)->first();
        return view('Modifier_galerie',compact('galerie'));
    }
    }

    public function GalerieModifier(request $request)
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
              ]);
                          return redirect()->route('ListGalery')
    ->with('success','les information a été modifié avec succès.');
    }

    }

    public function destroygalerie( Request $request)
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
                'suppression'=> 'Yes',
             ]);
    return redirect()->route('ListGalery')->with('success','les information ont été supprimé avec succès.');
          }
    }


    public function Galeries( Request $request)
    { 
        if(!Auth::guard('admin')->check()) 
          {
             return  redirect()->route('/');           
          }
          else
          {
            $galeries=Galerie::where('type','Loc')->where('temporaire','No')->where('suppression','No')->get();
          }
          return view('Galerie',compact('galeries'));
     }
     public function listephotogalerie( Request $request)
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
            return view('PhotoGalerie',compact('PhotoGaleries','CountPhotoGaleries'));
           }
          
      }

      public function Ajoutphotogalerie( Request $request)
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
              return view('Ajouterphotogalerie',compact('Galeries'));
            }
           
       }


       public function createphotogalerie(Request $request)
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
   
                     return redirect()->route('listephotogalerie')
       ->with('success','les informations ont été ajoutée avec succès.');
   
       }
       }



       public function destroyphotogalerie( Request $request)
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
       return redirect()->route('listephotogalerie')->with('success','les information ont été supprimé avec succès.');
             }
       }

      


       public function Modifierphotogalerie(request $request)
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
           return view('Modifier_photo_galerie',compact('galerie'));
       }
       }
   
       public function Updatephotogalerie(request $request)
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
                             return redirect()->route('listephotogalerie')
       ->with('success','les information a été modifié avec succès.');
       }
   
       }
   
}
