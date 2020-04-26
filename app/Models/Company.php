<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
    	'user_id',
    	'company_name',
    	'company_tagline',
    	'company_desc',
    	'company_stablished',
    	'company_logo'
    ];
}
