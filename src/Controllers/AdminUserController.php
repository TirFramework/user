<?php

namespace Tir\User\Controllers;

use Illuminate\Routing\Controller;
use Tir\Crud\Controllers\Crud;
use Tir\User\Entities\User;

class AdminUserController extends Controller
{
    Use Crud;

    protected function setModel(): string
    {
        return User::class;
    }
}
