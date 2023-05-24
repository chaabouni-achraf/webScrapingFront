<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class LocalizationController extends Controller
{
    public function getLang() {
    	dd(App::getLocale());
        return \App::getLocale();
    }

    public function setLang($lang){
        \Session::put('lang', $lang);

        return redirect()->back();
    }
}
