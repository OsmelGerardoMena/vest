<?php

namespace Vest\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Vest\Http\Requests;
use Vest\Http\Controllers\Controller;

class NotificationsController extends Controller
{
	public function __construct()
	{
		$this->user = \Auth::user();
	}

    public function getIndex()
    {
    	$notifications = Notifications::where('user_id', $this->user->id)->get();
    	return view('Dashboard.notifications.index');
    }
}
