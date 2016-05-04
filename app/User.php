<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'first_name', 'last_name', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function icon()
    {
        return $this->hasOne(UserIcon::class);
    }

    /**
     * Get all of the boxes the user has access to
     */
    public function boxPermissions()
    {
        return $this->hasMany(BoxPermission::class);
    }

    /**
     * Get all the boxes this user has shared
     */
    public function boxSharesSent()
    {
        return $this->hasMany(BoxShare::class);
    }

    /**
     * Get all the boxes that was shared with this user
     */
    public function boxSharesReceived()
    {
        return $this->hasMany(BoxShare::class);
    }

    /**
     * Get all the routes that this user shared
     */
    public function routeSharesSent()
    {
        return $this->hasMany(RouteShare::class);
    }

    /**
     * Get all the routes that was shared with this user
     */
    public function routeSharesReceived()
    {
        return $this->hasMany(RouteShare::class);
    }
}
