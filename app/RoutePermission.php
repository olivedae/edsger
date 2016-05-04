<?php

namespace App;

use App\User;
use App\Route;
use Illuminate\Database\Eloquent\Model;

class RoutePermission extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'route_id',
        'is_owner',
        'can_edit'
    ];

    /**
     * Gets the user the permission relates to
     */
    public function user()
    {
        return User::where('id', $this->user_id)->first();
    }

    /**
     * Gets the route the permission relates to
     */
    public function route()
    {
        return Route::where('id', $this->route_id)->first();
    }
}
