<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\SupportCenter;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use App\Notifications\SendQueryNotification;
use App\Notifications\QueryResponseNotification;

class SupportCenterController extends Controller
{
    /**
     * Send Query By Open User 
     *
     * @category User Management
     * @package  User Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function sendQuery(Request $request) {
    	$insert = SupportCenter::create(
    		[
    			'name'    => $request->name,
    			'email'   => $request->email,
    			'query' => $request->message,
    		]
    	);  
        $user = User::where('type', 'admin')->first();
    	$user->notify(new SendQueryNotification($insert));
    	return 'Your Query Send Successfully.';
    }

    public function querylistView() {
    	return view('admin.query');
    }

     /**
     * Query List
     *
     * @category User Management
     * @package  User Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function querylist() {
    	$data = SupportCenter::where('replied_at', 'No')->get();
    	return Datatables::of($data)
    		->addColumn('reply', function ($data) {
                return '<textarea class="form-control" rows="5" id="comment'.$data->id.'"></textarea>';
            })
            ->addColumn('action', function ($data) {
                return '<button class="btn btn-primary" onclick="reply('.$data->id.')">Reply</button>';
            })
            ->rawColumns([
                    'reply',
                    'action'
                ])
            ->make(true);
    }

    public function queryReply(Request $request) {
    	$picked = SupportCenter::find($request->id);
    	$picked->update(
    		[
    			'response'   => $request->message,
    			'replied_at' => 'Yes'
    		]
    	);
    	$picked->notify(new QueryResponseNotification());
    	return 'Replied Successfully.';
    }
}
