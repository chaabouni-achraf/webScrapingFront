<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Input;
use App\Role;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
//use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;

class RegisterfrsController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            //'Email' => ['required', 'string', 'Email', 'max:255', 'unique:users'],
            'phone' => ['required', 'integer', 'unique:users'],
            'Password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {



        dd($data);
          $phone=$data['phone'];
          $userphone=User::where('phone', '=',$phone);
        if ($userphone->count()!=0) {
        return redirect()->route('login')
        ->with('success','produit mis à jour avec succès');
       }
      
     else{


        $avatar='photo.jpg';
        $user= User::create([
            'name' => $data['name'],
            'email' => $data['Email'],
            'phone' => $data['phone'],
            'avatar' => $avatar,
            //'password' => Hash::make($data['Password']),
            'password' => Hash::make($data['Password']),
            'motdepasse' => $data['Password'],
        ]);
          $role = Role::select('id')->where ('name', 'frs')->first();
        $user->roles()->attach($role);
        return $user;
    }
    }

   
}
