<?php

namespace App\Http\Controllers\FormFiller;

use App\Models\Faq;
use App\Models\Home;
use App\Models\User;
use App\Models\About;
use App\Models\Scope;
use App\Models\Service;
use App\Models\ContactUs;
use App\Models\Subscribe;
use App\Models\SocialLink;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Models\SupportCenter;
use App\Models\UserVerification;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Concern\GlobalTrait;
use App\Notifications\EmailVerificationNotification;

class FormFillerController extends Controller
{
    use GlobalTrait;
     /**
     * View 
     *
     * @category Form Filler Management
     * @package  Form Filler Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function index()
    {
        return view('formfiller.index' ,compact('data'));
    }

     /**
     * Sign Up view of User And operator 
     *
     * @category Form Filler Management
     * @package  Form Filler Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function signUpForm()
    {
        $data['contacts']      = ContactUs::where('slug', 'contact')->get();
        $data['contact_info']  = User::where('type', 'admin')->first();
        $data['facebook_link']  = SocialLink::where('slug', 'facebook')->first();
        $data['twitter_link']   = SocialLink::where('slug', 'twitter')->first();
        $data['insta_link']     = SocialLink::where('slug', 'insta')->first();
        $data['linkedin_link']  = SocialLink::where('slug', 'linkedin')->first();
        return view('formfiller.signup' ,compact('data'));
    }

      /**
     * Login Page useful by users and operator 
     *
     * @category Form Filler Management
     * @package  Form Filler Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function loginView()
    {
        $data['contacts']      = ContactUs::where('slug', 'contact')->get();
        $data['contact_info']  = User::where('type', 'admin')->first();
        $data['facebook_link']  = SocialLink::where('slug', 'facebook')->first();
        $data['twitter_link']   = SocialLink::where('slug', 'twitter')->first();
        $data['insta_link']     = SocialLink::where('slug', 'insta')->first();
        $data['linkedin_link']  = SocialLink::where('slug', 'linkedin')->first();
        return view('formfiller.login' ,compact('data'));
    }

      /**
     * User Registration
     *
     * @category Form Filler Management
     * @package  Form Filler Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function userSignUp(Request $request)
    {
        $request->validate(
            [
                'user_name'         => 'required|max:150',
                'email'             => 'required|email|max:225|unique:users',
                'contact_number'    => 'required|digits:10',
                'address'           => 'required|max:225',
                'user_password'     => 'required',
                'user_confirm_pass' => 'required|same:user_password',
            ],
            [
                'user_confirm_pass.same' => 'Password does not matched.'
            ]
        );
        $user = User::create(
            [
                'name'           => $request->user_name,
                'type'           => 'form_user',
                'email'          => $request->email,
                'contact_number' => $request->contact_number,
                'address'        => $request->address,
                'password'       => \Hash::make($request->user_password)
            ]
        ); 
        $token = $this->userVerificationProcess($user);
        $url   = url('/').'/verify/email/'.$token;
        $user->notify(New EmailVerificationNotification($url));
        return redirect('form-filler/login')->with('success', 'Your Account Created Successfully.');
    }

    /**
     *  Dashboard
     * @category Form Filler Management
     * @package  Form Filler Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */

    public function dashboard() {
        return view('formfiller.dashboard');
    }

}
