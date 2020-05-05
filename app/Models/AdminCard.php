<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminCard extends Model
{
    protected $fillable = [
    	'title',
    	'official_link',
    	'type',
    	'status'
    ];

    public function getRetaltedDoc() {
    	return $this->hasMany(AdmitCardDocument::class, 'admin_cards_id', 'id');
    }
}
