<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'teacher_flag',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //リレーション
    public function lessons() {
        return $this->hasMany('App\Models\Lesson');
    }

    public function order_details() {
        return $this->hasMany('App\Models\OrderDetail');
    }

    public function rooms() {
        return $this->belongsToMany('App\Models\Room');
    }

    public function receiver() {
        return $this->hasMany('App\Models\Message', 'messages', 'sender_id', 'receiver_id');
    }
}
