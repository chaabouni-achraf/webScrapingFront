<?php

use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Route::resource('Info-fournisseur','InfoFournisseursController');

Route::match(['get', 'post'],'/acceuil',"UserAdminController@acceuil")->name('acceuil');
Route::match(['get', 'post'],'/recherche',"UserAdminController@recherche")->name('recherche');
Route::match(['get', 'post'],'/Profile',"UserAdminController@profile")->name('profile');
Route::match(['get', 'post'],'/Profile1',"UserAdminController@profile1")->name('profile1');







Auth::routes();

Route::get('/',"Auth\LoginController@showAdminLoginForm")->name('/');
Route::get('/register/admin',"Auth\RegisterController@showAdminRegisterForm")->name('register/admin');
Route::post('/login/admin',"Auth\LoginController@adminLogin");
Route::post('/register/admin', "Auth\RegisterController@createAdmin");





