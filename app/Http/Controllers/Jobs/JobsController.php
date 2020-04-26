<?php

namespace App\Http\Controllers\Jobs;

use App\Models\Job;
use App\Models\User;
use App\Models\City;
use App\Models\State;
use App\Models\Company;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use App\Notifications\PostJobNotification;
use Illuminate\Support\Facades\Notification;
use App\Http\Controllers\Concern\GlobalTrait;

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
  		$data = Job::with('getState')->orderBy('created_at', 'DESC')->get();
    	return Datatables::of($data)
    		->addColumn('state_name', function ($data) {
                return $data->getState['name'];
            })
            ->addColumn('assign_price', function ($data) {

                return '<input type="text" id="price'.$data->id.'" class="form-control" value="'.$data->price.'">';
            })
            ->addColumn('action', function ($data) {
            	if($data->status == 'active') {
            		return '
		                <i class="fa fa-eye" aria-hidden="true" style="color:#00bfff;font-size:20px;" data-toggle="tooltip" title="More info" onclick="showMore('.$data->id.')"></i>
		                <a href="edit/'.$data->id.'"><i class="fa fa-pencil-square-o" aria-hidden="true" style="color:blue;font-size:20px;" data-toggle="tooltip" title="Edit"></i></a>
		                <i class="fa fa-times" aria-hidden="true" style="color:red;font-size:20px;" data-toggle="tooltip" title="Publish" onclick="changeStatus('.$data->id.')"></i>
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
        if($published_new > $end_new) {
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
    	if($picked->status == 'active') {
    		$picked->update(
	    		[
	    			'status' => 'inactive'
	    		]
	    	);
    		return 'Job Un Published Successfully.';
    	}else {
    		$picked->update(
	    		[
	    			'price'  => $request->price,
	    			'status' => 'active'
	    		]
	    	);
	    	$users = User::where('type', 'form_user')->get();
	    	Notification::send($users, new PostJobNotification($picked));
	    	return 'Job Published Successfully.';
    	}
    	
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

}
