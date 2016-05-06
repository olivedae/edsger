<?php

namespace App\Policies;

use App\User;
use App\RoutePermission;
use App\RoueShare;
use Illuminate\Auth\Access\HandlesAuthorization;

class BoxSharePolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given user can delete the
     *     given route share entry
     *
     * @param User $user
     * @param RouteShare $share
     * @return bool
     */
    public function destroy(User $user, RouteShare $share)
    {
        $permissions =
            BoxPermission::where('user_id', $user->id)
                            ->where('route_id', $share->route_id)
                            ->get();

        if (count($permissions) != 1) {
            return false;
        }

        return true;
    }
}
