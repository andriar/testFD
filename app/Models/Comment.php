<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Comment extends Model
{
    public $incrementing = false;

    // protected $table = 'comments';

    protected $fillable = ['comment', 'post_id', 'comment_id', 'user_id'];

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
}