<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Friend;
use App\Models\Notification;
use Auth;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $current_user_id = Auth::user()->id;
        $current_user_pid = Auth::user()->personal_id;
		return view('home')->with('user_id', $current_user_pid);
    }
	
	public function welcome()
	{
		return view('welcome');
	}
	
    public function user_by_id($pid)
    {
        $current_user_id = Auth::user()->id;
        $users = User::where('personal_id', $pid)->get();

        if ($users->count() == 0) {
            return response()->json([
                        'ResponseCode' => 2,
                        'ResponseContent' => ''
            ]);
        }

        $user = $users->first();

        if ($current_user_id == $user->id) {
            return response()->json([
                        'ResponseCode' => 2,
                        'ResponseContent' => ''
            ]);
        }
        return response()->json([
                    'ResponseCode' => 1,
                    'ResponseContent' => $user
        ]);
    }
	
    public function send_request($to_user_id)
    {
        $current_user = Auth::user();
        $current_user_id = Auth::user()->id;
        $to_users = User::where('id', $to_user_id)->get();

        if ($to_users->count() == 0) {
            return response()->json([
                'ResponseCode' => 2,
                'ResponseContent' => 'User not found'
            ]);
        }

        $to_user = $to_users->first();

        if ($current_user_id == $to_user->id) {
            return response()->json([
                'ResponseCode' => 2,
                'ResponseContent' => 'You cannot connect to yourself'
            ]);
        }

        /*if ($to_user->friends->count() > 0) {
            return response()->json([
                'ResponseCode' => 2,
                'ResponseContent' => 'This user is already connected to someone'
            ]);
        }*/

        if ($current_user->friendsAccepted->count() > 0) {
            return response()->json([
                'ResponseCode' => 2,
                'ResponseContent' => 'You are already connected to someone'
            ]);
        }
		
		//Check if request to this user is already sent
		$existing_requests_to_user = Friend::where('user_id', '=', $current_user_id)->where('friend_id', '=', $to_user->id)->get();
		if ($existing_requests_to_user->count() > 0) {
			return response()->json([
				'ResponseCode' => 2,
				'ResponseContent' => 'You have already sent a connection request to this user. Please wait for him to response'
			]);
		}
		
		//Check if request from this user exists
		$existing_requests_from_user = Friend::where('user_id', '=', $to_user->id)->where('friend_id', '=', $current_user_id)->get();
		if ($existing_requests_from_user->count() > 0) {
			return response()->json([
				'ResponseCode' => 2,
				'ResponseContent' => 'You have exeisting connection request from this user. Please accept it'
			]);
		}

        $friend = new Friend;
        $friend->user_id = $current_user_id;
        $friend->friend_id = $to_user->id;
        $friend->accepted = false;
        $friend->save();

        $notification = new Notification;
        $notification->user_id = $to_user->id;
        $notification->notification_text = '<strong>'.$current_user->name.' '.$current_user->lastname.'</strong> sent you connection request';
        $notification->friend_request_id = $friend->id;
        $notification->save();
        
        return response()->json([
            'ResponseCode' => 1,
            'ResponseContent' => 'Request successfully sent'
        ]);
    }
	
    public function exterminate_user($user_id)
    {
        $current_user = Auth::user();
        $current_user_id = Auth::user()->id;
        $exterminate_users = User::where('id', $user_id)->get();

        if ($exterminate_users->count() == 0) {
            return response()->json([
                        'ResponseCode' => 2,
                        'ResponseContent' => 'User not found'
            ]);
        }

        $exterminate_user = $exterminate_users->first();

        if ($current_user_id == $exterminate_user->id) {
            return response()->json([
                        'ResponseCode' => 2,
                        'ResponseContent' => 'You cannot exterminate yourself'
            ]);
        }

        if ($current_user->friends->count() == 0) {
            return response()->json([
                        'ResponseCode' => 2,
                        'ResponseContent' => 'You are not connected to anyone'
            ]);
        }

        $friends_bounds = Friend::where('user_id', '=', $current_user_id)->where('friend_id', '=', $exterminate_user->id)->where('accepted', '=', 1)->get();

        if ($friends_bounds->count() == 0) {
            $reverse_friends_bounds = Friend::where('user_id', '=', $exterminate_user->id)->where('friend_id', '=', $current_user_id)->where('accepted', '=', 1)->get();
            if ($reverse_friends_bounds->count() == 0) {
                return response()->json([
                            'ResponseCode' => 2,
                            'ResponseContent' => 'Connection not found'
                ]);
            } else {
                $friend_bound = $reverse_friends_bounds->first();
            }
        } else {
            $friend_bound = $friends_bounds->first();
        }
		
        $friend_bound->delete();
        
        $notification = new Notification;
        $notification->user_id = $exterminate_user->id;
        $notification->notification_text = 'You were exterminated by <strong>'.$current_user->name.' '.$current_user->lastname.'</strong>!';
        $notification->save();

        return response()->json([
                    'ResponseCode' => 1,
                    'ResponseContent' => 'Connection to ' . $exterminate_user->name . ' ' . $exterminate_user->lastname . ' successfully deleted'
        ]);
    }
	
    public function accept_request($from_user_id)
    {
        $current_user = Auth::user();
        $current_user_id = Auth::user()->id;
        $from_users = User::where('id', $from_user_id)->get();

        if ($from_users->count() == 0) {
            return response()->json([
                        'ResponseCode' => 2,
                        'ResponseContent' => 'User not found'
            ]);
        }

        $from_user = $from_users->first();

        if ($current_user_id == $from_user->id) {
            return response()->json([
                        'ResponseCode' => 2,
                        'ResponseContent' => 'You cannot accept request from yourself'
            ]);
        }

        if ($current_user->friendsAccepted->count() > 0) {
            return response()->json([
                        'ResponseCode' => 2,
                        'ResponseContent' => 'You are already connected to another user'
            ]);
        }

        if ($from_user->friendsAccepted->count() > 0) {
            return response()->json([
                        'ResponseCode' => 2,
                        'ResponseContent' => $from_user->name . ' ' . $from_user->lastname . ' is already connected to another user'
            ]);
        }

        $friends_bounds = Friend::where([
                    ['user_id', '=', $from_user->id],
                    ['friend_id', '=', $current_user->id]
                ])->get();

        if ($friends_bounds->count() == 0) {
            return response()->json([
                        'ResponseCode' => 2,
                        'ResponseContent' => 'Connection to accept not found'
            ]);
        } else {
            $friend_bound = $friends_bounds->first();
            $friend_bound->accepted = true;
            $friend_bound->save();
            
            $notification = new Notification;
            $notification->user_id = $from_user->id;
            $notification->notification_text = '<strong>'.$current_user->name.' '.$current_user->lastname.'</strong> accepted your connection request';
            $notification->friend_request_id = $friend_bound->id;
            $notification->save();

            return response()->json([
                        'ResponseCode' => 1,
                        'ResponseContent' => 'Connection to ' . $from_user->name . ' ' . $from_user->lastname . ' successfully accepted'
            ]);
        }
    }
}
