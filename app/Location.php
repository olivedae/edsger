<?php

namespace App;

use App\RouteLocation;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'google_place_id',
        'address',
        'name',
    ];
}
