<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LevelItem extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'level_id', 'user_id', 'title', 'description', 'comment', 'accepted', 'declined',
    ];
	
	/**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'accepted' => 'boolean', 'declined' => 'boolean',
    ];
}
