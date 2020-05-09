<?php

namespace App\Http\Controllers\Admin;

use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\SupportCenter;
use App\Models\UserVerification;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Concern\GlobalTrait;
use App\Notifications\ForgotPasswordNotification;

class AuthController extends Controller
{
    use GlobalTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.login');
    }

    /**
     * Display a Forgot Password Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function forgot()
    {
        return view('forgot');
    }

    /**
     * Login 
     *
     * @category Admin User Management
     * @package  Admin User Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function login(Request $request) {
        $request->validate(
            [
                'email'    => 'required|email',
                'password' => 'required'
            ]
        );
        $credentials = [
            'email'    => $request['email'],
            'password' => $request['password'],
        ];
        if(\Auth::attempt($credentials)) {
            return redirect('admin/dashboard');       
        }
        return redirect('admin/login')->with('error', 'Invalid login credentials.'); 
    }


    /**
     * Go to Send Reset Password Link
     *
     * @category Admin User Management
     * @package  Admin User Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function sendRestLink(Request $request) {
        $request->validate(
            [
                'email'    => 'required|email'
            ]
        );
        $token = \Str::random(8);
        $url   = url('/').'/reset/password/'.$token;
        $user  = User::where('email', $request->email)->first();
        if(!$user) {
            return redirect()->back()->with('error', 'User not exist!');
        }
        UserVerification::create(
            [
                'email'   => $user->email,
                'token'   => $token,
                'user_id' => $user->id
            ]
        );
        $user->notify(new ForgotPasswordNotification($url));
        return redirect()->back()->with('success', 'Reset password link has been successfully send on your mail id.');
    }


    public function resetPassView($token) {
        $now_reduce_mins =  \Carbon\Carbon::now()->addMinutes(-15)->toDateTimeString();
        $find = UserVerification::where('token', $token)
            ->where('created_at', '>=', $now_reduce_mins)
            ->first();
        if(!$find) {
            return redirect('forgot/password')->with('error', 'Token may be expired or does not exist.');
        }
        $id = $find->id;
        return view('reset', compact('id'));
    }

    /**
     * Create New Password
     *
     * @category Admin User Management
     * @package  Admin User Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function resetPass(Request $request)
    {
        $request->validate(
            [
                'pass'     => 'required',
                'confirm_pass' => 'required|same:pass',
            ],
            [
               'confirm_pass.same' => 'Password can not matched.'
            ]
        );
        $find = UserVerification::find($request->id);
        $user = User::find($find->user_id);
        $user->update(
            [
                'password' => \Hash::make($request->pass)
            ]
        );
        $find->delete();
        return redirect('admin/login')->with('success', 'Password Updated Successfully!');
    }

    /**
     * Goto Dashboard View
     *
     * @category Admin User Management
     * @package  Admin User Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function dashboard()
    {
        $data['job_count'] = Job::count();
        $data['form_filler_user_count'] = User::where('type', 'form_user')->count();
        $data['query_count']    = SupportCenter::where('replied_at', 'No')->count();
        return view('admin.dashboard', compact('data'));
    }

    /**
     * Manage Profile
     *
     * @category Admin User Management
     * @package  Admin User Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function profile()
    {
        return view('admin.profile');
    }

    /**
     * Edit Admin Profile
     *
     * @category Admin User Management
     * @package  Admin User Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function editProfile() {
        return view('admin.edit_profile');
    }

    /**
     * Update Admin Profile
     *
     * @category Admin User Management
     * @package  Admin User Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function updateProfile(Request $request) {
        $request->validate(
            [
                'name'    => 'max:150',
                'contact_number' => 'numeric|digits:10|unique:users,contact_number,'.\Auth::id(),
                'email'   => 'email|unique:users,email,'.\Auth::id(),
                'address' => 'max:200',
                'image'   => 'mimes:jpeg,jpg,png|max:10000'
            ]
        );

        $url = $this->imageUpload($request);
        \Auth::user()->update(
            [
                'name'           => $request->name,
                'email'          => $request->email,
                'address'        => $request->address,
                'contact_number' => $request->contact_number,
                'profile_pic'    => $url
            ]
        );
        return redirect('admin/profile')->with('success', 'Profile Updated Successfully.');
    }


    /**
     * Change Admin Password
     *
     * @category Admin User Management
     * @package  Admin User Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function changePasswordView(Request $request) {
        return view('admin.change_password');
    }

    /**
     * Update Admin Password
     *
     * @category Admin User Management
     * @package  Admin User Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function changePassword(Request $request) {
        $request->validate(
            [
                'old_password'     => 'required',
                'new_password'     => 'required',
                'confirm_password' => 'required|same:new_password',
            ],
            [
               'confirm_password.same' => 'Password does not matched.'
            ]
        );
        if(!\Hash::check($request->old_password, \Auth::user()->password)) {
            return redirect()->back()->with('error', 'Incorrect Old Password!');
        }
        \Auth::user()->update(
            [
                'password' => \Hash::make($request->new_password)
            ]
        );
        return redirect('admin/profile')->with('success', 'Password Updated Successfully!');
    }

    /**
     * Logout Function
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function logout(Request $request) {
        if(\Auth::user()->type == 'admin') {
            $url = 'admin/login';
        } else {
             $url = 'form-filler/login';
        }
        \Auth::logout();
        \Session::flush();
        return redirect($url);
    }

   
}
