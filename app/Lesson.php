<?php

namespace App;

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
}
