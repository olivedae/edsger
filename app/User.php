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
    public function sharesSent()
    {
        return $this->hasMany(BoxShare::class);
    }

    /**
     * Get all the boxes that was shared with this user
     */
    public function sharesReceived()
    {
        return $this->hasMany(BoxShare::class);
    }       
}
