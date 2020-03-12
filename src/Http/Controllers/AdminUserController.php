<?php

namespace Tir\User\Http\Controllers;

use Tir\User\Models\User;
use Tir\Crud\Http\Controllers\CrudController;
use Tir\Profile\Models\Profile;

class AdminUserController extends CrudController
{
    protected $model = User::Class;

}
