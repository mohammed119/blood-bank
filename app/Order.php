<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model 
{

    protected $table = 'orders';
    public $timestamps = true;
    protected $fillable = array('name','age','blood_type_id','bags_number','hospital_name','city_id',
        'phone','details','latitude','longitude','hospital_address');

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function bloodType()
    {
        return $this->belongsTo('App\BloodType');
    }

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function notifications()
    {
        return $this->hasMany('App\Notification');
    }

}