<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteConfig extends Model
{
    protected $fillable = [
    	'name',
    	'data',
    	'config_group',
    	'config_type'
    ];
}
