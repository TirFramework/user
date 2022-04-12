<?php

namespace Tir\User\Controllers;

use Tir\Crud\Controllers\CrudController;
use Tir\User\Entities\User;

class AdminUserController extends CrudController
{
    protected function setModel(): string
    {
        return User::class;
    }
}
