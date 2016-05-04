<?php

namespace App\Repositories;

use App\User;
use App\Route;
use App\RoutePermission;

class RoutePermissionRepository
{
    /**
     * Get all of the permissions for a given user
     *
     * @param User $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        return
            RoutePermission::where('user_id', $user->id)
                            ->orderBy('created_at', 'asc')
                            ->get();
    }

    /**
     * Get all the users with permissions for a
     *     given box
     *
     * @param Route $route
     * @return Collection
     */
    public function forRoute(Route $route)
    {
        return
            RoutePermission::where('route_id', $route->id)
                ->orderBy('created_at', 'asc')
                ->get();
    }
}
