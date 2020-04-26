<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function insertStates()
    {
    	$base_url = \URL::to('/');
    	$states = file_get_contents($base_url.'/states.json');
    	$data = json_decode($states, true);
    	for ($i=0; $i < count($data); $i++) { 
    		City::create(
                    [
                        'name' => $data[$i]['name']
                    ]
                );
		}
    	dd('Inserted Successfully');
    }
}
