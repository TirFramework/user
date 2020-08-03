<?php

namespace Tir\User\Controllers;

use Tir\User\Entities\User;
use Tir\Crud\Controllers\CrudController;

class AdminUserController extends CrudController
{
    protected $model = User::Class;
}
