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
use App\Mesure;
use App\Galerie;
use App\Commande;
use App\Locations;
use App\LigneCommande;
use App\LigneLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class UserAdminController extends Controller
{
    public function acceuil()
    {
        return view('acceuil');
    }

    public function profile()
    {

         $countadmin=Admin::count();
         $admin=Admin::first();
       
        return view('profile',compact('admin','countadmin'));

    }


        public function Ajoutadmin()
    {

        if(!Auth::guard('admin')->check()) 
          {
             return  redirect()->route('/');           
          }
          else
          {
         
        return view('Ajouter_admin');
    }

    }

            public function Modifieradmin(request $request)
    {

        if(!Auth::guard('admin')->check()) 
          {
             return  redirect()->route('/');           
          }
          else
          {
            $id=$request->id;

               if($id=="")
               {
                $session=Session::get('id');
               }
               else
               {
                session()->forget('id');
                Session()->put('id', $id);
                $session=Session::get('id');      
               }
               $admins=Admin::where('id' , '=', $session)->first();
               //dd($admins);
        return view('Modifier_admin',compact('admins'));
    }

    }


    
  
}