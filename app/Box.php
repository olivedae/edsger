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
        'in_default_box'
    ];

    /**
     * Gets box permissions
     */
    public function permissions()
    {
        return $this->hasMany(BoxPermission::class);
    }

    /**
     * Gets the shares for this box.
     */
    public function shares()
    {
        return $this->hasMany(BoxShare::class);
    }

    /**
     * Gets the box this object is nested
     *     in.
     */
    public function parentBox()
    {
        if ($this->in_default_box) {
            return $this->hasOne(DefaultBox::class);
        }

        /**
         * Otherwise the box is nested
         *    inside a normal box.
         */
        return $this->hasOne(Box::class);
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

    /**
     * Returns the shares for a given box
     */
    public function unwrapShares(User $user)
    {
        return
            BoxPermission::where('box_id', $this->id)
                ->where('user_id', '!=', $user->id)
                ->get();
    }
}
