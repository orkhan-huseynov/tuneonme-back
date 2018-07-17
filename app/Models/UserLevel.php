<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLevel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'level_id', 'lastname', 'completed',
    ];
	
	/**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'completed' => 'boolean',
		'prize_accepted' => 'boolean',
		'prize_not_accepted' => 'boolean',
		'prize_not_allowed' => 'boolean',
    ];
}
