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
    public function user_access()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get box
     */
    public function box()
    {
        return $this->belongsTo(Box::class);
    }

    /**
     * Convenience method for grabbing a model
     *     instance of Box which the permission
     *     is for.
     */
    public function unwrap_box()
    {
        return Box::where('id', $this->box_id)->get()[0];
    }
}
