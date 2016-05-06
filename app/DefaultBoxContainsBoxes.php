<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DefaultBoxContainsBoxes extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'default_box_id',
        'box_id'
    ];

    /**
     * Gets the default box for this
     *    instance.
     */
    public function defaultBox()
    {
        return DefaultBox::where('id'. $this->default_box_id)->first();
    }

    /**
     * Gets the box for this
     *     instance.
     */
    public function box()
    {
        return Box::where('id', $this->box_id)->first();
    }
}
