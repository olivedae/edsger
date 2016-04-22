<?php

namespace App\Policies;

use App\User;
use App\BoxPermission;
use Illuminate\Auth\Access\HandlesAuthorization;

class BoxPermissionPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the given user can delete the given task.
     *
     * @param  User  $user
     * @param  BoxPermission $permission
     * @return bool
     */
    public function destroy(User $user, BoxPermission $permission)
    {
        $has_permission = $user->id === $permission->user_id;
        return $has_permission && $permission->is_owner;
    }
}
