<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\UserIcon;
use App\Classes\Identicon_Generator;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;


class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
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
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed'
            // TODO how to assert it being checked
            //'terms' => 'required|true'
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
        $user = User::create([
            'first_name' => $data['firstname'],
            'last_name' => $data['lastname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        // Now we want to generate a random user icon for this new user
        $base_64_image = Identicon_Generator::createNewIcon($user->email);

        $UserIcon = UserIcon::create([
            'user_id' => $user->id,
            'file_extension' => 'png',
            'data' => $base_64_image,
        ]);

        return $user;

    }
}
