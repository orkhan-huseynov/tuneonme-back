<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['middleware' => ['web', 'auth']], function() {
    Route::get('/', 'LevelController@index');
    Route::get('/home', 'LevelController@index');
	Route::get('/welcome', 'HomeController@welcome');
    Route::resource('level', 'LevelController');
    Route::get('/home/get_by_id/{pid}', 'HomeController@user_by_id');
    Route::get('/home/send_request/{to_user_id}', 'HomeController@send_request');
    Route::get('/home/exterminate_user/{user_id}', 'HomeController@exterminate_user');
    Route::get('/home/accept_request/{from_user_id}', 'HomeController@accept_request');
    
    Route::get('/notification', 'NotificationController@index');
    Route::get('/notification/{id}', 'NotificationController@show');
    Route::get('/get_notifications', 'NotificationController@get_notifications');
	Route::get('/mark_notifications_viewed', 'NotificationController@mark_all_as_viewed');

    Route::get('/connection_request/get_requests', 'ConnectionRequestController@get_requests');
    Route::get('/connection_request/accept/{id}', 'ConnectionRequestController@accept');
    Route::get('/connection_request/delete/{id}', 'ConnectionRequestController@delete');
    Route::resource('connection_request', 'ConnectionRequestController');

    Route::post('/profile/save_profile_pic', 'ProfileController@save_profile_pic');
    Route::resource('profile', 'ProfileController');

    Route::get('/level_item/create_level_item/{level_id}', 'LevelItemController@create_level_item');
    Route::resource('level_item', 'LevelItemController');

    Route::get('/level/prize/{level_id}', 'LevelController@show_level_prize');
    Route::get('/level/got_my_prize/{level_id}', 'LevelController@update_level_prize');
	Route::get('/level/not_got_my_prize/{level_id}', 'LevelController@update_level_no_prize');
});
Route::resource('contest', 'FlawController');
Route::get('/contest/details', 'FlawController@details');

Auth::routes();



Route::get('admin', function(){
    return redirect('/admin/dashboard');
});

Route::group(['middleware' => ['web', 'auth', 'isadmin'], 'prefix' => 'admin'], function () {
    //Dashboard Route
    Route::get('dashboard', function() {
        return view('admin.dashboard');
    });

    //System
    Route::resource('system-users', 'Admin\System\UsersController');
    
    //Structure
    Route::resource('structure-sections', 'Admin\Structure\SectionController');
    Route::resource('structure-pages', 'Admin\Structure\PageController');
});
