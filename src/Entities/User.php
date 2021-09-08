<?php

namespace Tir\User\Entities;

//use App\Modules\User\Notifications\MailResetPasswordToken;
//use App\Modules\User\Notifications\VerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tir\Authorization\Entities\Role;
use Tir\Crud\Scopes\OwnerScope;
use Tir\Crud\Support\Eloquent\HasDynamicRelation;
use Tir\User\Scaffold\UserScaffold;


class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use UserScaffold;
    use HasDynamicRelation;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'status', 'email', 'password', 'type', 'email_verified_at', 'mobile', 'user_id'
    ];

    protected $hidden = array('password', 'api_token','remember_token');


    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

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


    public function roles(): belongsToMany
    {
        return $this->belongsToMany(Role::class);
    }


}
