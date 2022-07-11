<?php

namespace App;

use Google\Service\AdMob\App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SiteMenu extends Model
{

   protected $table ='site_menus';
   protected $primaryKey = 'id';
   protected $guarded = [];
   public $incrementing = false;

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }
}
