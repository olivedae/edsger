<?php

namespace App\Http\Controllers;

use App\Location;
use App\RouteLocation;
use App\Box;
use App\BoxPermission;
use App\Repositories\BoxRepository;
use App\BoxContainsRoutes;
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
    protected $routes, $boxes;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(RouteRepository $routes, BoxRepository $boxes)
    {
        $this->middleware('auth');
        $this->routes = $routes;
        $this->boxes = $boxes;
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
            'name' => 'required|max:255',
            'parent' => 'required',
            'locations' => 'required',
        ]);

        $inDefaultBox = $request->parent == 'default' ? true : false;

        $route = Route::create([
            'name' => $request->name,
            'description' => $request->description,
            'in_default_box' => true,
        ]);

        $user = $request->user();

        RoutePermission::create([
            'user_id' => $user->id,
            'route_id' => $route->id,
            'is_owner' => true,
            'can_edit' => true,
        ]);

        if ($inDefaultBox) {
            $defaultBox =
                DefaultBox::where('user_id', $user->id)
                    ->first();
            DefaultBoxContainsRoutes::create([
                'route_id' => $route->id,
                'default_box_id' => $defaultBox->id,
            ]);
        } else {
            $parent =
                Box::where('id', $request->parent)
                    ->firstOrFail();
            $permission =
                BoxPermission::where('box_id', $parent->id)
                    ->where('user_id', $user->id)
                    ->firstOrFail();
            BoxContainsRoutes::create([
                'parent_box_id' => $parent->id,
                'route_id' => $route->id,
            ]);
        }

        /**
         * TODO add locations
         */


        return redirect('/');
    }

    /**
     * Display a view for creating new routes
     *
     * @param  Request  $request
     * @return Response
     */
    public function new(Request $request)
    {
        $user = $request->user();
        $boxes = $this->boxes->forUser($user);
        return view('routes.new', [
            "boxes" => $boxes
        ]);
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

        return redirect('/');
    }
}
