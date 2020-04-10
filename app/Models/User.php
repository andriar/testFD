<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class User extends Model
{

    // use Notifiable;
    
    public $incrementing = false;

    protected $fillable = ['name', 'email', 'password'];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function boot()
    {
         parent::boot();
         self::creating(function($model){
             $model->id = self::generateUuid();
         });
    }
    public static function generateUuid()
    {
         return (string) Str::uuid();
    }

    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }

    public function followers()
    {
        return $this->hasMany('App\Models\Follower', 'friend_id');
    }

    public function following()
    {
        return $this->hasMany('App\Models\Follower', 'user_id');
    }
}