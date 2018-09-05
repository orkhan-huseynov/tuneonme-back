<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Level;
use App\Models\UserLevel;
use App\Models\LevelItem;
use App\Models\Notification;
use App\Models\Friend;
use App\Models\LevelPrize;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $current_user_id = Auth::user()->id;
		$current_user_pid = Auth::user()->personal_id;
		
		$friends = Auth::user()->friendsAccepted();
		if ($friends->count() == 0) {
			$friends = Auth::user()->friendOfAccepted();
		}
		
		if ($friends->count() > 0) {
			$levels = Level::where('user_id', $current_user_id)->orWhere('user_id', $friends->first()->id)->get();
			$friend_id = $friends->first()->id;
		} else {		
			$levels = Level::where('user_id', $current_user_id)->orWhere('is_default', '=', true)->get();
			$friend_id = 0;
		}
		
		return view('home',
			['user_id' => $current_user_pid,
			'levels' => $levels,
			'friend_id' => $friend_id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $current_user_id = Auth::user()->id;
		return view('level_create')->with('user_id', str_pad($current_user_id, 8, '0', STR_PAD_LEFT));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $current_user_id = Auth::user()->id;
		$current_user = Auth::user();
		
		$rules = array(
            'level_name' => 'required|min:2|max:1000',
            'points_to_win' => 'required|numeric|min:5|max:100',
			'level_prize' => 'required',
        );
		$this->validate($request, $rules);
		
                //Find friend
                $friends = Friend::where('user_id', $current_user_id)->where('accepted', true)->get();
		if($friends->count() == 0){
			$reverse_friends = Friend::where('friend_id', $current_user_id)->where('accepted', true)->get();
			if($reverse_friends->count() > 0){
				$friend_id = $reverse_friends->first()->user_id;
			}else{
				return redirect('/');
			}
		}else{
			$friend_id = $friends->first()->friend_id;
		}
                
		$level = new Level;
		$level->user_id = $current_user_id;
		$level->name = $request->level_name;
		//$level->prize_for_level = $request->level_prize;
		$level->points_to_win = $request->points_to_win;
                $level->friend_id = $friend_id;
		$level->save();
		
		$level_prize = LevelPrize::firstOrCreate(['user_id' => $current_user->id, 'level_id' => $level->id], ['prize' => $request->level_prize]);
		$level_prize->save();
		
		//Send notification to friend		
		$notification = new Notification;
		$notification->user_id = $friend_id;
		$notification->notification_text = '<strong>'.$current_user->name.' '.$current_user->lastname.'</strong> created a new level "'.$level->name.'"';
		$notification->level_id = $level->id;
		$notification->save();
                
                //Activate level if all other levels completed
                $active_levels_count = UserLevel::where(function($query) use ($current_user_id, $friend_id){
                    $query->where('user_id', $current_user_id);
                    $query->orWhere('user_id', $friend_id);
                })->where('completed', false)->count();
                        
                if($active_levels_count == 0){
                    $current_user_level_new_row = new UserLevel;
                    $current_user_level_new_row->user_id = $current_user_id;
                    $current_user_level_new_row->level_id = $level->id;
                    $current_user_level_new_row->save();
		
                    $friend_user_level_new_row = new UserLevel;
                    $friend_user_level_new_row->user_id = $friend_id;
                    $friend_user_level_new_row->level_id = $level->id;
                    $friend_user_level_new_row->save();
                }
                        
                        
		
		return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $current_user_id = Auth::user()->id;
		
		$level = Level::findOrFail($id);
		
		$friend_user_levels = UserLevel::where('level_id', '=', $level->id)->where('user_id', '<>', $current_user_id)->get();
		if($friend_user_levels->count() > 0){
			$friend = User::findOrFail($friend_user_levels->first()->user_id);
			
			$current_user_level_items = LevelItem::where('level_id', $level->id)->where('user_id', $current_user_id)->get();
			$friend_level_items = LevelItem::where('level_id', $level->id)->where('user_id', $friend->id)->get();
			
			$current_user_levels = UserLevel::where('level_id', '=', $level->id)->where('user_id', $current_user_id)->get();
			$level_completed = $current_user_levels->first()->completed;
			$won_user_id = $current_user_levels->first()->won_user_id;
			
			return view('level_details')->with(
				['level' => $level,
				'level_completed' => $level_completed,
				'friend' => $friend,
				'current_user_level_items' => $current_user_level_items,
				'friend_level_items' => $friend_level_items,
				'won_user_id' => $won_user_id]);
		}else{
			return response()->view('errors.level_unavailable', [], 403);
		}
		
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $current_user = Auth::user();
		$level = Level::findOrFail($id);
		
		$level_items = LevelItem::where('level_id', $level->id)->get();
		$level_editable = ($level_items->count() == 0);
		
		$user_levels = UserLevel::where('user_id', $current_user->id)->where('level_id', $level->id)->get();
		
		$prize_editable = true;
		$prize_editable_comment = '';
		if ($user_levels->count() == 0){
			$prize_editable = false;
			$prize_editable_comment = 'Level not started yet!';
		} elseif ($user_levels->first()->completed) {
			$prize_editable = false;
			$prize_editable_comment = 'Level already completed!';
		} elseif ($user_levels->first()->prize_not_allowed) {
			$prize_editable = false;
			$prize_editable_comment = 'You cannot enter you prize beacause your friend didn`t receive his on previous level!';
		}
		
		$data_array = array(
			'level' => $level,
			'level_editable' => $level_editable,
			'prize_editable' => $prize_editable,
			'prize_editable_comment' => $prize_editable_comment
		);
		
		return view('level_edit', $data_array);
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
		$current_user = Auth::user();
		
        $rules = array(
            'level_name' => 'required|min:2|max:1000',
            'points_to_win' => 'required|numeric|min:5|max:100',
        );
		$this->validate($request, $rules);
		
		$level = Level::findOrFail($id);
		
		$level_items = LevelItem::where('level_id', $level->id)->get();
		$level_editable = ($level_items->count() == 0);
		
		//find friend
		$friend_id = 0;		
		$friends = Friend::where('user_id', $current_user->id)->where('accepted', true)->get();
		if($friends->count() == 0){
			$reverse_friends = Friend::where('friend_id', $current_user->id)->where('accepted', true)->get();
			if($reverse_friends->count() > 0){
				$friend_id = $reverse_friends->first()->user_id;
			}
		}else{
			$friend_id = $friends->first()->friend_id;
		}
		
		if ($level_editable) {
			$send_notification_level_changed = false;
			if ($level->name != $request->level_name || $level->points_to_win != $request->points_to_win) {
				$send_notification_level_changed = true;
			}
			
			$level->name = $request->level_name;
			$level->points_to_win = $request->points_to_win;
			$level->save();
						
			if ($send_notification_level_changed && $friend_id > 0) {				
				$notification = new Notification;
				$notification->user_id = $friend_id;
				$notification->notification_text = '<strong>'.$current_user->name.' '.$current_user->lastname.'</strong> made changes to level "'.$level->name.'"';
				$notification->level_id = $level->id;
				$notification->save();				
			}
		}
		
		$user_levels = UserLevel::where('user_id', $current_user->id)->where('level_id', $level->id)->get();
		
		$prize_editable = true;
		if ($user_levels->count() == 0 || $user_levels->first()->completed || $user_levels->first()->prize_not_allowed){
			$prize_editable = false;			
		}
		
		if ($prize_editable) {
			$level_prize = LevelPrize::firstOrCreate(['user_id' => $current_user->id, 'level_id' => $level->id], ['prize' => $request->level_prize]);
			
			$send_notification_prize_changed = false;
			if ($level_prize->prize != $request->level_prize || $level_prize->wasRecentlyCreated) {
				$send_notification_prize_changed = true;
			}
			
			$level_prize->prize = $request->level_prize;
			$level_prize->save();
			
			if ($send_notification_prize_changed && $friend_id > 0) {
				$notification = new Notification;
				$notification->user_id = $friend_id;
				$notification->notification_text = '<strong>'.$current_user->name.' '.$current_user->lastname.'</strong> changed a prize in level "'.$level->name.'"';
				$notification->level_id = $level->id;
				$notification->save();
			}
		}
				
		return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
	
	public function show_level_prize($level_id)
	{
		$current_user = Auth::user();
		$level = Level::findOrFail($level_id);
		$user_levels = UserLevel::where('user_id', $current_user->id)->where('level_id', $level->id)->get();
		if ($user_levels->count() == 0) {
			return redirect('/');
		}
		
		$current_user_prizes = LevelPrize::where('user_id', $current_user->id)->where('level_id', $level->id)->get();
		if ($current_user_prizes->count() > 0) {
			$current_user_prize = $current_user_prizes->first()->prize;
		} else {
			$current_user_prize = '';
		}
		
		$friend_user_levels = UserLevel::where('level_id', '=', $level->id)->where('user_id', '<>', $current_user->id)->get();
		if ($friend_user_levels->count() > 0) {
			$friend = User::findOrFail($friend_user_levels->first()->user_id);
			
			$friend_prizes = LevelPrize::where('user_id', $friend->id)->where('level_id', $level->id)->get();
			if ($friend_prizes->count() > 0) {
				$friend_prize = $friend_prizes->first()->prize;
			} else {
				$friend_prize = '';
			}
			
			return view('level_prize')->with(
				['current_user_prize' => $current_user_prize,
				'friend_prize' => $friend_prize,
				'friend' => $friend,
				'won_user_id' => $friend_user_levels->first()->won_user_id,
				'current_user_prize_accepted' => $user_levels->first()->prize_accepted,
				'current_user_prize_not_accepted' => $user_levels->first()->prize_not_accepted,
				'level' => $level]);
		} else {
			return redirect('/');
		}				
	}
	
	public function update_level_prize($level_id)
	{
		$current_user = Auth::user();
		$current_user_id = $current_user->id;
		$level = Level::findOrFail($level_id);
		$user_levels = UserLevel::where('user_id', $current_user->id)->where('level_id', $level->id)->get();
		if ($user_levels->count() == 0) {
			return redirect('/');
		}
		
		if ($user_levels->first()->won_user_id != $current_user->id) {
			return redirect('/');
		}
		
		$user_level = $user_levels->first();
		$user_level->prize_accepted = true;
		$user_level->save();
		
		$friend_user_levels = UserLevel::where('level_id', '=', $level->id)->where('user_id', '<>', $current_user->id)->get();
		if ($friend_user_levels->count() > 0) {
			$friend = User::findOrFail($friend_user_levels->first()->user_id);
		} else {
			return redirect('/level/'.$level_id);
		}
		
		//move to next level
		//$next_level_id = Level::where('id', '>', $level->id)->min('id'); //where user_id = current_user_id OR friend_id = current_user_id
		$next_level_id = Level::where(function($query) use ($current_user_id){
			$query->where('user_id', $current_user_id);
			$query->orWhere('friend_id', $current_user_id);
		})->where('id', '>', $level->id)->min('id');
		$next_level = Level::findOrFail($next_level_id);
		
		$current_user_level_new_row = new UserLevel;
		$current_user_level_new_row->user_id = $current_user->id;
		$current_user_level_new_row->level_id = $next_level_id;
		$current_user_level_new_row->save();
		
		$friend_user_level_new_row = new UserLevel;
		$friend_user_level_new_row->user_id = $friend->id;
		$friend_user_level_new_row->level_id = $next_level_id;
		$friend_user_level_new_row->save();
		
		//send notifications
		$current_user_notification = new Notification;
		$current_user_notification->user_id = $current_user->id;
		$current_user_notification->notification_text = 'You and <strong>'.$friend->name.' '.$friend->lastname.'</strong> just moved to a new level "'.$next_level->name.'"';
		$current_user_notification->level_id = $next_level_id;
		$current_user_notification->save();
		
		$friend_user_notification = new Notification;
		$friend_user_notification->user_id = $friend->id;
		$friend_user_notification->notification_text = 'You and <strong>'.$current_user->name.' '.$current_user->lastname.'</strong> just moved to a new level "'.$next_level->name.'"';
		$friend_user_notification->level_id = $next_level_id;
		$friend_user_notification->save();
		
		return redirect('/level/'.$level_id);
		
		
	}
	
	public function update_level_no_prize($level_id)
	{
		$current_user = Auth::user();
		$current_user_id = $current_user->id;
		$level = Level::findOrFail($level_id);
		$user_levels = UserLevel::where('user_id', $current_user->id)->where('level_id', $level->id)->get();
		if ($user_levels->count() == 0) {
			return redirect('/');
		}
		
		if ($user_levels->first()->won_user_id != $current_user->id) {
			return redirect('/');
		}
		
		$user_level = $user_levels->first();
		$user_level->prize_not_accepted = true;
		$user_level->save();
		
		$friend_user_levels = UserLevel::where('level_id', '=', $level->id)->where('user_id', '<>', $current_user->id)->get();
		if ($friend_user_levels->count() > 0) {
			$friend = User::findOrFail($friend_user_levels->first()->user_id);
		} else {
			return redirect('/level/'.$level_id);
		}
		
		//move to next level
		$next_level_id = Level::where(function($query) use ($current_user_id){
			$query->where('user_id', $current_user_id);
			$query->orWhere('friend_id', $current_user_id);
		})->where('id', '>', $level->id)->min('id');
		$next_level = Level::findOrFail($next_level_id);
		
		$current_user_level_new_row = new UserLevel;
		$current_user_level_new_row->user_id = $current_user->id;
		$current_user_level_new_row->level_id = $next_level_id;
		$current_user_level_new_row->save();
		
		$friend_user_level_new_row = new UserLevel;
		$friend_user_level_new_row->user_id = $friend->id;
		$friend_user_level_new_row->level_id = $next_level_id;
		$friend_user_level_new_row->prize_not_allowed = true;
		$friend_user_level_new_row->save();
		
		//send notifications
		$current_user_notification = new Notification;
		$current_user_notification->user_id = $current_user->id;
		$current_user_notification->notification_text = 'You and <strong>'.$friend->name.' '.$friend->lastname.'</strong> just moved to a new level "'.$next_level->name.'"';
		$current_user_notification->level_id = $next_level_id;
		$current_user_notification->save();
		
		$friend_user_notification = new Notification;
		$friend_user_notification->user_id = $friend->id;
		$friend_user_notification->notification_text = 'You and <strong>'.$current_user->name.' '.$current_user->lastname.'</strong> just moved to a new level "'.$next_level->name.'"';
		$friend_user_notification->level_id = $next_level_id;
		$friend_user_notification->save();
		
		return redirect('/level/'.$level_id);
	}

	public function getLevels() {
        $current_user_id = Auth::user()->id;
        $current_user_pid = Auth::user()->personal_id;

        $friends = Auth::user()->friendsAccepted();
        if ($friends->count() == 0) {
            $friends = Auth::user()->friendOfAccepted();
        }

        if ($friends->count() > 0) {
            $levels = Level::where('user_id', $current_user_id)->orWhere('user_id', $friends->first()->id)->get();
            $friend_id = $friends->first()->id;
        } else {
            $levels = Level::where('user_id', $current_user_id)->orWhere('is_default', '=', true)->get();
            $friend_id = 0;
        }

        return response()->json(['responseCode' => 1, 'responseContent' => $levels]);
    }

}
