<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserLevel;
use Auth;
use Illuminate\Support\Facades\Input;
use Image;
use Validator;

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
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:255',
            'lastname' => 'required|min:3|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'responseCode' => 2,
                'responseContent' => 'Validation error',
            ]);
        }

        $user = new User();
        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->personal_id = $this->getNewPersonalId();

        if ($user->save()) {
            return response()->json([
                'responseCode' => 1,
                'responseContent' => $user->id,
            ]);
        } else {
            return response()->json([
                'responseCode' => 2,
                'responseContent' => 'Saving error',
            ]);
        }
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

    public function getCurrentUserDetails()
    {
        $user = Auth::user();

        $hasActiveConnections = false;
        if ($user->friendsOfAccepted != null) {
            $hasActiveConnections = ($user->friends->count() > 0 && ($user->friendsOfMineAccepted->count() > 0 || $user->friendsOfAccepted->count() > 0));
        }

        $friend_user = null;

        if ($hasActiveConnections) {
            $friend_user = ($user->friendsOfMineAccepted->count() > 0) ? $user->friendsOfMineAccepted->first() : $user->friendOfAccepted->first();
            $friend_user = [
                'id' => $friend_user->id,
                'name' => $friend_user->name,
                'surname' => $friend_user->surname,
                'lastname' => $friend_user->lastname,
                'email' => $friend_user->email,
                'personalId' => $friend_user->personal_id,
                'profilePicture' => $friend_user->personal_id,
                'memberSince' => $friend_user->created_at->timestamp,
            ];
        }

        return response()->json([
            'responseCode' => 1,
            'responseContent' => [
                'id' => $user->id,
                'name' => $user->name,
                'surname' => $user->surname,
                'lastname' => $user->lastname,
                'email' => $user->email,
                'personalId' => $user->personal_id,
                'profilePicture' => $user->profile_picture,
                'memberSince' => $user->created_at->timestamp,
                'hasActiveConnections' => $hasActiveConnections,
                'friend' => $friend_user,
            ],
        ]);
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
        
        if ($request->hasFile('profilePicture')) {
            $filename  = time() . '.' . $request->profilePicture->getClientOriginalExtension();
            //$path = '/var/www/html/tuneon.me/public_html/storage/app/public/images/'.$filename;
            $path = storage_path('app/public/images/') . $filename;

            Image::make($request->profilePicture->getRealPath())->resize(500, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path);

            $current_user->profile_picture = $filename;
            if ($current_user->save()) {
                return response()->json([
                    'responseCode' => 1,
                    'responseContent' => $filename,
                ], 200);
            } else {
                return response()->json([
                    'responseCode' => 2,
                    'responseContent' => 'Could not save this picture',
                ], 200);
            }
        } else {
            return response()->json([
               'responseCode' => 2,
               'responseContent' => 'No file was provided',
            ], 200);
        }
    }

    public function saveProfileNameLastname(Request $request)
    {
        $current_user = Auth::user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:255',
            'lastname' => 'required|min:3|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'responseCode' => 2,
                'responseContent' => 'Validation error',
            ]);
        }

        $current_user->name = $request->name;
        $current_user->lastname = $request->lastname;

        if ($current_user->save()) {
            return response()->json([
                'responseCode' => 1,
                'responseContent' => 'ok',
            ]);
        } else {
            return response()->json([
                'responseCode' => 2,
                'responseContent' => 'Saving error',
            ]);
        }
    }

    public function emailExists(Request $request)
    {
        $email = filter_var($request->email, FILTER_SANITIZE_STRING);
        $userFound = User::where('email', $email)->count() > 0;

        return response()->json([
            'responseCode' => 1,
            'responseContent' => $userFound,
        ]);
    }

    public function logoutApi()
    {
        if (Auth::check()) {
            Auth::user()->AauthAcessToken()->delete();

            return response()->json([
                'responseCode' => 1,
                'responseContent' => 'ok',
            ]);
        }

        return response()->json([
            'responseCode' => 2,
            'responseContent' => 'Logout error',
        ]);
    }

    public function getNewPersonalId() {
        $lastUsers = User::where('active', true)->orderBy('personal_id', 'desc')->take(1)->get();
        if ($lastUsers->count() > 0) {
            $newPid = $this->generatePID($lastUsers->first()->personal_id);
        } else {
            $newPid = 'TM000001';
        }

        return $newPid;
    }

    private function generatePID($pid) {
        $int_part = abs((integer) filter_var($pid, FILTER_SANITIZE_NUMBER_INT));
        $int_part = str_pad(++$int_part, 6, '0', STR_PAD_LEFT);
        return 'TM'.$int_part;
    }
  
}
