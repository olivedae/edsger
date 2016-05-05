<?php

namespace App\Policies;

use App\User;
use App\Box;
use App\BoxPermission;
use Illuminate\Auth\Access\HandlesAuthorization;

class BoxPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given user can delete the
     *     given box
     *
     * @param User $user
     * @param Box $box
     * @return bool
     */
    public function destroy(User $user, Box $box)
    {
        $permissions =
            BoxPermission::where('user_id', $user->id)
                            ->where('box_id', $box->id)
                            ->get();

        if (count($permissions) != 1) {
            return false;
        }

        $permission = $permissions[0];

        return $permission->is_owner;
    }

    /**
     * Determine if the given user can
     *    share a given box.
     *
     * @param User $user
     * @param Route $route
     * @return bool
     */
    public function shareable(User $user, Box $box)
    {
        $permissionCount =
            BoxPermission::where('user_id', $user->id)
                            ->where('box_id', $box->id)
                            ->count();

        return $permissionCount == 1;
    }

    /**
     * Determine if the given user can
     *    view the shares of a given route
     *
     * @param User $user
     * @param Route $route
     * @return bool
     */
    public function index(User $user, Box $box)
    {
        $permissionCount =
            BoxPermission::where('user_id', $user->id)
                            ->where('box_id', $box->id)
                            ->count();

        return $permissionCount == 1;
    }
}
