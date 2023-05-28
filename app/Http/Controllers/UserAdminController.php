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
use GuzzleHttp\Client;

class UserAdminController extends Controller
{
    public function acceuil()
    {
        $client = new Client();
        $key = "cellphone";
        $response = $client->get('http://localhost:3000/scraping/'. $key);
        $data = json_decode($response->getBody(), true);
        return view('acceuil',compact('data'));
    }

 

    public function profile()
    {
        $countadmin = Admin::count();
        $admin = Admin::first();

        return view('profile', compact('admin', 'countadmin'));
    }

   

    
    public function recherche()
    {

        $search=$request->search;
        dd($search);
        $client = new Client();
        $response = $client->get('http://localhost:3000/scrapingFilter/'. $search);
        $data = json_decode($response->getBody(), true);
        return view('acceuil',compact('data'));
    }
   

}
