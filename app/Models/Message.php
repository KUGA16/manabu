<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //カラムにデータの挿入を許可する
    protected $fillable = [
        'sender_id', 'receiver_id', 'content',
    ];
}
