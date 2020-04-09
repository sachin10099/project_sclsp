<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'slug',
    	'name',
    	'designation',
    	'desc',
    	'image',
    	'facebook_link',
    	'twitter_link',
    	'insta_link',
    	'linkedin_link'
    ];
}
