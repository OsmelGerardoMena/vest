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
    	$notifications = Notification::where('user_id', $this->user->id)
                ->orderBy('id', 'desc')->get();

        // conteo de notificaciones no leidas
        $count = Notification::where('user_id', $this->user->id)
                ->where('read', false)->get()->count();

    	return view('dashboard.notifications.index', compact('notifications', 'count'));
    }

    public function getShow($id)
    {
    	$notification = Notification::findOrFail($id);
        if (!$notification->read) {
            $notification->read = true; // leída
            $notification->save();
        }
    	return view('dashboard.notifications.show')->with('notification', $notification);
    }

    // metodo para mostrar notificaciones mediante ajax, en el icono de la barra superior
    public function getAjax(Request $request)
    {
        if ($request->ajax()) {
            $notifications = Notification::where('user_id', $this->user->id)
                    ->where('read', false)->orderBy('id', 'desc')->get();

            return response()->json($notifications);
        } 
    }

    /*public function getClean()
    {
        Notification::where('read', true)->delete();
    }*/
}
