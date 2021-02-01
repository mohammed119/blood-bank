<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model 
{

    protected $table = 'messages';
    public $timestamps = true;

//    protected $fillable = array('message_name','message_content');
    protected $fillable = array('client_id','message_name','message_content');

    public function client()
    {
        return $this->belongsTo('App\Client','client_id');
    }

}