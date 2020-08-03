<?php

namespace Tir\User\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

use Auth;

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
        return view(config('crud.front-template').'::pages.auth.login');
    }



    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');


        if (Auth::attempt($credentials)) {

            // Authentication passed...
            if(isset($request->adminLoginForm)){
                return redirect()->route('dashboard');
            } else{

                return redirect()->to( $redirectTo );
            }
        }else{
            return redirect()->back();
        }
    }


    
    public function showAdminLoginForm()
    {
        return view(config('crud.admin-panel').'::pages.login');
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
