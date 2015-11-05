<?php

namespace Vest\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Vest\Http\Requests;
use Vest\Http\Controllers\Controller;

use Vest\Tables\Notification;

class NotificationsController extends Controller
{
	public function __construct()
	{
		$this->user = \Auth::user();
		$this->middleware('is_seller');
	}

    public function getIndex()
    {
    	$notifications = Notification::where('user_id', $this->user->id)->get();
    	return view('Dashboard.notifications.index')->with('notifications', $notifications);
    }

    public function getShow($id)
    {
    	$notification = Notification::findOrFail($id);
    	return view('Dashboard.notifications.show')->with('notification', $notification);
    }
}
