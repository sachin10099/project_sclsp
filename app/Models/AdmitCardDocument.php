<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdmitCardDocument extends Model
{
    protected $fillable = [
    	'admin_cards_id',
    	'region_name',
    	'documents',
    	'official_links'
    ];
}
