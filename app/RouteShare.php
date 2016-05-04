<?php

namespace App;

use App\Route;
use App\User;
use Illuminate\Database\Eloquent\Model;

class RouteShare extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = [
         'user_from_id',
         'user_to_id',
         'route_id',
         'accepted',
         'pending'
     ];

     /**
      * Get the user who created the share
      */
     public function invitationFrom()
     {
         return $this->belongsTo(User::class);
     }

     /**
      * Get the user who the route was shared with.
      */
     public function invitationTo()
     {
         return $this->belongsTo(User::class);
     }

     /**
      * Get the route that was shared.
      */
     public function route()
     {
         return $this->belongsTo(Route::class);
     }

     /**
      * Unwrap a User instance of the user who shared
      *     this route_shares instance
      */
     public function unwrap_from()
     {
         return User::where('id', $this->user_from_id)->first();
     }

     /**
      * Unwrap a User instance of the user
      *     of the route was shared with.
      */
     public function unwrap_to()
     {
         return User::where('id', $this->user_to_id)->first();
     }

     /**
      * Unwrap a Route instance of this
      *    instance of route_shares.
      */
     public function unwrap_box()
     {
         return Route::where('id', $this->route_id)->first();
     }
}
