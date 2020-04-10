<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PurchaseTransaction extends Model
{
    public $incrementing = false;

    // protected $table = 'purchasetransactions';

    protected $fillable = ['transaction_code', 'total', 'supplier_id'];

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

    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier', 'supplier_id');
    }

    public function details()
    {
        return $this->hasMany('App\Models\PurchaseTransactionDetail');
    }
}