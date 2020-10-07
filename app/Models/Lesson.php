<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'body',
        'image',
        'keyword',
        'l_address',
        'm_address',
        'date',
        'time'
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function category() {
        return $this->belongsTo('App\Models\Category');
    }

    public function order_details() {
        return $this->hasMany('App\Models\OrderDetail');
    }
}
