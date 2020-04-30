<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppliedJob extends Model
{
    protected $fillable = [
    	'user_id',
    	'job_id',
    	'status',
    	'amount',
    	'amount_status',
        'transaction_id'
    ];

    public function jobReleatedUser() {
    	return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getJobDetail() {
        return $this->belongsTo(Job::class, 'job_id', 'id');
    }

    public function documents() {
        return $this->hasOne(JobRelatedDocument::class, 'id', 'applied_job_id');
    }
}
