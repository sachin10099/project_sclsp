<?php

namespace App\Http\Controllers\FormFiller;

use App\Models\Faq;
use App\Models\Home;
use App\Models\User;
use App\Models\About;
use App\Models\Scope;
use App\Models\Service;
use App\Models\City;
use App\Models\Category;
use App\Models\ContactUs;
use App\Models\Subscribe;
use App\Models\SocialLink;
use App\Models\Testimonial;
use App\Models\FormUserInfo;
use Illuminate\Http\Request;
use App\Models\SupportCenter;
use App\Models\UserVerification;
use App\Http\Controllers\Controller;
use App\Models\FormUserQualification;
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
        if(\Auth::user()->profile_completed == 'No') {
            $data['city']       = City::get();
            $data['categories'] = Category::get();
            return view('formfiller.profile', compact('data'));
        }
        return view('formfiller.dashboard');
    }

    /**
     *  User Profile
     * @category Form Filler Management
     * @package  Form Filler Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */

    public function profile() {
        $data['city']       = City::get();
        $data['categories'] = Category::get();
        $user_infos = User::where('id', \Auth::id())
            ->with(
                [
                    'userInfo',
                    'userQualification'
                ]
            )->first();
        return view('formfiller.profile', compact('data', 'user_infos'));
    }


    /**
     * Complete User Profile
     * @category Form Filler Management
     * @package  Form Filler Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */

    public function completeProfile(Request $request) {
        $request->validate(
            [
                'name'              => 'required|max:150',
                'f_name'            => 'required|max:150',
                'm_name'            => 'required|max:150',
                'contact_number'    => 'required|digits:10',
                'address'           => 'required|max:225',
                'postal_code'       => 'required|digits:6|integer',
                'l_v_id'            => 'required|integer',
                'aadhaar'           => 'required|digits:12|integer',
                'aadhaar_front'     => 'required|mimes:jpeg,jpg,png|max:10000',
                'aadhaar_back'      => 'required|mimes:jpeg,jpg,png|max:10000',
                'tenth'             => 'required|mimes:jpeg,jpg,png|max:10000',
                'tweleth'           => 'required|mimes:jpeg,jpg,png|max:10000',
                'tweleth'           => 'required|mimes:jpeg,jpg,png|max:10000',
                'diploma'           => 'mimes:jpeg,jpg,png|max:10000',
                'caste'             => 'required|mimes:jpeg,jpg,png|max:10000',
                'graguation'        => 'required|mimes:jpeg,jpg,png|max:10000',
                'postgraguation'    => 'mimes:jpeg,jpg,png|max:10000',
                'others'            => 'mimes:jpeg,jpg,png|max:10000'
            ] 
        );
        $user = \Auth::user()->update(
            [
                'name'              => $request->name,
                'contact_number'    => $request->contact_number,
                'address'           => $request->address,
                'profile_completed' => 'Yes',
                'postal_code'       => $request->postal_code,
                'city_id'           => $request->city
            ]
        );

        $url_front = $this->formFillerUserDocumentUpload($request, 'aadhaar_front');
        $url_back = $this->formFillerUserDocumentUpload($request, 'aadhaar_back');

        $more_info = FormUserInfo::create(
            [
                'user_id'                    => \Auth::id(),
                'father_name'                => $request->f_name,
                'mother_name'                => $request->m_name,
                'category_id'                => $request->category,
                'aadhaar_number'             => $request->aadhaar,
                'aadhaar_img_front'          => $url_front,
                'aadhaar_img_back'           => $url_back,
                'licence_or_voter_id_number' => $request->l_v_id
            ]
        );

        $tenth_url           = $this->formFillerUserDocumentUpload($request, 'tenth');
        $twelth_url          = $this->formFillerUserDocumentUpload($request, 'tweleth');
        $diploma_url         = $this->formFillerUserDocumentUpload($request, 'diploma');
        $graguation_url      = $this->formFillerUserDocumentUpload($request, 'graguation');
        $post_graguation_url = $this->formFillerUserDocumentUpload($request, 'postgraguation');
        $caste_url           = $this->formFillerUserDocumentUpload($request, 'caste');
        $others_url          = $this->formFillerUserDocumentUpload($request, 'others');

        $qualification = FormUserQualification::create(
            [
                'user_id'           => \Auth::id(),
                'tenth_doc_image'   => $tenth_url,
                'tweleth_doc_image' => $twelth_url,
                'diploma_doc_image' => $diploma_url,
                'graguation'        => $graguation_url,
                'post_graguation'   => $post_graguation_url,
                'others'            => $others_url,
                'caste_certificate' => $caste_url
            ]
        );
        return redirect('form-filler/dashboard')->with('success', 'Your Profile Updated Successfully.');
    }


    /**
     * Update User Profile
     * @category Form Filler Management
     * @package  Form Filler Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */

    public function updateProfile(Request $request) {
        $request->validate(
            [
                'name'              => 'required|max:150',
                'f_name'            => 'required|max:150',
                'm_name'            => 'required|max:150',
                'contact_number'    => 'required|digits:10',
                'address'           => 'required|max:225',
                'postal_code'       => 'required|digits:6|integer',
                'l_v_id'            => 'required|integer',
                'aadhaar'           => 'required|digits:12|integer',
                'aadhaar_front'     => 'required|mimes:jpeg,jpg,png|max:10000',
                'aadhaar_back'      => 'required|mimes:jpeg,jpg,png|max:10000',
                'tenth'             => 'required|mimes:jpeg,jpg,png|max:10000',
                'tweleth'           => 'required|mimes:jpeg,jpg,png|max:10000',
                'tweleth'           => 'required|mimes:jpeg,jpg,png|max:10000',
                'diploma'           => 'mimes:jpeg,jpg,png|max:10000',
                'caste'             => 'required|mimes:jpeg,jpg,png|max:10000',
                'graguation'        => 'required|mimes:jpeg,jpg,png|max:10000',
                'postgraguation'    => 'mimes:jpeg,jpg,png|max:10000',
                'others'            => 'mimes:jpeg,jpg,png|max:10000'
            ] 
        );
        $user = \Auth::user()->update(
            [
                'name'              => $request->name,
                'contact_number'    => $request->contact_number,
                'address'           => $request->address,
                'profile_completed' => 'Yes',
                'postal_code'       => $request->postal_code,
                'city_id'           => $request->city
            ]
        );

        $url_front = $this->formFillerUserDocumentUpload($request, 'aadhaar_front');
        $url_back = $this->formFillerUserDocumentUpload($request, 'aadhaar_back');

        $more_info = FormUserInfo::create(
            [
                'user_id'                    => \Auth::id(),
                'father_name'                => $request->f_name,
                'mother_name'                => $request->m_name,
                'category_id'                => $request->category,
                'aadhaar_number'             => $request->aadhaar,
                'aadhaar_img_front'          => $url_front,
                'aadhaar_img_back'           => $url_back,
                'licence_or_voter_id_number' => $request->l_v_id
            ]
        );

        $tenth_url           = $this->formFillerUserDocumentUpload($request, 'tenth');
        $twelth_url          = $this->formFillerUserDocumentUpload($request, 'tweleth');
        $diploma_url         = $this->formFillerUserDocumentUpload($request, 'diploma');
        $graguation_url      = $this->formFillerUserDocumentUpload($request, 'graguation');
        $post_graguation_url = $this->formFillerUserDocumentUpload($request, 'postgraguation');
        $caste_url           = $this->formFillerUserDocumentUpload($request, 'caste');
        $others_url          = $this->formFillerUserDocumentUpload($request, 'others');

        $qualification = FormUserQualification::create(
            [
                'user_id'           => \Auth::id(),
                'tenth_doc_image'   => $tenth_url,
                'tweleth_doc_image' => $twelth_url,
                'diploma_doc_image' => $diploma_url,
                'graguation'        => $graguation_url,
                'post_graguation'   => $post_graguation_url,
                'others'            => $others_url,
                'caste_certificate' => $caste_url
            ]
        );
        return redirect('form-filler/dashboard')->with('success', 'Your Profile Updated Successfully.');
    }



}
