<?php

namespace Tir\User\Controllers\Auth;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class AdminLoginController extends Controller
{

    public function authenticate(Request $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return Response::Json(Auth::user());
        }else{
            return Response::Json(false, 403);
        }
    }

}
