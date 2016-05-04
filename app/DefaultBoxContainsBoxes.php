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
        return $this->hasOne(DefaultBox::class);
    }

    /**
     * Gets the box for this
     *     instance.
     */
    public function box()
    {
        return $this->hasOne(Box::class);
    }
}
