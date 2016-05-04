<?php

namespace App;

use App\RouteLocation;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description'
    ];

    /**
     * Get all of the tasks for the user.
     */
    public function locations()
    {
        return $this->hasMany(RouteLocation::class);
    }

    /**
     * Get the shares for this route.
     */
    public function shares()
    {
        return $this->hasMany(RouteShare::class);
    }
}
