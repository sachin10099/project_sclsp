<?php

namespace App\Http\Controllers\FormFiller;

use App\Models\Job;
use App\Models\User;
use App\Models\AppliedJob;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use App\Notifications\JobApplyNotification;
use Illuminate\Support\Facades\Notification;
use App\Http\Controllers\Concern\GlobalTrait;
use App\Notifications\SendConfirmationNotification;

class JobController extends Controller
{
    use GlobalTrait;
    /**
     * Apply Job 
     *
     * @category Form Filler Management
     * @package  Form Filler Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function apply(Request $request)
    {
    	$picked = AppliedJob::where('user_id', \Auth::id())->where('job_id', $request->id)->first();
    	if($picked) {
    		if($picked->status == 'pending' && $picked->amount_status == 'unpaid'){
    			return 'unpaid';
    		} else {
    			return 'applied';
    		}
    	}
        $check = User::where('id', \Auth::id())->with(
            [
                'userInfo' => function($cat) {
                    $cat->with('getCaterory');
                }
            ]
        )->first();
        $our_fees = $this->siteConfig('FEES');
        $job = Job::find($request->id);
        if($check['userInfo']['getCaterory']['name'] == 'General') {
            $price = $job->price + $our_fees;
        } elseif ($check['userInfo']['getCaterory']['name'] == 'OBC') {
            $price = $job->obc_fees + $our_fees;
        } elseif ($check['userInfo']['getCaterory']['name'] == 'SC' || $check['userInfo']['getCaterory']['name'] == 'ST') {
            $price = $job->sc_st_fees + $our_fees;
        }
        $rand = rand(10000, 999999);
        $order_id = 'ORDER'.$rand;
        $create = AppliedJob::create(
        	[
                'order_id'=> $order_id,
        		'user_id' => \Auth::id(),
        		'job_id'  => $request->id,
        		'amount'  => $price,
        	]
        );
        $users = User::where('type', 'admin')->orWhere('type', 'operator')->get();
        Notification::send($users, new JobApplyNotification($create));
        return 'send';
    }

    /**
     * Checkout Out Page
     *
     * @category Form Filler Management
     * @package  Form Filler Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function checkout($id)
    {
        $data = AppliedJob::where('job_id', $id)->first();
       	return view('formfiller.checkout', compact('data'));
    }

    /**
     * Call Back After Razorpay Payment
     *
     * @category Form Filler Management
     * @package  Form Filler Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function success(Request $request) {
        $picked = AppliedJob::find($request->product_id);
        $picked->update(
            [
                'status'        => 'on_going',
                'amount_status' => 'paid',
                'transaction_id'=> $request->razorpay_payment_id
            ]
        );
    	return 'Your payment is successfully done.';
    }

    /**
    * User Posted Job List Page
    * @category Form Filler Management
    * @package  Form Filler Management
    * @author   Sachiln Kumar <sachin679710@gmail.com>
    * @license  PHP License 7.2.24
    * @link
    */
    public function listView() {
        return view('formfiller.our_jobs');
    }

    /**
    * User Posted Job List
    * @category Form Filler Management
    * @package  Form Filler Management
    * @author   Sachiln Kumar <sachin679710@gmail.com>
    * @license  PHP License 7.2.24
    * @link
    */
    public function jobList(Request $request) {
        if($request->status == 'ongoing') {
            $data = AppliedJob::with(
                [
                    'getJobDetail' => function($state) {
                        $state->with('getState');
                    }
                ]
            )->where('status', 'on_going')
            ->where('user_id', \Auth::id())
            ->get();
        } else if($request->status == 'completed') {
            $data = AppliedJob::with(
                [
                    'getJobDetail' => function($state) {
                        $state->with('getState');
                    }
                ]
            )->where('status', 'completed')
            ->where('user_id', \Auth::id())
            ->get();
        } else if($request->status == 'rejected') {
            $data = AppliedJob::with(
                [
                    'getJobDetail' => function($state) {
                        $state->with('getState');
                    }
                ]
            )->where('status', 'reject')->orWhere('status', 'cancled')
            ->where('user_id', \Auth::id())
            ->get();;
        }
        return Datatables::of($data)
            ->addColumn('title', function ($data) {
                return $data->getJobDetail['job_title'];
            })
            ->addColumn('job_location', function ($data) {
                return $data->getJobDetail['job_location'];
            })
            ->addColumn('job_type', function ($data) {
                return $data->getJobDetail['job_type'];
            })
            ->addColumn('state_name', function ($data) {
                return $data->getJobDetail->getState['name'];
            })
            ->addColumn('publish', function ($data) {
                $publish = date('d-m-Y', strtotime($data->getJobDetail['job_published']));
                return $publish;
            })
            ->addColumn('end', function ($data) {
                $end = date('d-m-Y', strtotime($data->getJobDetail['job_deadline']));
                return $end;
            })
            ->addColumn('image', function ($data) {
                return '<img src="'.$data->getJobDetail['feature_image'].'" style="max-width:100px;max-height:100spx;">';
            })
            ->addColumn('action', function ($data) {
                return '
                        <a href="details/'.$data->id.'"><i class="fa fa-eye" aria-hidden="true" style="color:#00bfff;font-size:20px;" data-toggle="tooltip" title="More info"></i></a>
                        ';
                
               
            })
            ->rawColumns([
                'image',
                'action'
            ])
            ->make(true);
    }

     /**
    * User Job Details
    * @category Form Filler Management
    * @package  Form Filler Management
    * @author   Sachiln Kumar <sachin679710@gmail.com>
    * @license  PHP License 7.2.24
    * @link
    */
    public function jobDetails($id) {
        $data = AppliedJob::with(
                [
                    'documents',
                    'jobAcceptedBy',
                    'getJobDetail' => function($state) {
                        $state->with('getState');
                    }
                ]
            )->where('id', $id)->first();
        return view('formfiller.job_detail', compact('data'));
    }

    /**
    * Send Confirmation
    * @category Form Filler Management
    * @package  Form Filler Management
    * @author   Sachiln Kumar <sachin679710@gmail.com>
    * @license  PHP License 7.2.24
    * @link
    */
    public function sendConfirmation(Request $request) {
        $data = AppliedJob::find($request->id);
        $data->update(
            [
                'verified_by_user' => 'Yes'
            ]
        );
        $picked = User::find($data->accepted_by);
        $picked->notify(New SendConfirmationNotification($data));
        return 'Your Confirmation Send Successfully.';
    }

}
