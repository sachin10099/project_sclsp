<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    protected $fillable = [
    	'slug',
    	'heading',
    	'tagline',
    	'desc',
    	'image'
    ];
}
