<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Good extends Model
{
    public $incrementing = false;

    // protected $table = 'goods';

    protected $fillable = ['code', 'name', 'category_id', 'sub_category_id'];

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

    public function category()
    {
        return $this->hasOne('App\Models\Category', 'id', 'category_id');
    }

    public function subcategory()
    {
        return $this->hasOne('App\Models\SubCategory', 'id', 'sub_category_id');
    }

     public function stock()
    {
        return $this->hasOne('App\Models\Stock', 'good_id');
    }
}