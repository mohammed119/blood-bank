<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Governorate extends Model 
{

    protected $table = 'governorates';
    public $timestamps = true;
    protected $fillable=array('name');
    public function cities()
    {
        return $this->hasMany('App\City');
    }

    public function clients()
    {
        return $this->belongsToMany('App\Client');
    }

}