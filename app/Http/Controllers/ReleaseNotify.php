<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Flash;
use App\ReleaseNotify;
use App\Http\Requests;

class ReleaseNotify extends Controller
{
    /**
     * Stores the given email for later
     *     use.
     *
     * @param Request $request
     * @return Response
     */
    public function post(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|max:255|unique:release_notifies'
        ]);

        ReleaseNotify::create([
            'email' => $request->email,
        ]);

        Flash::message("Thank you! We'll let you know when Edsger 1.0 ships.");

        return redirect('/');
    }
}
