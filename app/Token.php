<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $table = 'tokens';
    public $timestamps = true;
    protected $fillable = array('token','type');

    public function client()
    {
        return $this->belongsTo('App\Client');
    }
}
