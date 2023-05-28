<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request ;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Fournisseur;
use Illuminate\Support\Facades\Auth;
use App\Createur;
use GuzzleHttp\Client;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
    }

    public function showAdminLoginForm()
    {
        $client = new Client();
        $key = "cellphone";
        $response = $client->get('http://localhost:3000/scraping/'. $key);
        $data = json_decode($response->getBody(), true);

        return view('acceuil', ['url' => 'admin'],compact('data'));
    }

    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
//dd( Auth::guard('admin')->user()->name);
            return redirect()->intended('/acceuil');
        }
        return back()->withInput($request->only('email', 'remember'));
    }

}
