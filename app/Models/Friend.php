<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    protected $casts = [
        'accepted' => 'boolean',
    ];
	
    protected $fillable = [
        'user_id', 'friend_id', 'accepted',
    ];
}
