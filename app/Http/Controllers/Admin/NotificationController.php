<?php

namespace App\Http\Controllers\Admin;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    /**
     * Notification Listing
     *
     * @category Admin User Management
     * @package  Admin User Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function index()
    {
       $notifications = \Auth::user()->notifications;
       return view('admin.notifiaction', compact('notifications'));
    }

    /**
     * Delete Notification
     *
     * @category Admin User Management
     * @package  Admin User Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function deleteNotification(Request $request)
    {
       Notification::where('id', $request->id)->delete();
       return 'Notification Deleted Successfully.';
    }

    /**
     * Read Notification
     *
     * @category Admin User Management
     * @package  Admin User Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function readNotification($id, $job_id)
    {
        $picked = \Auth::user()->notifications()->where('id', $id)->first();
        $picked->update(
            [
                'read_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]
        );
        if($picked->data['type'] == 'user_confirmation' ||$picked->data['type'] == 'send_issue') {
            return redirect('admin/manage/job/detail/'.$job_id);
        } else if ($picked->data['type'] == 'apply_job') {
            return redirect('admin/manage/job/view');
        } else {
            return redirect('admin/manage/job/view');
        }
    }

    /**
     * Notification Read By Admin
     *
     * @category Admin User Management
     * @package  Admin User Management
     * @author   Sachiln Kumar <sachin679710@gmail.com>
     * @license  PHP License 7.2.24
     * @link
     */
    public function readByAdmin($id)
    {
        $picked = \Auth::user()->notifications()->where('id', $id)->first();
        $picked->update(
            [
                'read_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]
        );
        if($picked->data['type'] == 'apply_job') {
            return redirect('admin/applied/job-detail/'.$picked->data['data']['id']);
        } else {
            return redirect()->back();
        }
    }
}
