<?php

namespace App\Http\Controllers\Operator;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Concern\GlobalTrait;
use App\Notifications\EmailVerificationNotification;

class OperatorController extends Controller
{
	use GlobalTrait;
    /**
     * Operator Sign Up
     * @category Operator Management
     * @package  Operator Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */

    public function signup(Request $request) {
    	$request->validate(
            [
                'operator_name'             => 'required|max:150',
                'operator_email'            => 'required|email|max:255|unique:users',
                'operator_contact_number'   => 'required|digits:10|unique:users',
                'operator_state'            => 'required|integer',
                'operator_city'             => 'required|integer',
                'operator_pincode'          => 'required|digits:6|integer',
                'operator_address'          => 'required|max:225',
                'operator_checkbox'         => 'required',
                'operator_password'         => 'required||max:150',
                'operator_confirm_password' => 'required||max:150|same:operator_password'
            ],
            [
            	'operator_confirm_password.same' => 'Password does not matched.'
            ]

        );
        $user = User::create(
        	[
        		'name'           => $request->operator_name,
        		'email'          => $request->operator_email,
        		'contact_number' => $request->operator_contact_number,
        		'state_id'       => $request->operator_state,
        		'city_id'        => $request->operator_city,
        		'postal_code'    => $request->operator_pincode,
        		'accept_terms'   => $request->operator_checkbox,
        		'address'        => $request->operator_address,
        		'password'       => \Hash::make($request->operator_password),
        		'type'           => 'operator'
        	]
        );
        $token = $this->userVerificationProcess($user);
        $url   = url('/').'/verify/email/'.$token;
        $user->notify(New EmailVerificationNotification($url));
        return redirect('form-filler/login')->with('success', 'Your Account Created Successfully.');
    }
}
