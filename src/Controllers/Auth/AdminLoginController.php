<?php

namespace Tir\User\Controllers\Auth;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class AdminLoginController extends Controller
{

    public function authenticate(Request $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::User();

            $user->api_token = Str::random(60);
            $user->save();
            
            return Response::Json(['userData'=>$user,'api_token'=>$user->api_token]);
        }else{
            return Response::Json(false, 403);
        }
    }

}
