<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppliedJob extends Model
{
    protected $fillable = [
        'order_id',
    	'user_id',
    	'job_id',
    	'status',
    	'amount',
    	'amount_status',
        'transaction_id',
        'accepted_by',
        'rejection_region',
        'verified_by_user',
        'user_query'
    ];

    public function jobReleatedUser() {
    	return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getJobDetail() {
        return $this->belongsTo(Job::class, 'job_id', 'id');
    }

    public function documents() {
        return $this->hasMany(JobRelatedDocument::class, 'applied_job_id', 'id')->where('user_id','=', \Auth::id());
    }

     public function jobAcceptedBy() {
        return $this->belongsTo(User::class, 'accepted_by', 'id');
    }
}
