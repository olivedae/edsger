<?php

namespace App\Repositories;

use App\User;
use App\Route;
use App\RouteShare;
use App\RoutePermission;

class RouteShareRepository
{
    /**
     * Get all the shared routes for a given user
     *
     * @param User $user
     * @return Collection
     */
    public function forInvitationToUser(User $user)
    {
        return
            RouteShare::where('user_to_id', $user->id)
                ->orderBy('created_at', 'asc')
                ->get();
    }

    /**
     * Get all the routes a user has shared
     *
     * @param User $user
     * @return Collection
     */
    public function forInvitationFromUser(User $user)
    {
        return
            RouteShare::where('user_from_id', $user->id)
                ->orderBy('created_at', 'asc')
                ->get();
    }

    /**
     * Get all the users a route has been shared with
     *
     * @param Route $route
     * @return Collection
     */
    public function forRoute(Route $route)
    {
        $permissions =
            RoutePermission::where('route_id', $route->id)
                ->orderBy('created_at', 'asc')
                ->get();

        $users = $permissions->map(function($item, $key) {
            return $item->user();
        });

        return $users;
    }
}
