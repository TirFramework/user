<?php

namespace Tir\User\Entities;

use Cartalyst\Sentinel\Users\EloquentUser;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;


class User extends EloquentUser implements AuthenticatableContract
{
    use SoftDeletes;
    use Authenticatable;


    //Additional trait insert here

    /**
     * The attribute select which table used for this model
     *
     * @var string
     */
    public $table = "users";

    public static $routeName = 'user';

    public $translatedAttributes = [];

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'name',
        'permissions',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['last_login'];


    //this function generate option for action select in header panel
    public function getActions()
    {
        $actions = [
            'index' =>
                [
                    'delete' => trans('crud::panel.delete'),
                ],

            'trash' =>
                [
                    'restore'    => trans('panel.restore'),
                    'fullDelete' => trans('panel.full_delete'),
                ],
        ];
        return $actions;
    }

    public function getValidation()
    {
        return [
            'status' => 'required',
            'email'  => "required|unique:users,email,$this->id",
        ];
    }


    public function getFields()
    {
        $fields = [
            [
                'name'    => 'base-information',
                'type'    => 'group',
                'visible' => 'ce',
                'tabs'    => [
                    [
                        'name'    => 'user-information',
                        'type'    => 'tab',
                        'visible' => 'ce',
                        'fields'  => [
                            [
                                'name'    => 'id',
                                'type'    => 'text',
                                'visible' => 'io',
                            ],
                            [
                                'name'       => 'name',
                                'type'       => 'text',
                                'validation' => 'minlength="2" required',
                                'visible'    => 'ice'
                            ],
                            [
                                'name'       => 'email',
                                'type'       => 'email',
                                'validation' => 'required',
                                'visible'    => 'ice'
                            ],
                            [
                                'name'       => 'mobile',
                                'type'       => 'number',
                                'validation' => 'minlength="9" required',
                                'visible'    => 'ice'
                            ],
                            [
                                'name'       => 'password',
                                'type'       => 'password',
                                'validation' => 'required',
                                'visible'    => 'ce',
                            ],
                            [
                                'name'       => 'status',
                                'type'       => 'select',
                                'validation' => 'required',
                                // 'placeholder'=> 'select status',
                                'data'       => ['enabled' => trans('user::panel.enabled'), 'disabled' => trans('user::panel.disabled')],
                                'visible'    => 'icef'
                            ]

                        ]
                    ]
                ]
            ]
        ];
        return $fields;}


}
