<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SellingTransactionDetail extends Model
{
    public $incrementing = false;

    // protected $table = 'sellingtransactiondetails';

    protected $fillable = ['name','qty','price','good_id'];

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