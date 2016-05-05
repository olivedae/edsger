<?php

namespace App\Http\Controllers;

use App\Route;
use App\DefaultBox;
use App\DefaultBoxContainsRoutes;
use App\RoutePermission;
use App\Repositories\RouteRepository;
use Illuminate\Http\Request;
use App\Http\Requests;

class RouteController extends Controller
{

    /**
     * The route repository instance.
     *
     * @var RouteRepository
     */
    protected $routes;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(RouteRepository $routes)
    {
        $this->middleware('auth');
        $this->routes = $routes;
    }

    /**
     * Display a list of all of the user's routes.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        $routes =
            $this->routes
                 ->forUser($request->user());

        return view('routes.index', [
            'routes' => $routes,
        ]);
    }

    /**
     * Create a new route
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255'
        ]);

        $route = Route::create([
            'name' => $request->name,
            'description' => $request->description,
            'in_default_box' => true,
        ]);

        // TODO: insert given locations

        RoutePermission::create([
            'user_id' => $request->user()->id,
            'route_id' => $route->id,
            'is_owner' => true,
            'can_edit' => true,
        ]);

        $box =
            DefaultBox::where('user_id', $request->user()->id)
                ->first();

        DefaultBoxContainsRoutes::create([
            'route_id' => $route->id,
            'default_box_id' => $box->id,
        ]);

        return redirect('dashboard');
    }

    /**
     * Display a view for creating new routes
     *
     * @param  Request  $request
     * @return Response
     */
    public function new(Request $request)
    {
        return view('routes.new');
    }

    /**
     * Deletes an entry in routes if and
     *     only if the user deleteing
     *     the route is the owner of it.
     *
     * @param Request $request
     * @param Route $route
     * @return Response
     */
    public function destroy(Request $request, Route $route)
    {
        $this->authorize('destroy', $route);

        $route->delete();

        return redirect('dashboard');
    }
}
