<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /* 
    *  We defined two methods to return the JWTIdentifier and JWTCustomClaims
    *
    */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /*
    * Custom claims are used in generating the JWT token.
    *
    */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
