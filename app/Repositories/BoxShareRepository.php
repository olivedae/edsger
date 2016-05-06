<?php

namespace App\Repositories;

use App\User;
use App\Box;
use App\BoxShare;
use App\BoxPermission;

class BoxShareRepository
{
    /**
     * Get all the shared boxes for a given user
     *
     * @param User $user
     * @return Collection
     */
    public function forInvitationToUser(User $user)
    {
        return
            BoxShare::where('user_to_id', $user->id)
                ->orderBy('created_at', 'asc')
                ->get();
    }

    /**
     * Get all the boxes a user has shared
     *
     * @param User $user
     * @return Collection
     */
    public function forInvitationFromUser(User $user)
    {
        return
            BoxShare::where('user_from_id', $user->id)
                ->orderBy('created_at', 'asc')
                ->get();
    }

    /**
     * Get all the users a box has been shared with
     *
     * @param Box $box
     * @return Collection
     */
    public function forBox(Box $box)
    {
        $permissions =
            BoxPermission::where('box_id', $box->id)
                ->orderBy('created_at', 'asc')
                ->get();

        $users = $permissions->map(function($item, $key) {
            return $item->user();
        });

        return $users;
    }
}
