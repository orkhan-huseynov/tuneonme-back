<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Friend;
use App\Models\Notification;
use App\Models\UserLevel;
use App\Models\Level;
use Auth;

class ConnectionRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $current_user = Auth::user();
		$connection_requests = Friend::where('friend_id', '=', $current_user->id)->where('accepted', '=', 0)->orderBy('created_at', 'desc')->get();
		return view('connection_request_list')->with('connection_requests', $connection_requests);		
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$current_user = Auth::user();
		
        $connection_request = Friend::findOrFail($id);
		if($connection_request->friend_id == $current_user->id){
			$connection_request->delete();
		}
		
		return redirect('/connection_request');
    }
	
	public function get_requests()
	{
		$current_user = Auth::user();
		$connection_requests = Friend::where('friend_id', '=', $current_user->id)->where('accepted', '=', 0)->orderBy('created_at', 'desc')->take(8)->get();
		
		$response_array = array();
		$i = 0;
		foreach ($connection_requests as $connection_request) {
			$user = User::FindOrFail($connection_request->user_id);
			
			$response_array[$i]['id'] = $connection_request->id;
			$response_array[$i]['user_id'] = $connection_request->user_id;
			$response_array[$i]['name_lastname'] = $user->name .'&nbsp;'.$user->lastname;
			$response_array[$i]['friend_id'] = $connection_request->friend_id;
			$response_array[$i]['accepted'] = $connection_request->accepted;
			$response_array[$i]['created_at'] = $connection_request->created_at->diffForHumans();
			$response_array[$i]['updated_at'] = $connection_request->updated_at;
			
			$i++;
		}
		
		return response()->json($response_array);
	}
	
	public function accept($id)
	{
		$current_user = Auth::user();
		
		if($current_user->friendsAccepted->count() > 0 || $current_user->friendOfAccepted->count() > 0){
			return response()->view('errors.connection_exists', [], 403);
		}
		
        $connection_request = Friend::findOrFail($id);
		if($connection_request->friend_id == $current_user->id){
			$request_author_id = $connection_request->user_id;
			$request_author = User::findOrFail($request_author_id);
			if($request_author->friendsAccepted->count() > 0 || $request_author->friendOfAccepted->count() > 0){
				return response()->view('errors.user_has_connections', [], 403);
			}
			
			$connection_request->accepted = true;
			$connection_request->save();
			
			//Create default levels
			$level_1 = Level::create(['name' => 'Flaws', 'points_to_win' => 15, 'user_id' => $request_author->id, 'friend_id' => $current_user->id]);
			$level_2 = Level::create(['name' => 'Achievements', 'points_to_win' => 15, 'user_id' => $request_author->id, 'friend_id' => $current_user->id]);
			$level_3 = Level::create(['name' => 'Weirdnesses', 'points_to_win' => 15, 'user_id' => $request_author->id, 'friend_id' => $current_user->id]);
			$level_3 = Level::create(['name' => 'Talents', 'points_to_win' => 15, 'user_id' => $request_author->id, 'friend_id' => $current_user->id]);
			$level_3 = Level::create(['name' => 'Fears', 'points_to_win' => 15, 'user_id' => $request_author->id, 'friend_id' => $current_user->id]);
			
			//Activate first level
			if ((UserLevel::where('user_id', '=', $current_user->id)->get()->count() == 0) && (UserLevel::where('user_id', '=', $request_author->id)->get()->count() == 0)) {
				$author_user_level = new UserLevel;
				$author_user_level->user_id = $current_user->id;
				$author_user_level->level_id = $level_1->id;
				$author_user_level->completed = false;
				$author_user_level->save();
				
				$request_user_level = new UserLevel;
				$request_user_level->user_id = $request_author->id;
				$request_user_level->level_id = $level_1->id;
				$request_user_level->completed = false;
				$request_user_level->save();
			}
			
			//Send notification to request user
			$notification = new Notification;
            $notification->user_id = $connection_request->user_id;
            $notification->notification_text = '<strong>'.$current_user->name.' '.$current_user->lastname.'</strong> accepted your connection request';
            $notification->friend_request_id = $connection_request->id;
            $notification->save();
		}
		
		return redirect('/home');
	}
	
	public function delete($id)
	{
		$current_user = Auth::user();
		
        $connection_request = Friend::findOrFail($id);
		if($connection_request->friend_id == $current_user->id){
			$connection_request->delete();
		}
		
		return redirect('/connection_request');
	}
}
