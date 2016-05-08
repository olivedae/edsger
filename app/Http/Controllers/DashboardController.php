<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\BoxPermissionRepository;
use App\Repositories\RoutePermissionRepository;
use App\Repositories\DefaultBoxRepository;
use App\Policies\BoxPolicy;
use App\Repositories\BoxRepository;
use App\Box;
use App\Route;

class DashboardController extends Controller
{
    /**
     * The DefaultBox repository instance.
     *
     * @var DefaultBoxRepository
     */
    protected $defaultBox, $boxes;

    /**
     * Create a new controller instance.
     *
     * @param  DefaultBoxRepository $defaultBox
     * @return void
     */
    public function __construct(DefaultBoxRepository $defaultBox, BoxRepository $boxes)
    {
        $this->middleware('auth');
        $this->defaultBox = $defaultBox;
        $this->boxes = $boxes;
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
            'user' => $user,
        ]);
    }

    /**
     * Display a short list of items for the
     *     given box item.
     *
     * @param Request $request
     * @param Box $box
     * @return Response
     */
    public function displayBoxContents(Request $request, Box $box)
    {
        $this->authorize('index', $box);
        $user = $request->user();

        $items =
            $this->boxes->contentsFor($box, $user);

        return view('dashboard.index', [
            'items' => $items,
            'user' => $user,
        ]);
    }

    /**
     * Display a short list of items for the
     *     given route item.
     *
     * @param Request $request
     * @param Route $route
     * @return Response
     */
    public function displayRouteContents(Request $request, Route $route)
    {

    }
}
