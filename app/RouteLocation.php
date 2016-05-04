<?php

namespace App;

use App\Location;
use App\Route;
use Illuminate\Database\Eloquent\Model;

class RouteLocation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'route_id',
        'location_id',
        'previous_index',
    ];

    /**
     * Get the location instance this belongs to
     */
    public function location()
    {
        return this->belongsTo(Location::class);
    }

    /**
     * Get the route instance this belongs to
     */
    public function route()
    {
        return this->belongsTo(Route::class);
    }
}
