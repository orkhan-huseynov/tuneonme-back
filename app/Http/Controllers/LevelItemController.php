<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\LevelItem;
use App\Models\Level;
use App\Models\UserLevel;
use App\Models\Notification;

class LevelItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //		
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
	
	public function create_level_item($level_id)
	{
		$level = Level::findOrFail($level_id);
		
		$level_last_items = LevelItem::where('level_id', $level->id)->get();
		if ($level_last_items->count() > 0) {
			$level_last_item = $level_last_items->last();
			if (!$level_last_item->accepted && !$level_last_item->declined) {
				return response()->view('errors.unaccepted_level_item_exists', ['level' => $level], 403);
			}
			
			if ($level_last_item->user_id == Auth::user()->id) {
				return response()->view('errors.not_your_turn', ['level' => $level], 403);
			}
		} else {
			$previous_level = UserLevel::where('user_id', Auth::user()->id)->where('level_id', '<>', $level->id)->orderBy('id', 'ASC')->get()->last();
			$previous_level_first_item = LevelItem::where('level_id', $previous_level->level_id)->orderBy('id', 'ASC')->get()->first();
			if ($previous_level_first_item->user_id == Auth::user()->id) {
				return response()->view('errors.not_your_turn', ['level' => $level], 403);
			}
		}		
		
		return view('level_item_create')->with('level', $level);
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
            'level_id' => 'required|numeric',
            'title' => 'required|min:2|max:255',
			'description' => 'required|min:3',
        );
		$this->validate($request, $rules);
		
		$level = Level::findOrFail($request->level_id);
		$user_levels = UserLevel::where('user_id', '=', $current_user_id)->where('level_id', '=', $level->id)->where('completed', '=', false)->get();
		if($user_levels->count() == 0){
			return response()->view('errors.cannot_add_level_item', [], 403);
		}
				
		$level_item = new LevelItem;
		$level_item->level_id = $request->level_id;
		$level_item->user_id = $current_user_id;
		$level_item->title = $request->title;
		$level_item->description = $request->description;
		$level_item->save();
		
		$friend_id = UserLevel::where('level_id', $level->id)->where('user_id', '<>', $current_user_id)->get()->first()->user_id;
		
		//Send notification
		$notification = new Notification;
		$notification->user_id = $friend_id;
		$notification->notification_text = '<strong>'.$current_user->name.' '.$current_user->lastname.'</strong> added a new item in "'.$level->name.'"';
		$notification->item_id = $level_item->id;
		$notification->save();
		
		return redirect('/level/'.$request->level_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $level_item = LevelItem::findOrFail($id);
		$level = Level::findOrFail($level_item->level_id);
		return view('level_item_details', ['level' => $level, 'level_item' => $level_item]);
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
        $current_user_id = Auth::user()->id;
		$current_user = Auth::user();
		
		$level_item = LevelItem::findOrFail($id);
		$rules = array(
			'level_id' => 'required|numeric',
			'comment' => 'required|min:2',
			'acceptance' => 'required',
		);
		
		$level = Level::findOrFail($request->level_id);
		$user_levels = UserLevel::where('user_id', '=', $current_user_id)->where('level_id', '=', $level->id)->where('completed', '=', false)->get();
		if($user_levels->count() == 0){
			return response()->view('errors.cannot_add_level_item', [], 403);
		}
		
		$this->validate($request, $rules);
		$level_item->comment = $request->comment;
		
		if($request->acceptance == 'accepted'){
			$level_item->accepted = true;
			$level_item->declined = false;
		}else{
			$level_item->declined = true;
			$level_item->accepted = false;
		}
		
		$level_item->save();
		
		$friend_id = UserLevel::where('level_id', $level->id)->where('user_id', '<>', $current_user_id)->first()->user_id;
		$friend = User::findOrFail($friend_id);
		
		//Send notification
		$notification = new Notification;
		$notification->user_id = $friend_id;
		if($level_item->accepted){
			$notification->notification_text = '<strong>'.$current_user->name.' '.$current_user->lastname.'</strong> accepted item in "'.$level->name.'"';
		}else{
			$notification->notification_text = '<strong>'.$current_user->name.' '.$current_user->lastname.'</strong> declined item in "'.$level->name.'"';
		}
		$notification->item_id = $level_item->id;
		$notification->save();
		
		//Check level completeness, mark as completed and move to next level if neccessary
		if(Level::max_score($level->id) >= $level->points_to_win){
			//mark level as completed
			$current_user_level_row = UserLevel::where('user_id', $current_user_id)->where('level_id', $level->id)->first();
			$current_user_level_row_object = UserLevel::findOrFail($current_user_level_row->id);
			$current_user_level_row_object->completed = true;
			$current_user_level_row_object->won_user_id = $friend_id;
			$current_user_level_row_object->save();
			
			$friend_user_level_row = UserLevel::where('user_id', $friend_id)->where('level_id', $level->id)->first();
			$friend_user_level_row_object = UserLevel::findOrFail($friend_user_level_row->id);
			$friend_user_level_row_object->completed = true;
			$friend_user_level_row_object->won_user_id = $friend_id;
			$friend_user_level_row_object->save();
			
			//send notifications
			$current_user_notification = new Notification;
			$current_user_notification->user_id = $current_user_id;
			$current_user_notification->notification_text = 'You and <strong>'.$friend->name.' '.$friend->lastname.'</strong> just completed level "'.$level->name.'"';
			$current_user_notification->level_id = $level->id;
			$current_user_notification->save();
			
			$friend_user_notification = new Notification;
			$friend_user_notification->user_id = $friend_id;
			$friend_user_notification->notification_text = 'You and <strong>'.$current_user->name.' '.$current_user->lastname.'</strong> just completed level "'.$level->name.'"';
			$friend_user_notification->level_id = $level->id;
			$friend_user_notification->save();
			
			//move to next level
			/*$next_level_id = Level::where('id', '>', $level->id)->min('id');
			$next_level = Level::findOrFail($next_level_id);
			
			$current_user_level_new_row = new UserLevel;
			$current_user_level_new_row->user_id = $current_user_id;
			$current_user_level_new_row->level_id = $next_level_id;
			$current_user_level_new_row->save();
			
			$friend_user_level_new_row = new UserLevel;
			$friend_user_level_new_row->user_id = $friend_id;
			$friend_user_level_new_row->level_id = $next_level_id;
			$friend_user_level_new_row->save();
			
			//send notifications
			$current_user_notification = new Notification;
			$current_user_notification->user_id = $current_user_id;
			$current_user_notification->notification_text = 'You and <strong>'.$friend->name.' '.$friend->lastname.'</strong> just moved to a new level "'.$next_level->name.'"';
			$current_user_notification->level_id = $next_level_id;
			$current_user_notification->save();
			
			$friend_user_notification = new Notification;
			$friend_user_notification->user_id = $friend_id;
			$friend_user_notification->notification_text = 'You and <strong>'.$current_user->name.' '.$current_user->lastname.'</strong> just moved to a new level "'.$next_level->name.'"';
			$friend_user_notification->level_id = $next_level_id;
			$friend_user_notification->save();*/
		}
				
		return redirect('/level/'.$request->level_id);
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
}
