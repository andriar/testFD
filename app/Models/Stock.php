<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Stock extends Model
{
    public $incrementing = false;

    // protected $table = 'stocks';

    protected $fillable = ['qty', 'good_id'];

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

    // public function good()
    // {
    //     return $this->belongsTo('APp\Models\Good');
    // }
}