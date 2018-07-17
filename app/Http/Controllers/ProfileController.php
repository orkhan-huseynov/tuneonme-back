<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserLevel;
use Auth;
use Image;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $levels_completed = UserLevel::where('user_id', $id)->where('completed', true)->count();
        $levels_won = UserLevel::where('user_id', $id)->where('won_user_id', $id)->count();
	return view('profile')->with(['user' => $user, 'levels_completed' => $levels_completed, 'levels_won' => $levels_won]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function save_profile_pic(Request $request)
    {
        $current_user = Auth::user();
        
        if ($request->hasFile('userpic')) {
            $filename  = time() . '.' . $request->userpic->getClientOriginalExtension();
            //$path = public_path('images/'.$filename);
            $path = '/var/www/html/tuneon.me/public_html/storage/app/public/images/'.$filename;
            Image::make($request->userpic->getRealPath())->resize(500, null, function ($constraint) {
    $constraint->aspectRatio();
})->save($path);
            //$path = $request->userpic->store('images', 'public');
            $current_user->profile_picture = $filename;
            $current_user->save();
            return response()->json(['status' => 'ok'], 200);
        }
    }
  
}
