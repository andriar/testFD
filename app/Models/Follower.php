<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Follower extends Model
{
    public $incrementing = false;

    // protected $table = 'followers';

    protected $fillable = ['user_id', 'friend_id', 'status'];

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

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function friend()
    {
        return $this->belongsTo('App\Models\User');
    }
}