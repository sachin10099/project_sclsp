<?php

namespace App\Http\Controllers\FormFiller;

use App\Models\Faq;
use App\Models\Home;
use App\Models\User;
use App\Models\About;
use App\Models\Scope;
use App\Models\Service;
use App\Models\City;
use App\Models\State;
use App\Models\Job;
use App\Models\Plan;
use App\Models\Result;
use App\Models\Category;
use App\Models\ContactUs;
use App\Models\Subscribe;
use App\Models\AdminCard;
use App\Models\SocialLink;
use App\Models\AppliedJob;
use App\Models\Testimonial;
use App\Models\Notification;
use App\Models\FormUserInfo;
use Illuminate\Http\Request;
use App\Models\SupportCenter;
use App\Models\UserVerification;
use Yajra\Datatables\Datatables;
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
        $data['plans']           = Plan::get();
        $data['form_user_count'] = User::where('type', 'form_user')->count();
        $data['jobs']            = Job::where('status', 'active')->count();
        $data['applied_job']     = AppliedJob::count();
        $data['admin_info']      = User::where('type', 'admin')->first();
        $data['job_lists']       = Job::where('status', 'active')->orderBy('created_at', 'DESC')->limit(10)->get();
        $data['results']         = Result::where('status', 'active')->orderBy('created_at', 'DESC')->limit(10)->get();
        $data['admit_cards']     = AdminCard::where('status', 'active')->where('type', 'admit_card')->orderBy('created_at', 'DESC')->limit(10)->get();
        $data['answer_keys']     = AdminCard::where('status', 'active')->where('type', 'answer_key')->orderBy('created_at', 'DESC')->limit(10)->get();

        return view('formfiller.index' ,compact('data'));
    }

     /**
     * Results List 
     *
     * @category Form Filler Management
     * @package  Form Filler Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function result() {
        $data['admin_info']      = User::where('type', 'admin')->first();
        $data['results']         = Result::where('status', 'active')->orderBy('created_at', 'DESC')->paginate(20);
        return view('formfiller.result_list', compact('data'));
    }

    /**
    *Admit Card List 
    *
    * @category Form Filler Management
    * @package  Form Filler Management
    * @author   Sachiln Kumar <sachin679710@gmail.com>
    * @license  PHP License 7.2.24
    * @link
    */
    public function admitCards() {
        $data['admin_info']      = User::where('type', 'admin')->first();
        $data['admit_cards']     = AdminCard::where('status', 'active')->where('type', 'admit_card')->orderBy('created_at', 'DESC')->paginate(20);
        return view('formfiller.admit_card_list', compact('data'));
    }

    /**
    *Answer Key List 
    *
    * @category Form Filler Management
    * @package  Form Filler Management
    * @author   Sachiln Kumar <sachin679710@gmail.com>
    * @license  PHP License 7.2.24
    * @link
    */
    public function answerKeyDetail($id) {
        $data['admin_info']        = User::where('type', 'admin')->first();
        $data['answerKeyDetails']  = AdminCard::with('getRetaltedDoc')->where('id', $id)->first();
        return view('formfiller.answer_key_detail', compact('data'));
    }

    /**
    * Answer Key Detail
    *
    * @category Form Filler Management
    * @package  Form Filler Management
    * @author   Sachiln Kumar <sachin679710@gmail.com>
    * @license  PHP License 7.2.24
    * @link
    */
    public function answerKeys() {
        $data['admin_info']      = User::where('type', 'admin')->first();
        $data['answerKeys']     = AdminCard::where('status', 'active')->where('type', 'answer_key')->orderBy('created_at', 'DESC')->paginate(20);
        return view('formfiller.anser_key_list', compact('data'));
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
        $data['contacts']       = ContactUs::where('slug', 'contact')->get();
        $data['contact_info']   = User::where('type', 'admin')->first();
        $data['facebook_link']  = SocialLink::where('slug', 'facebook')->first();
        $data['twitter_link']   = SocialLink::where('slug', 'twitter')->first();
        $data['insta_link']     = SocialLink::where('slug', 'insta')->first();
        $data['linkedin_link']  = SocialLink::where('slug', 'linkedin')->first();
        $data['states']         = State::get();
        $data['cities']         = City::get();
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
                'contact_number'    => 'required|digits:10|unique:users',
                'address'           => 'required|max:225',
                'user_password'     => 'required',
                'checkbox'         => 'required',
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
                'accept_terms'   => $request->checkbox,
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
        $data['pending_job_count'] = AppliedJob::where('user_id', \Auth::id())->where('status', 'pending')->count();
        $data['ongoing_job_count'] = AppliedJob::where('user_id', \Auth::id())->where('status', 'on_going')->count();
        $data['completed_job_count'] = AppliedJob::where('user_id', \Auth::id())->where('status', 'completed')->count();
        $data['reject_job_count']    = AppliedJob::where('user_id', \Auth::id())->where('status', 'reject')->count();
        $data['admissions']          = Job::where('slug', 'admission')->where('status', 'active')->orderBy('created_at', 'DESC')->limit(5)->get();
        return view('formfiller.dashboard', compact('data'));
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
                'gender'            => 'required',
                'dob'               => 'required',
                'f_name'            => 'required|max:150',
                'm_name'            => 'required|max:150',
                'contact_number'    => 'required|digits:10',
                'address'           => 'required|max:225',
                'postal_code'       => 'required|digits:6|integer',
                'l_v_id'            => 'required|integer',
                'aadhaar'           => 'required|digits:12|integer',
                'aadhaar_front'     => 'required|mimes:jpeg,jpg,png|max:2000',
                'aadhaar_back'      => 'required|mimes:jpeg,jpg,png|max:2000',
                'tenth'             => 'required|mimes:jpeg,jpg,png|max:2000',
                'tweleth'           => 'required|mimes:jpeg,jpg,png|max:2000',
                'tweleth'           => 'required|mimes:jpeg,jpg,png|max:2000',
                'diploma'           => 'mimes:jpeg,jpg,png|max:2000',
                'caste'             => 'required|mimes:jpeg,jpg,png|max:2000',
                'graguation'        => 'required|mimes:jpeg,jpg,png|max:2000',
                'postgraguation'    => 'mimes:jpeg,jpg,png|max:2000',
                'others'            => 'mimes:jpeg,jpg,png|max:2000'
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
                'licence_or_voter_id_number' => $request->l_v_id,
                'gender'                     => $request->gender,
                'dob'                        => $request->dob
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
        return redirect('form-filler/dashboard')->with('success', 'Your Profile Completed Successfully.');
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
                'email'             => 'required|email|max:255|unique:users,email,'.\Auth::user()->id.',id',
                'f_name'            => 'required|max:150',
                'm_name'            => 'required|max:150',
                'contact_number'    => 'required|digits:10,|unique:users,contact_number,'.\Auth::user()->id,
                'address'           => 'required|max:225',
                'postal_code'       => 'required|digits:6|integer',
                'l_v_id'            => 'required|integer',
                'aadhaar'           => 'required|digits:12|integer',
                'aadhaar_front'     => 'mimes:jpeg,jpg,png|max:10000',
                'aadhaar_back'      => 'mimes:jpeg,jpg,png|max:10000',
                'tenth'             => 'mimes:jpeg,jpg,png|max:10000',
                'tweleth'           => 'mimes:jpeg,jpg,png|max:10000',
                'tweleth'           => 'mimes:jpeg,jpg,png|max:10000',
                'diploma'           => 'mimes:jpeg,jpg,png|max:10000',
                'caste'             => 'mimes:jpeg,jpg,png|max:10000',
                'graguation'        => 'mimes:jpeg,jpg,png|max:10000',
                'postgraguation'    => 'mimes:jpeg,jpg,png|max:10000',
                'others'            => 'mimes:jpeg,jpg,png|max:10000'
            ] 
        );
        $user = \Auth::user()->update(
            [
                'name'              => $request->name,
                'email'             => $request->email,
                'contact_number'    => $request->contact_number,
                'address'           => $request->address,
                'profile_completed' => 'Yes',
                'postal_code'       => $request->postal_code,
                'city_id'           => $request->city
            ]
        );

        $more_info = FormUserInfo::where('user_id', \Auth::id())->first();
        $url_front = $this->formFillerUserDocumentUpdate($request, 'aadhaar_front', $more_info->aadhaar_img_front ? $more_info->aadhaar_img_front : null);
        $url_back = $this->formFillerUserDocumentUpdate($request, 'aadhaar_back', $more_info->aadhaar_img_back ? $more_info->aadhaar_img_back : null);

        $more_info->update(
            [
                'user_id'                    => \Auth::id(),
                'father_name'                => $request->f_name,
                'mother_name'                => $request->m_name,
                'category_id'                => $request->category,
                'aadhaar_number'             => $request->aadhaar,
                'aadhaar_img_front'          => $url_front,
                'aadhaar_img_back'           => $url_back,
                'licence_or_voter_id_number' => $request->l_v_id,
                'gender'                     => $request->gender,
                'dob'                        => $request->dob
            ]
        );

        $qualification = FormUserQualification::where('user_id', \Auth::id())->first();
        $tenth_url           = $this->formFillerUserDocumentUpdate($request, 'tenth', $qualification->tenth_doc_image ? $qualification->tenth_doc_image : null);
        $twelth_url          = $this->formFillerUserDocumentUpdate($request, 'tweleth', $qualification->tweleth_doc_image ? $qualification->tweleth_doc_image : null);
        $diploma_url         = $this->formFillerUserDocumentUpdate($request, 'diploma', $qualification->diploma_doc_image ? $qualification->diploma_doc_image : null);
        $graguation_url      = $this->formFillerUserDocumentUpdate($request, 'graguation', $qualification->graguation ? $qualification->graguation : null);
        $post_graguation_url = $this->formFillerUserDocumentUpdate($request, 'postgraguation', $qualification->post_graguation ? $qualification->post_graguation : null);
        $caste_url           = $this->formFillerUserDocumentUpdate($request, 'caste', $qualification->caste_certificate ? $qualification->caste_certificate : null);
        $others_url          = $this->formFillerUserDocumentUpdate($request, 'others', $qualification->others ? $qualification->others : null);

        $qualification->update(
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
        return redirect()->back()->with('success', 'Your Profile Updated Successfully.');
    }


    /**
    * Update User Profile Photo
    * @category Form Filler Management
    * @package  Form Filler Management
    * @author   Sachiln Kumar <sachin679710@gmail.com>
    * @license  PHP License 7.2.24
    * @link
    */
    public function profilePic(Request $request) {
        $request->validate(
            [
                'image' => 'mimes:jpeg,jpg,png|max:10000'
            ]
        );
        $url = $this->imageUpload($request);
        \Auth::user()->update(
            [
                'profile_pic' => $url
            ]
        );
        return redirect()->back()->with('success', 'Your Profile Photo Updated Successfully.');

    }

     /**
    * Notifications
    * @category Form Filler Management
    * @package  Form Filler Management
    * @author   Sachiln Kumar <sachin679710@gmail.com>
    * @license  PHP License 7.2.24
    * @link
    */
    public function notifications() {
        $notifications = \Auth::user()->notifications()->paginate(10);
        return view('formfiller.notification', compact('notifications'));
    }

    /**
    * Notifications
    * @category Form Filler Management
    * @package  Form Filler Management
    * @author   Sachiln Kumar <sachin679710@gmail.com>
    * @license  PHP License 7.2.24
    * @link
    */
    public function deleteNotification(Request $request) {
        \Auth::user()->notifications()
        ->where('id', $request->id)->delete();
        return 'Deleted Successfully.';
    }

    /**
    * Notifications Read
    * @category Form Filler Management
    * @package  Form Filler Management
    * @author   Sachiln Kumar <sachin679710@gmail.com>
    * @license  PHP License 7.2.24
    * @link
    */
    public function readNotification($notification_id, $job_id) {
        $data = Notification::where('id', $notification_id)->first();
        $data->update(
            [
                'read_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]
        );
        $picked = \Auth::user()->notifications()->where('id', $notification_id)->first();
        if($picked->data['type'] != 'new_job') {
            $url = 'form-filler/user/details/'.$job_id;
        }else {
            $url = 'form-filler/job/profile/'.$job_id;
        }
        return redirect($url);
    }

    /**
    * Job List
    * @category Form Filler Management
    * @package  Form Filler Management
    * @author   Sachiln Kumar <sachin679710@gmail.com>
    * @license  PHP License 7.2.24
    * @link
    */
    public function jobList(Request $request) {
        $date = date("Y-m-d");
        if($request->status == 'today') {
            $data = Job::with('getState')->whereDate('job_published', $date)->where('slug', 'job')->where('status', 'active')->get();
        } else if($request->status == 'upcomening') {
            $data = Job::with('getState')->whereDate('job_published','>', $date)->where('slug', 'job')->where('status', 'active')->get();
        } else if($request->status == 'past') {
            $data = Job::with('getState')->whereDate('job_published','<', $date)->where('slug', 'job')->where('status', 'active')->get();
        }
        return Datatables::of($data)
            ->addColumn('state_name', function ($data) {
                return $data->getState['name'];
            })
            
            ->addColumn('assign_price', function ($data) {

                return '<input type="text" id="price'.$data->id.'" class="form-control" value="'.$data->price.'">';
            })
            ->addColumn('publish', function ($data) {
                $publish = date('d-m-Y', strtotime($data->job_published));
                return $publish;
            })
            ->addColumn('end', function ($data) {
                $end = date('d-m-Y', strtotime($data->job_deadline));
                return $end;
            })
            ->addColumn('image', function ($data) {
                return '<img src="'.$data->feature_image.'" style="max-width:100px;max-height:100spx;">';
            })
            ->addColumn('action', function ($data) {
                 $date = date("Y-m-d");
                if($data->job_published > $date) {
                    return '
                        <p>Not Required</p>
                        ';
                } elseif ($data->job_published && $data->job_deadline < $date) {
                    return '
                       <p>Not Required</p>
                        ';
                } else {
                    return '
                        <a href="profile/'.$data->id.'"><i class="fa fa-eye" aria-hidden="true" style="color:#00bfff;font-size:20px;" data-toggle="tooltip" title="More info"></i></a>
                        ';
                }
                
               
            })
            ->rawColumns([
                'image',
                'action'
            ])
            ->make(true);
    }

    public function listView() {
        return view('formfiller.jobs');
    }

    public function jobProfile($id) {
        $data = Job::find($id);
        $fees = $this->siteConfig('FEES');
        return view('formfiller.job_profile', compact('data', 'fees'));
    }

    /**
    * Job List
    * @category Form Filler Management
    * @package  Form Filler Management
    * @author   Sachiln Kumar <sachin679710@gmail.com>
    * @license  PHP License 7.2.24
    * @link
    */
    public function admissionList(Request $request) {
        $date = date("Y-m-d");
        if($request->status == 'today') {
            $data = Job::with('getState')->whereDate('job_published', $date)->where('slug', 'admission')->where('status', 'active')->get();
        } else if($request->status == 'upcomening') {
            $data = Job::with('getState')->whereDate('job_published','>', $date)->where('slug', 'admission')->where('status', 'active')->get();
        } else if($request->status == 'past') {
            $data = Job::with('getState')->whereDate('job_published','<', $date)->where('slug', 'admission')->where('status', 'active')->get();
        }
        return Datatables::of($data)
            ->addColumn('state_name', function ($data) {
                return $data->getState['name'];
            })
            
            ->addColumn('assign_price', function ($data) {

                return '<input type="text" id="price'.$data->id.'" class="form-control" value="'.$data->price.'">';
            })
            ->addColumn('publish', function ($data) {
                $publish = date('d-m-Y', strtotime($data->job_published));
                return $publish;
            })
            ->addColumn('end', function ($data) {
                $end = date('d-m-Y', strtotime($data->job_deadline));
                return $end;
            })
            ->addColumn('image', function ($data) {
                return '<img src="'.$data->feature_image.'" style="max-width:100px;max-height:100spx;">';
            })
            ->addColumn('action', function ($data) {
                 $date = date("Y-m-d");
                if($data->job_published > $date) {
                    return '
                        <p>Not Required</p>
                        ';
                } elseif ($data->job_published && $data->job_deadline < $date) {
                    return '
                       <p>Not Required</p>
                        ';
                } else {
                    return '
                        <a href="job/profile/'.$data->id.'"><i class="fa fa-eye" aria-hidden="true" style="color:#00bfff;font-size:20px;" data-toggle="tooltip" title="More info"></i></a>
                        ';
                }
                
               
            })
            ->rawColumns([
                'image',
                'action'
            ])
            ->make(true);
    }

    public function admissionListView() {
        return view('formfiller.admissions');
    }


}
