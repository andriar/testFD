<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SellingTransaction extends Model
{
    public $incrementing = false;

    // protected $table = 'sellingtransactions';

    protected $fillable = ['transaction_code', 'total', 'customer_id'];

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
}