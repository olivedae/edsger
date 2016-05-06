<?php

namespace App\Repositories;

use App\User;
use App\Route;
use App\Box;
use App\DefaultBox;
use App\DefaultBoxContainsRoutes;
use App\DefaultBoxContainsBoxes;

class DefaultBoxRepository
{
    /**
     * Get all of the items (routes and boxes)
     *     for a given user.
     *
     * @param User $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        $box =
            DefaultBox::where('user_id', $user->id)
                ->first();

        $containsRoutes =
            DefaultBoxContainsRoutes::where('default_box_id', $box->id)
                ->get()->all();

        $containsBoxes =
            DefaultBoxContainsBoxes::where('default_box_id', $box->id)
                ->get()->all();

        $items = [];

        foreach ($containsRoutes as $route) {
            $items[] = Route::where('id', $route->route_id)->first();
        }

        foreach ($containsBoxes as $box) {
            $items[] = Box::where('id', $box->box_id)->first();
        }

        return $items;
    }

}
