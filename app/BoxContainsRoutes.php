<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoxContainsRoutes extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_box_id',
        'route_id'
    ];

    /**
     * Gets the parent box for this
     *    instance.
     */
    public function parentBox()
    {
        return Box::where('id', $this->parent_box_id);
    }

    /**
     * Gets the child route contained in the
     *     parent box.
     */
    public function route()
    {
        return Route::where('id', $this->route_id);
    }
}
