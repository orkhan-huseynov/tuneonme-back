<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flaw extends Model
{
    protected $casts = [
        'accepted' => 'boolean',
        'declined' => 'boolean',
    ];
}
