<?php

namespace Tir\User\Controllers\AdminAuth;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller ;
use Illuminate\Support\Facades\Redirect;


class AdminLogoutController extends Controller
{


    /**
     * LoginController constructor.
     */
    public function __construct()
    {
        return $this->middleware('IsUser');

    }

    public function logout()
    {
        Sentinel::logout();
        return Redirect::to('/');
    }


}
