<?php

namespace App\Repositories;

use App\User;
use App\Route;
use App\RoutePermission;

class RouteRepository
{
    /**
     * Get all of the permissions for a given user
     *
     * @param User $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        $permissions =
            RoutePermission::where('user_id', $user->id)
                            ->orderBy('created_at', 'asc')
                            ->get();

        $routes = $permissions->map( function($item, $key) {
            return $item->route();
        });

        return $routes;
    }
}
