<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormUserQualification extends Model
{
    protected $fillable = [
    	'user_id',
    	'tenth_doc_image',
    	'tweleth_doc_image',
    	'diploma_doc_image',
    	'graguation',
    	'post_graguation',
    	'others',
    	'caste_certificate',
    ];
}
