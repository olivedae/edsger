<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\BoxPermissionRepository;
use App\Repositories\RoutePermissionRepository;

class DashboardController extends Controller
{
    /**
     * The task repository instance.
     *
     * @var BoxPermissionRepository
     */
    protected $boxes, $routes;

    /**
     * Create a new controller instance.
     *
     * @param  BoxPermissionRepository  $permissions
     * @return void
     */
    public function __construct(BoxPermissionRepository $boxes, RoutePermissionRepository $routes)
    {
        $this->middleware('auth');
        $this->boxes = $boxes;
        $this->routes = $routes;
    }

    /**
     * Display a list of all of the user's permissions.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $boxes =
            $this->boxes->forUser($user);

        $routes =
            $this->routes->forUser($user);

        return view('dashboard', [
            'boxes' => $boxes,
            'routes' => $routes,
        ]);
    }
}
