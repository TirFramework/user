<?php

namespace Tir\User\Models;

use Tir\Crud\Models\CrudModel;

class User extends CrudModel
{
    //insert trait here
    use \Tir\Profile\Traits\UserTrait;

    public $table = "users";

    public function getFields()
    {
        $fields = [
            [
                'name'       => 'id',
                'type'       => 'text',
                'visible'    => 'io',
            ],
            [
                'name'      => 'name',
                'type'      => 'text',
                'visible'   => 'ice'
            ],
            [
                'name'      => 'email',
                'type'      => 'text',
                'visible'   => 'ice'
            ],
            [
                'name'      => 'mobile',
                'type'      => 'text',
                'visible'   => 'ice'
            ],
            [
                'name'      => 'password',
                'type'      => 'password',
                'visible'   => 'ce',
            ],
            [
                'name'      => 'roles',
                'type'      => 'relationSelect',
                'relation'  => 'roles',
                'multiple'  => true,
                'data'      => ['module' => 'Authorization', 'model' => 'Role'],
                'datatable' => ['roles[].title', 'roles.title'],
                'visible'   => 'ice',
            ],
            [
                'name'      => 'type',
                'type'      => 'select',
                'data'      => ['user' => trans('user::panel.user'), 'admin' => trans('user::panel.admin')],
                'visible'   => 'icef'
            ],
            [
                'name'      => 'status',
                'type'      => 'select',
                'data'      => ['enabled' => trans('user::panel.enabled'), 'disabled' => trans('user::panel.disabled')],
                'visible'   => 'icef'
            ],
            [
                'name'      => 'email_verified_at',
                'type'      => 'date',
                'visible'   => 'ice'
            ],
            [
                'name'      => 'profile',
                'type'      => 'profile',
                'visible'   => 'e'
            ],
            [
                'name'      => 'reserves',
                'type'      => 'reserves',
                'visible'   => 'e'
            ],

        ];

        return json_decode(json_encode($fields));
    }


    // public function __construct() {
    //     dd('this is user model');
    // }

}
