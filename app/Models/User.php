<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'profile_pic',
        'contact_number',
        'address',
        'type', 
        'email',
        'password', 
        'postal_code', 
        'city_id', 
        'state_id', 
        'profile_completed', 
        'email_verify',  
        'mobile_verified_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userInfo() {
        return $this->hasOne(FormUserInfo::class);
    }

    public function userQualification() {
        return $this->hasOne(FormUserQualification::class);
    }

    public function city() {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function stateName() {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }

}
