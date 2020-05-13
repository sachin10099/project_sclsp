<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = [
    	'user_id',
        'slug',
    	'job_title',
    	'job_desc',
    	'state_id',
    	'job_location',
    	'job_type',
    	'job_published',
    	'job_deadline',
    	'vacancy',
    	'feature_image',
        'status',
        'price',
        'obc_fees',
        'sc_st_fees'
    ];

    public function getState() {
        return $this->hasOne(State::class, 'id', 'state_id');
    }
}
