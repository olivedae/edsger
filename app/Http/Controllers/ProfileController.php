<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\User;

class ProfileController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function getUpdateName($request) {
        return view('profile.name');
    }

    public function postUpdateName($request) {

        $rules = array(
            'first_name' => 'Required|max:255',
            'last_name' => 'max:255',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails())
        {
            $messages = $validator->messages();
            return View('profile', ['errors' => $messages, 'modal' => "#update-name-modal"]);
        }

        $user = $request->user();
        if($user) {
            $user->first_name = $first_name;
            $user->last_name = $last_name;
            $user->save();
        }

        return Redirect('profile');

    }



}
