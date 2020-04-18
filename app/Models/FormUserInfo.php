<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormUserInfo extends Model
{
    protected $fillable = [
    	'user_id',
    	'father_name',
    	'mother_name',
    	'category_id',
    	'aadhaar_number',
    	'aadhaar_img_front',
    	'aadhaar_img_back',
    	'licence_or_voter_id_number'
    ];
}
