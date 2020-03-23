<?php

namespace Tir\User\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Modules\User\Notifications\MailResetPasswordToken;
use App\Modules\User\Notifications\VerifyEmail;


class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    //Additional trait insert here

    /**
     * The attribute select which table used for this model
     *
     * @var string
     */
    public $table = "users";


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'status', 'email', 'password', 'type','email_verified_at', 'mobile'
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    
    /**
     * Send a password reset email to the user
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MailResetPasswordToken($token));
    }

    //this function generate option for action select in header panel
    public function getActions()
    {
        $actions = [
            'index' =>
            [
                'published' => trans('crud::panel.publish'),
                'unpublished' => trans('crud::panel.unpublish'),
                'draft' => trans('crud::panel.draft'),
                'delete' => trans('crud::panel.delete'),
            ],

            'trash' =>
            [
                'restore' => trans('panel.restore'),
                'fullDelete' => trans('panel.full_delete'),
            ],
        ];
        return $actions;
    }

    public function getValidation()
    {
        return [
            'type' => 'required',
            'status' => 'required',
            'password' => 'required',
            'email' => "required|unique:users,email,$this->id",
        ];
    }


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



        ];

        return json_decode(json_encode($fields));
    }


}
