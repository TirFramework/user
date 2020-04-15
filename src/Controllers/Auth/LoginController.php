<?php

namespace Tir\User\Controllers\Auth;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller ;
use Illuminate\Support\Facades\Redirect;


class LoginController extends Controller
{


    /**
     * LoginController constructor.
     */
    public function __construct()
    {
        return $this->middleware('IsGuest');

    }

    public function showAdminLoginForm()
    {

        return view(config('crud.admin-panel').'::pages.login');
    }

    public function authentication(Request $request)
    {

        if(Sentinel::authenticate($request->all())){
        return Redirect::to('/admin/user/');
        }
        return Redirect::back()->withErrors(['loginError','user or password is wrong']);
    }
}
