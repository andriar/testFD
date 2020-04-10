<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PurchaseTransactionDetail extends Model
{
    public $incrementing = false;

    // protected $table = 'purchasetransactiondetails';

    protected $fillable = ['name', 'qty', 'price', 'purchase_transaction_id', 'good_id'];

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

    public function good()
    {
        return $this->belongsTo('App\Models\Good');
    }
}