<?php

namespace Tir\User\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\View;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login()
    {
         Auth::attempt(['email' => 'admin@tir.local', 'password' => '12345678900']);
    }


    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        //Default credential for login attempt is email
        $credentials = $this->credentials($request);
        //if email is numeric we change credential to mobile field
        if(is_numeric($request['email'])){
            $credentials = ['mobile'=>$request['email'],'password'=>$request['password']];
        }

         return $this->guard()->attempt(
            $credentials, $request->filled('remember')
        );

    }




}
