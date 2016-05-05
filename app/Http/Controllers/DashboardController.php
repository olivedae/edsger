<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\BoxPermissionRepository;
use App\Repositories\RoutePermissionRepository;
use App\Repositories\DefaultBoxRepository;

class DashboardController extends Controller
{
    /**
     * The DefaultBox repository instance.
     *
     * @var DefaultBoxRepository
     */
    protected $defaultBox;

    /**
     * Create a new controller instance.
     *
     * @param  DefaultBoxRepository $defaultBox
     * @return void
     */
    public function __construct(DefaultBoxRepository $defaultBox)
    {
        $this->middleware('auth');
        $this->defaultBox = $defaultBox;
    }

    /**
     * Display a short list of all of the user's permissions
     *     contained in the default box.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $items =
            $this->defaultBox->forUser($user);

        return view('dashboard.index', [
            'items' => $items,
            'user' => $request->user(),
        ]);
    }
}
