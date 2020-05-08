<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobRelatedDocument extends Model
{
    protected $fillable = [
    	'applied_job_id',
    	'user_id',
    	'document_name',
    	'document_file',
    ];
}
