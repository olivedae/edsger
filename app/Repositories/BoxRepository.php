<?php

namespace App\Repositories;

use App\User;
use App\Box;
use App\Route;
use App\BoxPermission;
use App\RoutePermission;
use App\BoxContainsBoxes;
use App\BoxContainsRoutes;

class BoxRepository
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
            BoxPermission::where('user_id', $user->id)
                ->orderBy('created_at', 'asc')
                ->get();

        $boxes = $permissions->map(function($item, $key) {
            return $item->box();
        });

        return $boxes;
    }

    /**
     * Get all the users with permissions for a
     *     given box
     *
     * @param Box $box
     * @return Collection
     */
    public function forBox(Box $box)
    {
        $perissions =
            BoxPermission::where('box_id', $box->id)
                ->orderBy('created_at', 'asc')
                ->get();

        $users = $permissions->map(function($item, $key) {
            return $item->user();
        });

        return $users;
    }

    /**
     * Gets all the contents for a given box
     *
     * @param Box $box
     * @param User $user
     * @return Collection
     */
    public function contentsFor(Box $box, User $user)
    {
        $containsBoxes =
            BoxContainsBoxes::where('parent_box_id', $box->id)
                ->get()->all();

        $containsRoutes =
            BoxContainsRoutes::where('parent_box_id', $box->id)
                ->get()->all();

        $items = [];

        foreach ($containsBoxes as $cb) {
            $b = Box::where('id', $cb->box_id)->first();
            $bp =
                BoxPermission::where('user_id', $user->id)
                    ->where('box_id', $b->id)
                    ->get();
            if (count($bp) == 1) {
                $items[] = $b;
            }
        }

        foreach ($containsRoutes as $cr) {
            $r = Route::where('id', $cr->route_id)->first();
            $rp =
                RoutePermission::where('user_id', $user->id)
                    ->where('route_id', $r->id)
                    ->get();
            if (count($rp) == 1) {
                $items[] = $r;
            }
        }

        return $items;
    }
}
