<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/welcome';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
			'lastname' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
		$last_users = User::where('active', 1)->orderBy('personal_id', 'desc')->take(1)->get();
		if ($last_users->count() > 0) {
			$new_pid = $this->get_new_personal_id($last_users->first()->personal_id);
		} else {
			$new_pid = 'TM000001';
		}
		
        return User::create([
            'name' => $data['name'],
			'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
			'personal_id' => $new_pid,
        ]);
    }
	
	protected function get_new_personal_id($pid)
	{
		$int_part = abs((integer) filter_var($pid, FILTER_SANITIZE_NUMBER_INT));
		$int_part = str_pad(++$int_part, 6, '0', STR_PAD_LEFT);
		return 'TM'.$int_part;
	}
}
