<?php

namespace App\Http\Controllers\Admission;

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

class AdmissionController extends Controller
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
  		$data = Job::with('getState')->where('slug', 'admission')->get();
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
	* View Jobs List View
	*
	* @category Job Management
	* @package  Job Management
	* @author   Sachiln Kumar <sachin679710@gmail.com>
	* @license  PHP License 7.2.24
	* @link
	*/
	public function admissionListView() {
		return view('admission.manage_admission');
	}

	 /**
	* Post Admission
	*
	* @category Job Management
	* @package  Job Management
	* @author   Sachiln Kumar <sachin679710@gmail.com>
	* @license  PHP License 7.2.24
	* @link
	*/
    public function createNewAdmission(Request $request) {
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
            return redirect()->back()->with('error', 'Please select Admission end date after then Admission publish date.');
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
    			'feature_image'  => $url,
    			'slug'           => 'admission'
    		]
    	);
    	return redirect('admin/admission/list-view')->with('success', 'Admission Posted Successfully.');
    }

    /**
	* View Jobs List View
	*
	* @category Job Management
	* @package  Job Management
	* @author   Sachiln Kumar <sachin679710@gmail.com>
	* @license  PHP License 7.2.24
	* @link
	*/
	public function postAdmissionView() {
		$data['states']         = State::orderBy('name', 'ASC')->get();
        $data['cities']         = City::get();
		return view('admission.post_admission', compact('data'));
	}

}
