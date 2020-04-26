<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobDocument extends Model
{
    protected $fillable = [
    	'applied_job_id',
    	'documents'
    ];
}
