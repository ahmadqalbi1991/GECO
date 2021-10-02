<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'setting';
    protected $fillable = [
        'paypal_username',
        'paypal_password',
        'paypal_secret',
        'facebook_url',
        'twitter_url',
        'pinterest_url',
        'linkedin_url',
        'youtube_url',
        'streaming_url',
        'shipping_charges'
    ];
}
