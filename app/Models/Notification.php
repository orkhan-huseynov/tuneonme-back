<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $casts = [
        'viewed' => 'boolean',
    ];
    
    protected $fillable = [
        'user_id', 'notification_text', 'friend_request_id', 'level_id', 'item_id', 'viewed',
    ];
    
    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
