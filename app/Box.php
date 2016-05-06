<?php

namespace App;

use App\BoxPermission;
use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Gets box permissions
     */
    public function permissions()
    {
        return
            BoxPermission::where('box_id', $this->id)
                ->get();
    }

    /**
     * Gets the shares for this box.
     */
    public function shares(User $user)
    {
        return
            BoxPermission::where('box_id', $this->id)
                ->where('user_id', '!=', $user->id)
                ->get();
    }

    /**
     * Gets the box this object is nested
     *     in for a given user.
     *
     * TODO: Fix buggy and odd implementation,
     *           regard as unusable for now.
     */
    public function parents(User $user)
    {
        $boxes = [];

        $defaultBox =
            DefaultBox::where('user_id', $user->id)
                ->first();

        $contentsForDefault =
            DefaultBoxContainsBoxes::where('default_box_id', $defaultBox->id)
                ->where('box_id', $this->id)
                ->get();

        /**
         * Check whether anything here exits
         */

        // If it is in a default box, there will be only
        //     one instance of it.

        if (count($contentsForDefault) == 1) {
            $boxes[] = $defaultBox;
            return $boxes;
        }

        /**
         * Otherwise the box is nested
         *    inside a normal box.
         */

        $contentsForBox =
            BoxContainsBoxes::where('box_id', $this->id)
                ->get()->all();

        $boxes = [];

        foreach ($contentsForBox as $parentBox) {
            $box = Box::where('id', $parentBox->parent_box_id)->first();
            $permissions =
                BoxPermission::where('box_id', $box->id)
                    ->where('user_id', $user->id)
                    ->get();
            // If the given user has access to it,
            //     we add it to be returned
            if (count($permissions) == 1) {
                $boxes[] = $box;
            }
        }

        return $boxes;
    }

    /**
     * Gets the contents of this box for a given
     *     user.
     */
    public function contents(User $user)
    {
        $items = [];

        $boxes =
            BoxContainsBoxes::where('parent_box_id', $this->id)
                ->get()->all();

        $routes =
            BoxContainsRoutes::where('parent_box_id', $this->id)
                ->get()->all();

        foreach ($boxes as $rel) {
            $box = Box::where('id', $rel->box_id)->first();
            $permissions =
                BoxPermission::where('box_id', $box->id)
                    ->where('user_id', $user->id)
                    ->get();
            if (count($permissions) == 1) {
                $items[] = $box;
            }
        }

        foreach ($routes as $rel) {
            $route = Route::where('id', $rel->route_id)->first();
            $permissions =
                RoutePermission::where('route_id', $route->id)
                    ->where('user_id', $user->id)
                    ->get();
            if (count($permissions) == 1) {
                $items[] = $route;
            }
        }

        return $items;
    }

    /**
     * Returns whether the box is owned by the
     *     given user.
     */
    public function isOwner(User $user)
    {
        $permission =
            BoxPermission::where('box_id', $this->id)
                ->where('user_id', $user->id)
                ->first();

        return $permission->is_owner;
    }
}
