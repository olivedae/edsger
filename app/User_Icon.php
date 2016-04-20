<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Icon extends Model
{

    public function user()
    {
        $this->belongsTo(User:class);
    }

}
