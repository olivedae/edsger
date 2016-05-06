<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoxContainsBoxes extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_box_id',
        'box_id'
    ];

    /**
     * Gets the parent box for this
     *    instance.
     */
    public function parentBox()
    {
        return Box::where('id', $this->parent_box_id)->first();
    }

    /**
     * Gets the child box contained in the
     *     parent box.
     */
    public function box()
    {
        return Box::where('id', $this->box_id)->first();
    }
}
