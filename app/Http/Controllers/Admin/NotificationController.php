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
}
