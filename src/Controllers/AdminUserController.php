<?php

namespace Tir\User\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tir\User\Entities\User;
use Tir\Crud\Controllers\CrudController;

class AdminUserController extends CrudController
{
    protected $model = User::Class;

    public function storeRequestManipulation(Request $request)
    {
        //password hashed
        $password = Hash::make($request->input('password'));
        $request->merge(['password'=> $password]);
        return $request;
    }

    public function updateRequestManipulation(Request $request)
    {
        return $this->storeRequestManipulation($request);
    }

}
