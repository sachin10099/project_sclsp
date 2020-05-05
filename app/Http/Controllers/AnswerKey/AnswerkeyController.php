<?php

namespace App\Http\Controllers\AnswerKey;

use App\Models\AdminCard;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\AdmitCardDocument;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Concern\GlobalTrait;

class AnswerkeyController extends Controller
{
	use GlobalTrait;

	/**
	* List of Admit Card And Answers Keys
	*
	* @category Admin Card & Answers Keys Management
	* @package  Admin Card & Answers Keys Management
	* @author   Sachiln Kumar <sachin679710@gmail.com>
	* @license  PHP License 7.2.24
	* @link
	*/
    public function index() {
        return view('admin.answer_key.answer_key');
    }

    public function getAnswerKeys() {
    	$data = AdminCard::where('type', 'answer_key')->get();
        return Datatables::of($data)
            ->addColumn('action', function ($data) {
                if($data->status == 'active') {
            		return '
		                <a href="files/'.$data->id.'"><i class="fa fa-eye" aria-hidden="true" style="color:#00bfff;font-size:20px;cursor:pointer" data-toggle="tooltip" title="View Attached Files"></i></a>
		                <i class="fa fa-plus" aria-hidden="true" style="color:purple;font-size:20px;cursor:pointer" data-toggle="tooltip" title="Add Files" onclick="addFile('.$data->id.')"></i>
		                <a href="edit/'.$data->id.'"><i class="fa fa-pencil-square-o" aria-hidden="true" style="color:blue;font-size:20px;cursor:pointer" data-toggle="tooltip" title="Edit"></i></a>
		                <i class="fa fa-times" aria-hidden="true" style="color:red;font-size:20px;cursor:pointer" data-toggle="tooltip" title="Un Publish" onclick="changeStatus('.$data->id.')"></i>
		                <i class="fa fa-trash" aria-hidden="true" style="color:red;font-size:20px;cursor:pointer" data-toggle="tooltip" title="Delete" onclick="deleteJob('.$data->id.')"></i>
		                ';
            	} else {
            		 return '
		                <a href="files/'.$data->id.'"><i class="fa fa-eye" aria-hidden="true" style="color:#00bfff;font-size:20px;cursor:pointer" data-toggle="tooltip" title="View Attached Files"></i></a>
		                <i class="fa fa-plus" aria-hidden="true" style="color:purple;font-size:20px;cursor:pointer" data-toggle="tooltip" title="Add Files" onclick="addFile('.$data->id.')"></i>
		                <a href="edit/'.$data->id.'"><i class="fa fa-pencil-square-o" aria-hidden="true" style="color:blue;font-size:20px;cursor:pointer" data-toggle="tooltip" title="Edit"></i></a>
		                <i class="fa fa-check" aria-hidden="true"  style="color:orange;font-size:20px;cursor:pointer" data-toggle="tooltip" title="Publish" onclick="changeStatus('.$data->id.')"></i>
		                <i class="fa fa-trash" aria-hidden="true" style="color:red;font-size:20px;cursor:pointer" data-toggle="tooltip" title="Delete" onclick="deleteJob('.$data->id.')"></i>
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
	* Add Answer Key View Page
	*
	* @category Admin Card & Answers Keys Management
	* @package  Admin Card & Answers Keys Management
	* @author   Sachiln Kumar <sachin679710@gmail.com>
	* @license  PHP License 7.2.24
	* @link
	*/
    public function addView($id = null) {
    	if(is_null($id)) {
    		return view('admin.answer_key.add_keys');
    	} else {
    		$data = AdminCard::find($id);
    		return view('admin.answer_key.add_keys', compact('data'));
    	}
    }

	/**
	* Add Admit Cards
	*
	* @category Admin Card & Answers Keys Management
	* @package  Admin Card & Answers Keys Management
	* @author   Sachiln Kumar <sachin679710@gmail.com>
	* @license  PHP License 7.2.24
	* @link
	*/
    public function addAnsweKey(Request $request) {
        $request->validate([
        	'title' => 'required',
        	'link' => 'regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/'
        ]);
        $create = AdminCard::create(
        	[
        		'title'         => $request->title,
        		'official_link' => $request->link,
        		'type'          => 'answer_key',
        		'status'        => 'inactive'
        	]
        );
        return redirect('form-filler/answer-key/list')->with('success', 'Added Successfully.');
    }

	/**
	* Edit Admit Cards Details
	*
	* @category Admin Card & Answers Keys Management
	* @package  Admin Card & Answers Keys Management
	* @author   Sachiln Kumar <sachin679710@gmail.com>
	* @license  PHP License 7.2.24
	* @link
	*/
    public function editAdmitCardDetail(Request $request) {
        $request->validate([
        	'title' => 'required',
        	'link' => 'regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/'
        ]);
        $picked = AdminCard::find($request->id);
        $picked->update(
        	[
        		'title'         => $request->title,
        		'official_link' => $request->link
        	]
        );
        return redirect('form-filler/answer-key/list')->with('success', 'Answer Key Updated Successfully.');
    }

	/**
	* Answer Key Change Status
	*
	* @category Admin Card & Answers Keys Management
	* @package  Admin Card & Answers Keys Management
	* @author   Sachiln Kumar <sachin679710@gmail.com>
	* @license  PHP License 7.2.24
	* @link
	*/
    public function changeStatus(Request $request) {
        $picked = AdminCard::find($request->id);
        $status = $picked->status == 'active' ? 'inactive' : 'active';
        if($status == 'active') {
        	$getDoc = AdmitCardDocument::where('admin_cards_id', $request->id)->get();
        	if(count($getDoc) == 0 ) {
        		return 'notfound';
        	}
        }
        $picked->update(
        	[
        		'status' => $status
        	]
        );
        return 'Status Updated Successfully.';
    }

	/**
	* Upload Documents
	*
	* @category Admin Card & Answers Keys Management
	* @package  Admin Card & Answers Keys Management
	* @author   Sachiln Kumar <sachin679710@gmail.com>
	* @license  PHP License 7.2.24
	* @link
	*/
    public function uploadFile(Request $request) {
        $request->validate([
        	'region_name' => 'required|max:150',
        	'link'        => 'nullable|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
        	'file'        => 'required|mimes:pdf'
        ]);
        $file_url = $this->uploadAnswerKey($request);
        
        $insert = AdmitCardDocument::create(
        	[
        		'admin_cards_id' => $request->card_key_id,
        		'region_name'    => $request->region_name,
        		'region_name'    => $request->region_name,
        		'documents'      => $file_url,
        		'official_links' => $request->link
        	]
        );
        return redirect('form-filler/answer-key/list')->with('success', 'File Added Successfully.');
    }

	/**
	* Answer Key Related Files
	*
	* @category Admin Card & Answers Keys Management
	* @package  Admin Card & Answers Keys Management
	* @author   Sachiln Kumar <sachin679710@gmail.com>
	* @license  PHP License 7.2.24
	* @link
	*/
    public function viewFiles($id) {
    	$datas = AdmitCardDocument::where('admin_cards_id', $id)->get();
    	return view('admin.admit_card.list', compact('datas'));
    }

    /**
	* Delete Answer Keys
	*
	* @category Admin Card & Answers Keys Management
	* @package  Admin Card & Answers Keys Management
	* @author   Sachiln Kumar <sachin679710@gmail.com>
	* @license  PHP License 7.2.24
	* @link
	*/
    public function deleteFile(Request $request) {
    	$picked = AdmitCardDocument::find($request->id);
    	$file = basename($picked->documents);
        if($file) {
          if(file_exists(public_path('assets/img/answerkey/').$file)){
            unlink(public_path("assets/img/answerkey/").$file);
          }
        }
        $picked->delete();
    	return 'Document Deleted Successfully.';
    }
}
