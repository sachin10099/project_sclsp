<?php

namespace App\Http\Controllers\AdminCard;

use App\Models\AdminCard;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;

class AdmitCardController extends Controller
{
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
        return view('admin.admit_card.admit_card');
    }

    public function getAdminCards() {
    	$data = AdminCard::where('type', 'admit_card')->get();
        return Datatables::of($data)
            ->addColumn('action', function ($data) {
                if($data->status == 'active') {
            		return '
		                <a href="list/edit/'.$data->id.'"><i class="fa fa-pencil-square-o" aria-hidden="true" style="color:blue;font-size:20px;" data-toggle="tooltip" title="Edit"></i></a>
		                <i class="fa fa-times" aria-hidden="true" style="color:red;font-size:20px;" data-toggle="tooltip" title="Un Publish" onclick="changeStatus('.$data->id.')"></i>
		                <i class="fa fa-trash" aria-hidden="true" style="color:red;font-size:20px;" data-toggle="tooltip" title="Delete" onclick="deleteJob('.$data->id.')"></i>
		                ';
	            	} else {
					 return '
					    <a href="list/edit/'.$data->id.'"><i class="fa fa-pencil-square-o" aria-hidden="true" style="color:blue;font-size:20px;" data-toggle="tooltip" title="Edit"></i></a>
					    <i class="fa fa-check" aria-hidden="true"  style="color:orange;font-size:20px;" data-toggle="tooltip" title="Publish" onclick="changeStatus('.$data->id.')"></i>
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
     * Add Admit Card View Page
     *
     * @category Admin Card & Answers Keys Management
     * @package  Admin Card & Answers Keys Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function addView($id = null) {
    	if(is_null($id)) {
    		return view('admin.admit_card.add_cards');
    	} else {
    		$data = AdminCard::find($id);
    		return view('admin.admit_card.add_cards', compact('data'));
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
    public function addAdmitCard(Request $request) {
        $request->validate([
        	'title' => 'required',
        	'link' => 'regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/'
        ]);
        $create = AdminCard::create(
        	[
        		'title'         => $request->title,
        		'official_link' => $request->link,
        		'type'          => 'admit_card',
        		'status'        => 'inactive'
        	]
        );
        return redirect('form-filler/admit-card/list')->with('success', 'Admit Card Detail Added Successfully.');
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
        return redirect('form-filler/admit-card/list')->with('success', 'Admit Card Detail Updated Successfully.');
    }

    /**
     * Admit Card Change Status
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
        $picked->update(
        	[
        		'status' => $status
        	]
        );
        return 'Status Updated Successfully.';
    }

    /**
     * Delete Admit Card
     *
     * @category Admin Card & Answers Keys Management
     * @package  Admin Card & Answers Keys Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function deleteRecord(Request $request) {
        $picked = AdminCard::find($request->id)->delete();
        return 'Deleted Successfully.';
    }
}
