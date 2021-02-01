<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactDetail extends Model 
{

    protected $table = 'contact_details';
    public $timestamps = true;
    protected $fillable=array('phone','email','facebook_url','twitter_url',
        'youtube_url','instagram_url','whatsapp_url','google_url','android_app_url','ios_app_url');


}