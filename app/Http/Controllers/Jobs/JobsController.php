<?php

namespace App\Http\Controllers\Jobs;

use App\Models\Job;
use App\Models\User;
use App\Models\City;
use App\Models\State;
use App\Models\Company;
use App\Models\AppliedJob;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\JobRelatedDocument;
use App\Http\Controllers\Controller;
use App\Notifications\PostJobNotification;
use Illuminate\Support\Facades\Notification;
use App\Http\Controllers\Concern\GlobalTrait;
use App\Notifications\JobRejectedNotification;
use App\Notifications\JobCompletedNotification;
use App\Notifications\PostAdmissionNotification;

class JobsController extends Controller
{
	use GlobalTrait;

	/**
	* View Jobs List 
	*
	* @category Job Management
	* @package  Job Management
	* @author   Sachiln Kumar <sachin679710@gmail.com>
	* @license  PHP License 7.2.24
	* @link
	*/
    public function index()
    {
  		$data = Job::with('getState')->where('slug', 'job')->orderBy('created_at', 'DESC')->get();
    	return Datatables::of($data)
    		->addColumn('state_name', function ($data) {
                return $data->getState['name'];
            })
            ->addColumn('assign_price', function ($data) {

                return '<input type="text" id="price'.$data->id.'" class="form-control" value="'.$data->price.'">';
            })
            ->addColumn('assign_obc_price', function ($data) {

                return '<input type="text" id="obc'.$data->id.'" class="form-control" value="'.$data->obc_fees.'">';
            })
            ->addColumn('assign_scst_price', function ($data) {

                return '<input type="text" id="sc'.$data->id.'" class="form-control" value="'.$data->sc_st_fees.'">';
            })
            ->addColumn('publish', function ($data) {
                $publish = date('d-m-Y', strtotime($data->job_published));
                return $publish;
            })
            ->addColumn('end', function ($data) {
                $end = date('d-m-Y', strtotime($data->job_deadline));
                return $end;
            })
            ->addColumn('action', function ($data) {
            	if($data->status == 'active') {
            		return '
		                <i class="fa fa-eye" aria-hidden="true" style="color:#00bfff;font-size:20px;" data-toggle="tooltip" title="More info" onclick="showMore('.$data->id.')"></i>
		                <a href="edit/'.$data->id.'"><i class="fa fa-pencil-square-o" aria-hidden="true" style="color:blue;font-size:20px;" data-toggle="tooltip" title="Edit"></i></a>
		                <i class="fa fa-times" aria-hidden="true" style="color:red;font-size:20px;" data-toggle="tooltip" title="Un Publish" onclick="unPublish('.$data->id.')"></i>
		                <i class="fa fa-trash" aria-hidden="true" style="color:red;font-size:20px;" data-toggle="tooltip" title="Delete" onclick="deleteJob('.$data->id.')"></i>
		                ';
            	} else {
            		 return '
		                <i class="fa fa-eye" aria-hidden="true" style="color:#00bfff;font-size:20px;" data-toggle="tooltip" title="More info" onclick="showMore('.$data->id.')"></i>
		                <a href="edit/'.$data->id.'"><i class="fa fa-pencil-square-o" aria-hidden="true" style="color:blue;font-size:20px;" data-toggle="tooltip" title="Edit"></i></a>
		                <i class="fa fa-check" aria-hidden="true"  style="color:orange;font-size:20px;" data-toggle="tooltip" title="Publish" onclick="changeStatus('.$data->id.')"></i>
		                <i class="fa fa-trash" aria-hidden="true" style="color:red;font-size:20px;" data-toggle="tooltip" title="Delete" onclick="deleteJob('.$data->id.')"></i>
		                ';
            	}
               
            })
            ->rawColumns([
                'assign_price',
                'assign_obc_price',
                'assign_scst_price',
                'action'
            ])
            ->make(true);
    }

    /**
	* View Jobs List 
	*
	* @category Job Management
	* @package  Job Management
	* @author   Sachiln Kumar <sachin679710@gmail.com>
	* @license  PHP License 7.2.24
	* @link
	*/
    public function jobList(Request $request)
    {
  		$data = Job::find($request->id);
  		return $data;
    }

    /**
	* View Jobs List Page 
	*
	* @category Job Management
	* @package  Job Management
	* @author   Sachiln Kumar <sachin679710@gmail.com>
	* @license  PHP License 7.2.24
	* @link
	*/
    public function listView()
    {
  		return View('jobs.manage_jobs');
    }

    /**
	* View Jobs Post Page
	*
	* @category Job Management
	* @package  Job Management
	* @author   Sachiln Kumar <sachin679710@gmail.com>
	* @license  PHP License 7.2.24
	* @link
	*/
    public function postJobView() {
    	$data['states']         = State::orderBy('name', 'ASC')->get();
        $data['cities']         = City::get();
    	return View('jobs.post_new_job', compact('data'));
    }

     /**
	* Post Jobs
	*
	* @category Job Management
	* @package  Job Management
	* @author   Sachiln Kumar <sachin679710@gmail.com>
	* @license  PHP License 7.2.24
	* @link
	*/
    public function postJob(Request $request) {
    	$request->validate(
    		[
    			'job_tile'     => 'required|max:150',
	    		'job_type'     => 'required',
	    		'state'        => 'required|integer',
	    		'job_location' => 'required|max:225',
	    		'published'    => 'required',
	    		'endjob'       => 'required',
	    		'vacancy'      => 'integer',
	    		'desc_new'     => 'required',
	    		'image'        => 'mimes:jpeg,jpg,png|max:10000'
    		]
    	);
    	$published = date('Y-m-d', strtotime($request->published));
        $published_new = strtotime($published);
    	$end           = date('Y-m-d', strtotime($request->endjob));
        $end_new       = strtotime($end);
        $current_date = date("Y-m-d");
        $current_new = strtotime($current_date);
        if($published_new < $current_new) {
            return redirect()->back()->with('error', 'Please select publish date must be after then current date.');
        }
        if($published_new >= $end_new) {
            return redirect()->back()->with('error', 'Please select job end date after then job publish date.');
        }
    	$url = $this->filesUpload($request, null);
    	$jobs = Job::create(
    		[
    			'user_id'        => \Auth::id(),
    			'job_title'      => $request->job_tile,
    			'job_desc'       => $request->desc_new,
    			'state_id'       => $request->state,
    			'job_location'   => $request->job_location,
    			'job_type'       => $request->job_type,
    			'job_published'  => $published,
    			'job_deadline'   => $end,
    			'vacancy'        => $request->vacancy,
    			'feature_image'  => $url
    		]
    	);
    	return redirect('admin/jobs/list-view')->with('success', 'Job Posted Successfully.');
    }

   /**
	* Post Edit
	*
	* @category Job Management
	* @package  Job Management
	* @author   Sachiln Kumar <sachin679710@gmail.com>
	* @license  PHP License 7.2.24
	* @link
	*/
    public function jobEdit($id) {
    	$data = Job::find($id);
    	$data['states']         = State::orderBy('name', 'ASC')->get();
        $data['cities']         = City::get();
    	return view('jobs.edit_jobs', compact('data'));
    }

    /**
	* Post Update
	*
	* @category Job Management
	* @package  Job Management
	* @author   Sachiln Kumar <sachin679710@gmail.com>
	* @license  PHP License 7.2.24
	* @link
	*/
    public function jobUpdate(Request $request) {
    	$request->validate(
    		[
    			'job_tile'     => 'max:150',
	    		'state'        => 'integer',
	    		'job_location' => 'max:225',
	    		'published'    => 'date',
	    		'endjob'       => 'date',
	    		'vacancy'      => 'integer',
	    		'image'        => 'mimes:jpeg,jpg,png|max:10000'
    		]
    	);
    	$picked = Job::find($request->id);
    	$url = $this->filesUpload($request, $picked->feature_image);
    	$published = date('d-m-Y', strtotime($request->published));
    	$end       = date('d-m-Y', strtotime($request->endjob));
    	$picked->update(
    		[
    			'job_title'      => $request->job_tile,
    			'job_desc'       => $request->desc_new,
    			'state_id'       => $request->state,
    			'job_location'   => $request->job_location,
    			'job_type'       => $request->job_type,
    			'job_published'  => $published,
    			'job_deadline'   => $end,
    			'vacancy'        => $request->vacancy,
    			'feature_image'  => $url
    		]
    	);
    	return redirect('admin/jobs/list-view')->with('success', 'Posted Updated Successfully.');
    }

    /**
	* Change Status of Job Like Publish and Unpublish
	*
	* @category Job Management
	* @package  Job Management
	* @author   Sachiln Kumar <sachin679710@gmail.com>
	* @license  PHP License 7.2.24
	* @link
	*/
    public function changeStatus(Request $request) {
    	$picked = Job::find($request->id);
        $check = $picked->price;
        $picked->update(
            [
                'price'       => $request->price,
                'obc_fees'    => $request->obc,
                'sc_st_fees'  => $request->sc,
                'status'      => 'active'
            ]
        );
        $users = User::where('type', 'form_user')->get();
        if(is_null($check)) {
            if($picked->slug == 'job') {
                Notification::send($users, new PostJobNotification($picked));
            } else {
                Notification::send($users, new PostAdmissionNotification($picked));
            }
            
        }
        return 'Job Published Successfully.';
    }

    /**
    * Change Status of Job Like Unpublish
    *
    * @category Job Management
    * @package  Job Management
    * @author   Sachiln Kumar <sachin679710@gmail.com>
    * @license  PHP License 7.2.24
    * @link
    */
    public function unPublish(Request $request) {
        $picked = Job::find($request->id);
        $picked->update(
            [
                'status' => 'inactive'
            ]
        );
        return 'Job Un Published Successfully.';
    }

    /**
	* Delete Job
	*
	* @category Job Management
	* @package  Job Management
	* @author   Sachiln Kumar <sachin679710@gmail.com>
	* @license  PHP License 7.2.24
	* @link
	*/
    public function deleteJob(Request $request) {
    	$picked = Job::find($request->id);
 		$picked->delete();
 		return 'Job Deleted Successfully.';
    }

    /**
    * Job Request View Created By User
    *
    * @category Job Management
    * @package  Job Management
    * @author   Sachiln Kumar <sachin679710@gmail.com>
    * @license  PHP License 7.2.24
    * @link
    */
    public function jobRequestView(Request $request) {
        return view('job_request.manage_job_request');
    }

    /**
    * Job Request View Created By User
    *
    * @category Job Management
    * @package  Job Management
    * @author   Sachiln Kumar <sachin679710@gmail.com>
    * @license  PHP License 7.2.24
    * @link
    */
    public function ownList(Request $request) {
        return view('job_request.manage_accepted_request');
    }

    /**
    * Job Request By User List
    *
    * @category Job Management
    * @package  Job Management
    * @author   Sachiln Kumar <sachin679710@gmail.com>
    * @license  PHP License 7.2.24
    * @link
    */
    public function jobRequestList()
    {
        $data = AppliedJob::with(
            [
                'jobReleatedUser',
                'getJobDetail'
            ]
        )->orderBy('created_at', 'DESC')->get();
        return Datatables::of($data)
            ->addColumn('job_id', function ($data) {
                return $data->job_id;
            })
            ->addColumn('job_title', function ($data) {
                return $data->getJobDetail['job_title'];
            })
            ->addColumn('publish', function ($data) {
                $publish = date('d-m-Y', strtotime($data->getJobDetail['job_published']));
                return $publish;
            })
            ->addColumn('applicant_name', function ($data) {
                return $data->jobReleatedUser['name'];
            })
            ->addColumn('applicant_email', function ($data) {
                return $data->jobReleatedUser['email'];
            })
            ->addColumn('applicant_contact', function ($data) {
                return $data->jobReleatedUser['contact_number'];
            })
            ->addColumn('action', function ($data) {
                    if($data->accepted_by) {
                        if($data->accepted_by == \Auth::id()) {
                           return '
                            <a href="detail/'.$data->id.'"><i class="fa fa-eye" aria-hidden="true" style="color:#00bfff;font-size:20px;cursor:pointer;" data-toggle="tooltip" title="More info"></i></a>
                            '; 
                        } else {
                            return '<p style="color:red;">Received</p>';
                        }
                    } else {
                        return '
                        <i class="fa fa-check" aria-hidden="true"  style="color:orange;font-size:20px;cursor:pointer;" data-toggle="tooltip" title="Accept Request" onclick="acceptRequest('.$data->id.')"></i>
                        ';
                    }
               
            })
            ->make(true);
    }

    /**
    * Job Request By User List
    *
    * @category Job Management
    * @package  Job Management
    * @author   Sachiln Kumar <sachin679710@gmail.com>
    * @license  PHP License 7.2.24
    * @link
    */
    public function jobAcceptedRequestList()
    {
        $data = AppliedJob::with(
            [
                'jobReleatedUser',
                'getJobDetail'
            ]
        )->where('accepted_by', \Auth::id())->orderBy('created_at', 'DESC')->get();
        return Datatables::of($data)
            ->addColumn('job_id', function ($data) {
                return $data->job_id;
            })
            ->addColumn('job_title', function ($data) {
                return $data->getJobDetail['job_title'];
            })
            ->addColumn('publish', function ($data) {
                $publish = date('d-m-Y', strtotime($data->getJobDetail['job_published']));
                return $publish;
            })
            ->addColumn('applicant_name', function ($data) {
                return $data->jobReleatedUser['name'];
            })
            ->addColumn('applicant_email', function ($data) {
                return $data->jobReleatedUser['email'];
            })
            ->addColumn('applicant_contact', function ($data) {
                return $data->jobReleatedUser['contact_number'];
            })
            ->addColumn('action', function ($data) {
                    return '
                            <a href="detail/'.$data->id.'"><i class="fa fa-eye" aria-hidden="true" style="color:#00bfff;font-size:20px;cursor:pointer;" data-toggle="tooltip" title="More info"></i></a>
                            '; 
               
            })
            ->make(true);
    }

    /**
    * Job Request Details Created By User
    *
    * @category Job Management
    * @package  Job Management
    * @author   Sachiln Kumar <sachin679710@gmail.com>
    * @license  PHP License 7.2.24
    * @link
    */
    public function jobRequestDetail($id) {
        $data = AppliedJob::with(
            [
                'documentList',
                'jobReleatedUser',
                'getJobDetail'
            ]
        )->where('id', $id)->first();
        return view('job_request.detail', compact('data'));
    }

    /**
    * Job Request Details Created By User
    *
    * @category Job Management
    * @package  Job Management
    * @author   Sachiln Kumar <sachin679710@gmail.com>
    * @license  PHP License 7.2.24
    * @link
    */
    public function appliedRequestJobDetail($id) {
        $data = AppliedJob::with(
            [
                'documentList',
                'jobReleatedUser',
                'getJobDetail',
                'jobAcceptedBy'
            ]
        )->where('id', $id)->first();
        return view('admin.applied_job_detail', compact('data'));
    }

    /**
    * Job Request Details Created By User
    *
    * @category Job Management
    * @package  Job Management
    * @author   Sachiln Kumar <sachin679710@gmail.com>
    * @license  PHP License 7.2.24
    * @link
    */
    public function acceptRequest(Request $request) {
        $data = AppliedJob::find($request->id);
        if($data->accepted_by) {
            return 'already_accepted';
        } else {
            $data->update([
                'accepted_by' => \Auth::id()
            ]);
            return 'Request Accepted Successfully.';
        }
    }

    /**
    * Make Sure Payment Is Done
    *
    * @category Job Management
    * @package  Job Management
    * @author   Sachiln Kumar <sachin679710@gmail.com>
    * @license  PHP License 7.2.24
    * @link
    */
    public function markAsPay(Request $request) {
        $data = AppliedJob::find($request->id);
        $data->update([
            'amount_status' => 'paid',
            'status'        => 'on_going'
        ]);
        return 'Payment is Done.';
    }

    /**
    * Upload Documnets When Job Completed
    *
    * @category Job Management
    * @package  Job Management
    * @author   Sachiln Kumar <sachin679710@gmail.com>
    * @license  PHP License 7.2.24
    * @link
    */
    public function afterCompleteUploadDoc(Request $request) {
        $request->validate(
            [
                'name'  => 'required|max:150',
                'image' => 'required|mimes:pdf'
            ]
        );
        $url = $this->filesUpload($request, null);
        $insert = JobRelatedDocument::create(
            [
                'applied_job_id' => $request->id,
                'user_id'        => $request->user_id,
                'document_name'  => $request->name,
                'document_file'  => $url
            ]
        );
        $data = AppliedJob::find($request->id);
        $user = User::find($data->user_id);
        $data->update([
            'status'        => 'completed'
        ]);
        $user->notify(New JobCompletedNotification($data));
        return redirect()->back()->with('success', 'Documnet Uploaded & Job Completed Successfully.');
    }

    /**
    * Upload Documnets When Job Completed
    *
    * @category Job Management
    * @package  Job Management
    * @author   Sachiln Kumar <sachin679710@gmail.com>
    * @license  PHP License 7.2.24
    * @link
    */
    public function rejectRequest(Request $request) {
        $request->validate(
            [
                'region'  => 'required'
            ]
        );
        $data = AppliedJob::find($request->id);
        $data->update([
            'status'           => 'reject',
            'rejection_region' => $request->region
        ]);
        $user = User::find($data->user_id);
        $user->notify(New JobRejectedNotification($data));
        return redirect()->back()->with('success', 'Request Rejected Successfully.');
    }

    /**
    * Delete Documnets Job Related
    *
    * @category Job Management
    * @package  Job Management
    * @author   Sachiln Kumar <sachin679710@gmail.com>
    * @license  PHP License 7.2.24
    * @link
    */
    public function deleteDoc(Request $request) {
        $data = JobRelatedDocument::find($request->id);
        $data->delete();
        return 'Documnet Deleted Successfully.';
    }

    /**
    * Goto Applied Job List
    *
    * @category Job Management
    * @package  Job Management
    * @author   Sachiln Kumar <sachin679710@gmail.com>
    * @license  PHP License 7.2.24
    * @link
    */
    public function appliedJobsList(Request $request) {
        return view('admin.manage_applied_jobs');
    }

    /**
    * Job Request By User List
    *
    * @category Job Management
    * @package  Job Management
    * @author   Sachiln Kumar <sachin679710@gmail.com>
    * @license  PHP License 7.2.24
    * @link
    */
    public function appliedRequestList()
    {
        $data = AppliedJob::with(
            [
                'jobReleatedUser',
                'getJobDetail'
            ]
        )->orderBy('created_at', 'DESC')->get();
        return Datatables::of($data)
            ->addColumn('job_id', function ($data) {
                return $data->job_id;
            })
            ->addColumn('job_title', function ($data) {
                return $data->getJobDetail['job_title'];
            })
            ->addColumn('publish', function ($data) {
                $publish = date('d-m-Y', strtotime($data->getJobDetail['job_published']));
                return $publish;
            })
            ->addColumn('applicant_name', function ($data) {
                return $data->jobReleatedUser['name'];
            })
            ->addColumn('applicant_email', function ($data) {
                return $data->jobReleatedUser['email'];
            })
            ->addColumn('applicant_contact', function ($data) {
                return $data->jobReleatedUser['contact_number'];
            })
            ->addColumn('action', function ($data) {
                return '
                    <a href="job-detail/'.$data->id.'"><i class="fa fa-eye" aria-hidden="true" style="color:#00bfff;font-size:20px;cursor:pointer;" data-toggle="tooltip" title="More info"></i></a>
                    '; 
               
            })
            ->make(true);
    }

}
