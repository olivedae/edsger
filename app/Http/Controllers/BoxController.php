<?php

namespace App\Http\Controllers;

use App\Box;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class BoxController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Create a new Box - only used for the owner
     *      
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        return Box::create([
            'name' => $request->name
        ]);
    }
}
