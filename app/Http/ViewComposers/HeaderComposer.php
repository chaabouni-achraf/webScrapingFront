<?php

namespace App\Http\ViewComposers;

use App\Category;
use App\Produit;
use App\User;
use Illuminate\Support\Facades\Auth;

use Illunimate\View\View;
use App\Repositories\UseRepository;

class HeaderComposer{
public function compose($view){

 $matches = ['In_menu'=>1, 'parent_id'=>null];
 $view->with('categories', Category::where($matches)->get());
     // ->with('user',"Auth::user()->id ");
      //->with('us-produits',Produit::where('user_id', "Auth::user()->id ")->get());
      

}


}