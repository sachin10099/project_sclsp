<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    protected $fillable = [
    	'variable_name',
    	'title',
    	'description',
    	'variable'
    ];`
}
