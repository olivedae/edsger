<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DefaultBox extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id'];

    /**
     * Gets the owner of the default box
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }

    /**
     * Gets the routes of the default box
     */
    public function routes()
    {
        return $this->hasMany(Route::class);
    }

    /**
     * Gets the boxes contained in the
     *     default box
     */
    public function boxes()
    {
        return $this->hasMany(Boxes::class);
    }
}
