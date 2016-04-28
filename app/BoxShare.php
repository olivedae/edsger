<?php

namespace App;

use App\Box;
use App\User;
use Illuminate\Database\Eloquent\Model;

class BoxShare extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_from_id',
        'user_to_id',
        'box_id',
        'accepted',
        'pending'
    ];

    /**
     * Get the user the created the share.
     */
    public function invitationFrom()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the user who the Box was shared with.
     */
    public function invitationTo()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the Box which was shared.
     */
    public function box()
    {
        return $this->belongsTo(Box::class);
    }
}
