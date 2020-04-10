<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Refraction extends Model
{
    public $incrementing = false;

    // protected $table = 'refractions';

    protected $fillable = ['od_vsc','od_sph','od_cyl','od_axis','od_add','od_sh','od_pd','os_sph','os_cyl','os_axis', 'os_add', 'os_sh', 'os_pd'];

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