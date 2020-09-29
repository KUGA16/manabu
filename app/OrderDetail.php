<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    //カラムにデータの挿入を許可する
    protected $fillable = [
        'user_id', 'lesson_id', 'hold_flag',
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function lesson() {
        return $this->belongsTo('App\Lesson');
    }
}
