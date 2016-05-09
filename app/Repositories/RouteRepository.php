<?php

namespace App\Repositories;

use App\User;
use App\Route;
use App\RoutePermission;
use App\Location;
use App\RouteLocation;

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

    /**
     * Get all the locations for a given route
     *
     * @param Route $route
     * @return Collection
     */
    public function locationsFor(Route $route)
    {
        $rels =
            RouteLocation::where('route_id', $route->id)
                ->get()
                ->all();

        $items = [];

        foreach ($rels as $rel) {
            $items[] = Location::where('id', $rel->location_id)->first();
        }

        return $items;
    }
}
