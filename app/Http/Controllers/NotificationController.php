<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Notification;
use App\Models\Friend;
use Auth;

class NotificationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
	
	public function index()
    {
        $current_user = Auth::user();
		$notifications = Notification::where('user_id', '=', $current_user->id)->orderBy('created_at', 'desc')->take(50)->get();
		return view('notification_list')->with('notifications', $notifications);
    }
	
	public function show($id)
    {
        $notification = Notification::findOrFail($id);
		
		if ($notification->user_id != Auth::user()->id) {
			return redirect('/');
		}
		
		$notification->viewed = true;
		$notification->save();
		
		if ($notification->friend_request_id > 0) {
			$friend_requests = Friend::where('id', '=', $notification->friend_request_id)->get();
			if($friend_requests->count() > 0){
				$friend_request = $friend_requests->first();
				$redirect_user_id = ($friend_request->user_id == Auth::user()->id)? $friend_request->friend_id : $friend_request->user_id;
				return redirect()->route('profile.show', ['id' => $redirect_user_id]);
			} else {
				return redirect('/');
			}
		} elseif ($notification->level_id > 0) {
			return redirect('/level/'.$notification->level_id);
		} elseif ($notification->item_id > 0) {
			return redirect('/level_item/'.$notification->item_id);
		} else {
			return redirect('/');
		}
    }
    
    public function get_notifications()
    {
        $current_user = Auth::user();
        return Notification::where('user_id', '=', $current_user->id)->orderBy('created_at', 'desc')->take(8)->get();
    }
	
	public function mark_all_as_viewed()
	{
		$current_user = Auth::user();
		$unread = Notification::where('user_id', $current_user->id)->where('viewed', false)->get();
		foreach($unread as $notification){
			$notification_object = Notification::findOrFail($notification->id);
			$notification_object->viewed = true;
			$notification_object->save();
		}
	}
}
