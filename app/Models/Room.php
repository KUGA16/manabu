<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    //リレーション
    public function users() {
        return $this->belongsToMany('App\Models\User');
    }

    public function messages() {
        return $this->hasMany('App\Models\Message');
    }
}
