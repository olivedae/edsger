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
        return Location::where('id', $this->location_id);
    }

    /**
     * Get the route instance this belongs to
     */
    public function route()
    {
        return Route::where('id', $this->route_id);
    }
}
