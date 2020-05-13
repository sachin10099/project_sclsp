<?php

namespace App\Http\Controllers\Operator;

use App\Models\User;
use App\Models\City;
use App\Models\State;
use App\Models\ContactUs;
use App\Models\SocialLink;
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
                'name'             => 'required|max:150',
                'email'            => 'required|email|max:255|unique:users',
                'contact_number'   => 'required|digits:10|unique:users',
                'state'            => 'required|integer',
                'city'             => 'required|integer',
                'pincode'          => 'required|digits:6|integer',
                'address'          => 'required|max:225',
                'checkbox'         => 'required',
                'password'         => 'required||max:150',
                'confirm_password' => 'required||max:150|same:password'
            ],
            [
            	'confirm_password.same' => 'Password does not matched.'
            ]

        );
        $user = User::create(
        	[
        		'name'           => $request->name,
        		'email'          => $request->email,
        		'contact_number' => $request->contact_number,
        		'state_id'       => $request->state,
        		'city_id'        => $request->city,
        		'postal_code'    => $request->pincode,
        		'accept_terms'   => $request->checkbox,
        		'address'        => $request->address,
        		'password'       => \Hash::make($request->password),
        		'type'           => 'operator'
        	]
        );
        $token = $this->userVerificationProcess($user);
        $url   = url('/').'/verify/email/'.$token;
        $user->notify(New EmailVerificationNotification($url));
        return redirect('form-filler/login')->with('success', 'Your Account Created Successfully.');
    }

    public function operatorSignUpView() {
        $data['contacts']       = ContactUs::where('slug', 'contact')->get();
        $data['contact_info']   = User::where('type', 'admin')->first();
        $data['facebook_link']  = SocialLink::where('slug', 'facebook')->first();
        $data['twitter_link']   = SocialLink::where('slug', 'twitter')->first();
        $data['insta_link']     = SocialLink::where('slug', 'insta')->first();
        $data['linkedin_link']  = SocialLink::where('slug', 'linkedin')->first();
        $data['states']         = State::get();
        $data['cities']         = City::get();
        return view('formfiller.operator_signup', compact('data'));
    }
}
