<?php

namespace App\Http\Controllers\FormFiller;

use App\Models\User;
use App\Models\AppliedJob;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\JobApplyNotification;
use Illuminate\Support\Facades\Notification;

class JobController extends Controller
{
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
        $create = AppliedJob::create(
        	[
        		'user_id' => \Auth::id(),
        		'job_id'  => $request->id,
        		'amount'  => $request->amount,
        	]
        );
        $users = User::where('type', 'admin')->orWhere('type', 'form_user')->get();
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
    public function proceedToPay(Request $request) {
    	dd('drftyguhijoklp');
    }
}
