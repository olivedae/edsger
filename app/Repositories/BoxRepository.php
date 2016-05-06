<?php

namespace App\Repositories;

use App\User;
use App\Box;
use App\BoxPermission;

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
}
