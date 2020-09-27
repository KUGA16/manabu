<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function lesson() {
        return $this->belongsTo('App\Lesson');
    }
}
