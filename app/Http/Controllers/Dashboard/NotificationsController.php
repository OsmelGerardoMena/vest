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
        // conteo de notificaciones leidas
        $count = Notification::where('user_id', $this->user->id)
                ->where('read', false)->get()->count();
    	return view('Dashboard.notifications.index', compact('notifications', 'count'));
    }

    public function getShow($id)
    {
    	$notification = Notification::findOrFail($id);
        if (!$notification->read) {
            $notification->read = true; // leída
            $notification->save();
        }
    	return view('Dashboard.notifications.show')->with('notification', $notification);
    }
}
