<?php

namespace App;

use App\RouteLocation;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'in_default_box'
    ];

    /**
     * Get all of the tasks for the user.
     */
    public function locations()
    {
        return $this->hasMany(RouteLocation::class);
    }

    /**
     * Get the shares for this route.
     */
    public function shares()
    {
        return $this->hasMany(RouteShare::class);
    }

    /**
     * Gets the parent container/box for
     *     this route.
     */
    public function parentBox()
    {
        if ($this->in_default_box) {
            return $this->hasOne(DefaultBox::class);
        }

        /**
         * Otherwise the route is held
         *    inside a normal, user created box.
         */
        return $this->hasOne(Box::class);
    }

    /**
     * Returns whether the route is owned by
     *     given user.
     */
    public function isOwner(User $user)
    {
        $permission =
            RoutePermission::where('route_id', $this->id)
                ->where('user_id', $user->id)
                ->first();

        return $permission->is_owner;
    }

    /**
     * Returns the shares for a given route
     */
    public function unwrapShares(User $user)
    {
        return
            RoutePermission::where('route_id', $this->id)
                ->where('user_id', '!=', $user->id)
                ->get();
    }
}
