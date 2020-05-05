<?php

namespace App\Http\Controllers\Results;

use App\Models\Result;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;

class ResultsController extends Controller
{
	/**
	* List View Page Of Results
	*
	* @category Results Management
	* @package  Results Management
	* @author   Sachiln Kumar <sachin679710@gmail.com>
	* @license  PHP License 7.2.24
	* @link
	*/
    public function index() {
        return view('admin.result.result');
    }

    /**
	* Data Get
	*
	* @category Results Management
	* @package  Results Management
	* @author   Sachiln Kumar <sachin679710@gmail.com>
	* @license  PHP License 7.2.24
	* @link
	*/
    public function getResultData() {
    	$data = Result::get();
        return Datatables::of($data)
            ->addColumn('action', function ($data) {
                if($data->status == 'active') {
            		return '
		                <i class="fa fa-times" aria-hidden="true" style="color:red;font-size:20px;cursor:pointer;" data-toggle="tooltip" title="Un Publish" onclick="changeStatus('.$data->id.')"></i>
		                <i class="fa fa-trash" aria-hidden="true" style="color:red;font-size:20px;" data-toggle="tooltip" title="Delete" onclick="deleteJob('.$data->id.')"></i>
		                ';
	            	} else {
					 return '
					    <i class="fa fa-check" aria-hidden="true"  style="color:orange;font-size:20px;cursor:pointer;" data-toggle="tooltip" title="Publish" onclick="changeStatus('.$data->id.')"></i>
					    <i class="fa fa-trash" aria-hidden="true" style="color:red;font-size:20px;" data-toggle="tooltip" title="Delete" onclick="deleteJob('.$data->id.')"></i>
					    ';
					}
            })
            ->rawColumns([
                'image',
                'action'
            ])
            ->make(true);
    }

	/**
	* Add Result View Page
	*
	* @category Admin Card & Answers Keys Management
	* @package  Admin Card & Answers Keys Management
	* @author   Sachiln Kumar <sachin679710@gmail.com>
	* @license  PHP License 7.2.24
	* @link
	*/
    public function addView($id = null) {
    	if(is_null($id)) {
    		return view('admin.result.add_result');
    	} else {
    		$data = AdminCard::find($id);
    		return view('admin.result.add_result', compact('data'));
    	}
    }

    /**
     * Add Result
     *
     * @category Admin Card & Answers Keys Management
     * @package  Admin Card & Answers Keys Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function addResult(Request $request) {
        $request->validate([
        	'title' => 'required',
        	'link' => 'regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/'
        ]);
        $create = Result::create(
        	[
        		'title'         => $request->title,
        		'official_link' => $request->link
        	]
        );
        return redirect('form-filler/results/list')->with('success', 'Result Added Successfully.');
    }

	/**
	* Result Change Status
	*
	* @category Admin Card & Answers Keys Management
	* @package  Admin Card & Answers Keys Management
	* @author   Sachiln Kumar <sachin679710@gmail.com>
	* @license  PHP License 7.2.24
	* @link
	*/
    public function changeStatus(Request $request) {
        $picked = Result::find($request->id);
        $status = $picked->status == 'active' ? 'inactive' : 'active';
        $picked->update(
        	[
        		'status' => $status
        	]
        );
        return 'Status Updated Successfully.';
    }

    /**
	* Deleted Result
	*
	* @category Admin Card & Answers Keys Management
	* @package  Admin Card & Answers Keys Management
	* @author   Sachiln Kumar <sachin679710@gmail.com>
	* @license  PHP License 7.2.24
	* @link
	*/
    public function deleteResult(Request $request) {
        Result::find($request->id)->delete();
        return 'Deleted Successfully.';
    }
}
