<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\DefaultBox;
use App\DefaultBoxContainsRoutes;
use App\Repositories\RouteShareRepository;
use App\Route;
use App\RoutePermission;
use App\RouteShare;
use App\Http\Requests;

class RouteShareController extends Controller
{
    /**
     * The RouteShare repository instance.
     *
     * @var RouteShareRepository
     */
    protected $shares;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(RouteShareRepository $shares)
    {
        $this->middleware('auth');
        $this->shares = $shares;
    }

    /**
     * Display a view for sharing routes
     *
     * @param Request $request
     * @param BoxPermission $permission
     * @return Response
     */
    public function new(Request $request, Route $route)
    {
        $this->authorize('shareable', $route);

        return view('shares.routes.new', [
            'route' => $route
        ]);
    }

    /**
     * Create a new entry for route_shares which in addition
     *     creates a new entry in route_permissions
     *
     * @param Request $request
     * @param BoxPermission $permission
     * @return BoxPermission
     */
    public function store(Request $request, Route $route)
    {
        $this->authorize('shareable', $route);

        $this->validate($request, [
            'email' => 'required|email|max:255'
        ]);

        $user =
            User::where('email', '=', $request->email)
                ->firstOrFail();

        /**
         * Creates a new route permission
         *     as it is a foreign key in route_shares
         */

        $canEdit = $request->edit ? true : false;

        $permission = RoutePermission::create([
            'user_id' => $user->id,
            'route_id' => $route->id,
            'is_owner' => false,
            'can_edit' => $canEdit
        ]);

        /**
         * Creates a new instance of RouteShare
         */

        $invitation = RouteShare::create([
            'user_from_id' => $request->user()->id,
            'user_to_id' => $user->id,
            'route_id' => $route->id,
            'accepted' => false,
            'pending' => true,
        ]);

        /**
         * Puts it in the default box for the user
         */

        $defaultBox = DefaultBox::where('user_id', $user->id)->first();
        DefaultBoxContainsRoutes::create([
            'default_box_id' => $defaultBox->id,
            'route_id' => $route->id,
        ]);

        return redirect('dashboard');
    }

    /**
     * Displays a view of all the users a certain
     *     route has been shared with.
     */
    public function index(Request $request, Route $route)
    {
        $this->authorize('index', $route);

        $route_shares =
            $this->shares->forRoute($route);

        return view('shares.routes.index', [
            'route_shares' => $route_shares
        ]);
    }

    /**
     * Deletes a given share
     *
     */
    public function destroy(Request $request, RouteShare $share)
    {
        $this->authorize('destroy', $share);

        $share->delete();

        $permission =
            RoutePermission::where('route_id', $share->route_id)
                ->where('user_id', $request->user()->id)
                ->first();

        $permission->delete();

        $defaultBox =
            DefaultBox::where('user_id', $request->user()->id)
                ->first();

        $containerEntry =
            DefaultBoxContainsRoutes::where('default_box_id', $defaultBox->id)
                ->where('route_id', $share->route_id)
                ->first();

        return redirect('dashboard');
    }
}
