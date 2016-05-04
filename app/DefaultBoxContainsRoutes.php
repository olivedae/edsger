<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DefaultBoxContainsRoutes extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'default_box_id',
        'route_id'
    ];

    /**
     * Gets the default box for this
     *    instance.
     */
    public function defaultBox()
    {
        return $this->hasOne(DefaultBox::class);
    }

    /**
     * Gets the route for this
     *     instance.
     */
    public function route()
    {
        return $this->hasOne(Route::class);
    }
}
