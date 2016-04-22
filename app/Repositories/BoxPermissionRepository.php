<?php

namespace App\Repositories;

use App\User;
use App\BoxPermission;

class BoxPermissionRepository 
{
    /**
     * Get all of the permissions for a given user
     *
     * @param User $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        return BoxPermission::where('user_id', $user->id)
                            ->orderBy('created_at', 'asc')
                            ->get();
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
        return BoxPermission::where('box_id', $box->id)
                             ->orderBy('created_at', 'asc')
                             ->get();
    }
}
