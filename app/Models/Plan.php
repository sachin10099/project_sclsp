<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
    	'plan_name',
    	'plan_price',
    	'validity',
    	'class_name',
    	'status'
    ];
}
