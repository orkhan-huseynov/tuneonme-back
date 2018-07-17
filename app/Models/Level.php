<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Models\LevelItem;
use App\Models\UserLevel;

class Level extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'points_to_win', 'user_id', 'friend_id',
    ];
	
	/**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_default' => 'boolean',
    ];
	
	public static function score($level_id, $user_id) {
		return LevelItem::where('level_id', $level_id)->where('user_id', $user_id)->where('accepted', true)->count();
	}
	
	public static function max_score($level_id) {
		$user_levels = UserLevel::where('level_id', $level_id)->get();
		$scores_array = array();
		
		foreach($user_levels as $user_level){
			array_push($scores_array, Level::score($level_id, $user_level->user_id));
		}
		
		return max($scores_array);
	}
	
	public static function unreviewed_items_count($level_id, $user_id) {
		return LevelItem::where('level_id', $level_id)->where('user_id', $user_id)->where('accepted', false)->where('declined', false)->count();
	}
}
