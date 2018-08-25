<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'lastname', 'email', 'password', 'group_id', 'personal_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'active' => 'boolean',
		'is_default' => 'boolean',
    ];
    
    public function group(){
        return $this->belongsTo('App\Models\Group');
    }
	
    function friends()
    {
        //return $this->belongsToMany('App\Models\User', 'friends', 'user_id', 'friend_id')->wherePivot('accepted', '=', 1);
        return $this->belongsToMany('App\Models\User', 'friends', 'user_id', 'friend_id');
    }

    function friendsAccepted()
    {
        return $this->belongsToMany('App\Models\User', 'friends', 'user_id', 'friend_id')
            ->wherePivot('accepted', '=', 1);
    }
	
    // friendship that I started
    function friendsOfMine()
    {
        return $this->belongsToMany('App\Models\User', 'friends', 'user_id', 'friend_id')
             //->wherePivot('accepted', '=', 1) // to filter only accepted
             ->withPivot('accepted'); // or to fetch accepted value
    }

    function friendsOfMineAccepted()
    {
        return $this->belongsToMany('App\Models\User', 'friends', 'user_id', 'friend_id')
             ->wherePivot('accepted', '=', 1); // to filter only accepted
             //->withPivot('accepted'); // or to fetch accepted value
    }

    // friendship that I was invited to 
    function friendOf()
    {
        return $this->belongsToMany('App\Models\User', 'friends', 'friend_id', 'user_id')
             //->wherePivot('accepted', '=', 1)
             ->withPivot('accepted');
    }

    function friendOfAccepted()
    {
        return $this->belongsToMany('App\Models\User', 'friends', 'friend_id', 'user_id')
             ->wherePivot('accepted', '=', 1)
             ->withPivot('accepted');
    }

    // accessor allowing you call $user->friends
    public function getFriendsAttribute()
    {
        if (!array_key_exists('friends', $this->relations)) {
            $this->loadFriends();
        };

        return $this->getRelation('friends');
    }

    protected function loadFriends()
    {
        if (!array_key_exists('friends', $this->relations)) {
            $friends = $this->mergeFriends();
            $this->setRelation('friends', $friends);
        }
    }

    protected function mergeFriends()
    {
        return $this->friendsOfMine->merge($this->friendOf);
    }
    
    public function notifications() {
        return $this->hasMany('App\Models\Notification');
    }

    public function AauthAcessToken(){
        return $this->hasMany('App\Models\OauthAccessToken');
    }

}
