<?php

namespace App;

use App\Box;
use Illuminate\Database\Eloquent\Model;

class BoxPermission extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'box_id',
        'is_owner',
        'can_edit',
    ];

    /**
     * Get owner of the box
     */
    public function user()
    {
        return User::where('id', $this->user_id)->first();
    }

    /**
     * Get box
     */
    public function box()
    {
        return Box::where('id', $this->box_id)->first();
    }

    /**
     * Convenience method for gather the users
     *     that this box has been shared with.
     *     Excludes itself.
     *
     * @return BoxPermission[]
     */
     public function shares()
     {
         return
            BoxPermission::where('box_id', $this->box_id)
                ->where('id', '!=', $this->id)
                ->get();
     }
}
