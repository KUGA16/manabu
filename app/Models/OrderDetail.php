<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    //カラムにデータの挿入を許可する
    protected $fillable = [
        'user_id', 'lesson_id', 'hold_flag',
    ];

    //リレーション
    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function lesson() {
        return $this->belongsTo('App\Models\Lesson');
    }
}
