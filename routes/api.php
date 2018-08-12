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
    Route::get('/get-current-user-details', 'ProfileController@getCurrentUserDetails');
});