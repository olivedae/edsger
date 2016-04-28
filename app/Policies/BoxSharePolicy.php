<?php

namespace App\Policies;

use App\User;
use App\BoxPermission;
use Illuminate\Auth\Access\HandlesAuthorization;

class BoxSharePolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given user can share a
     *     given box.
     *
     * @param  User  $user
     * @param  BoxPermission $permission
     * @return bool
     */
    public function new(User $user, BoxPermission $permission)
    {
        //return $user->id === $permission->user_id;
        return true;
    }
}
