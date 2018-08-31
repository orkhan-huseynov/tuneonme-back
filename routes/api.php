<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/email_exists', 'ProfileController@emailExists');
Route::post('/profile', 'ProfileController@store');

Route::get('/check-token', 'Auth\LoginController@checkToken')->middleware('auth:api');
Route::group(['middleware' => ['auth:api']], function() {
    // Auth
    Route::post('/logout','ProfileController@logoutApi');


    // Profile
    Route::get('/get-current-user-details', 'ProfileController@getCurrentUserDetails');
    Route::post('/store-profile-picture', 'ProfileController@save_profile_pic');
    Route::put('/save-profile-name-lastname', 'ProfileController@saveProfileNameLastname');
    Route::get('/get-levels-stats', 'ProfileController@getLevelsStats');
    Route::get('/get-search-suggestions/{searchString}', 'ProfileController@getSearchSuggestions');
});