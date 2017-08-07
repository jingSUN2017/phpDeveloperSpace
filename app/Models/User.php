<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table='users';

    use Notifiable;

    protected $fillable = [
        'username',
        'email',
        'password',
        'first_name',
        'last_name',
        'phone',
        'position',
        'hobby',
        'first_address',
        'last_address',
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getUsername(){
        return $this->username;
    }
    public function likes()
    {
        return $this->hasMany('App\Models\Like');
    }
    public function blogs(){
        return $this->hasMany('App\Models\Like');
    }
}
