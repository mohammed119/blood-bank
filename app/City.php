<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model 
{

    protected $table = 'cities';
    public $timestamps = true;
    protected $fillable=array('name','governorate_id');

    public function governorate()
    {
        return $this->belongsTo('App\Governorate');
    }

    public function clients()
    {
        return $this->hasMany('App\Client');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

}