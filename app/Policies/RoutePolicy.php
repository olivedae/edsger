<?php

namespace App\Policies;

use App\User;
use App\Route;
use App\RoutePermission;
use Illuminate\Auth\Access\HandlesAuthorization;

class RoutePolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given user can delete the
     *     given task.
     *
     * @param User $user
     * @param Route $route
     * @return bool
     */
    public function destroy(User $user, Route $route)
    {
        $permissions =
            RoutePermission::where('user_id', $user->id)
                            ->where('route_id', $route_id)
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
    public function shareable(User $user, Route $route)
    {
        $permissionCount =
            RoutePermission::where('user_id', $user->id)
                            ->where('route_id', $route->id)
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
    public function index(User $user, Route $route)
    {
        $permissionCount =
            RoutePermission::where('user_id', $user->id)
                            ->where('route_id', $route->id)
                            ->count();

        return $permissionCount == 1;
    }
}
