<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BloodType extends Model 
{

    protected $table = 'blood_types';
    public $timestamps = true;

    public function clients()
    {
        return $this->hasMany('App\Client');
    }

    public function clients2()
    {
        return $this->belongsToMany('App\Client');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

}