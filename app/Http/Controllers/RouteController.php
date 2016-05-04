<?php

namespace App\Http\Controllers;

use App\Route;
use App\RoutePermission;
use App\Repositories\RouteRepository;
use Illuminate\Http\Request;
use App\Http\Requests;

class RouteController extends Controller
{

    /**
     * The task repository instance.
     *
     * @var TaskRepository
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
        ]);

        // TODO: insert given locations

        RoutePermission::create([
            'user_id' => $request->user()->id,
            'route_id' => $route->id,
            'is_owner' => true,
            'can_edit' => true,
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
     * Deletes an entry in route_permissions.
     *     In addition, deletes the actual
     *     route if the user is the owner.
     *
     * @param Request $request
     * @param Route $route
     * @return Response
     */
    public function destroy(Request $request, Route $route)
    {
        $this->authorize('destroy', $route);

        /*
         * Delete the instance of RoutePermission
         */
        $permission =
            RoutePermission::where('user_id', $request->user()->id)
                ->where('route_id', $route->id)
                ->first();

        $permission->delete();

        /*
         * If they're the owner of the route,
         *     delete that route also which
         *     cascades for entries in
         *     route_permissions and route_shares.
         */
        if ($permission->is_owner) {
            $route->delete();
        }

        return redirect('dashboard');
    }
}
