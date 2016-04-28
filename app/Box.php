<?php

namespace App;

use App\BoxPermission;
use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Gets box permissions
     */
    public function permissions()
    {
        return $this->hasMany(BoxPermission::class);
    }

    /**
     * Get the shares for this box.
     */
    public function shares()
    {
        return $this->hasMany(BoxShare::class);
    }
}
