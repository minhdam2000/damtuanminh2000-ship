<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Userreq extends Authenticatable
{
    const USER_ID = 'USER_ID';

    public static function getById($userId){
        return User::find($userId);
    }
    use Notifiable;

    protected $table = 'users_add_request';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role_id','admin_id','description', 'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
  
}
