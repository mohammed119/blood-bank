<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Client extends Authenticatable
{

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array(
        'name','email','phone','password','birth_date','last_date_donate','city_id','blood_type_id','is_active'
    );
    protected $hidden = [
        'password', 'api_token',
    ];

    public function bloodType()
    {
        return $this->belongsTo('App\BloodType');
    }

    public function bloodTypes()
    {
        return $this->belongsToMany('App\BloodType');
    }

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function messages()
    {
        return $this->hasMany('App\Message');
    }

    public function posts()
    {
        return $this->belongsToMany('App\Post');
    }

    public function governorates()
    {
        return $this->belongsToMany('App\Governorate');
    }

    public function notifications()
    {
        return $this->belongsToMany('App\Notification');
    }
    public function tokens()
    {
        return $this->hasMany('App\Token');
    }

}