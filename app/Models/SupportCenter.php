<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class SupportCenter extends Model
{
	use Notifiable;
	
    protected $fillable =[
    	'name',
    	'email',
    	'query',
    	'response',
    	'replied_at'
    ];
}
