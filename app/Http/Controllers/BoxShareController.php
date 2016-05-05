<?php

namespace App\Http\Controllers;

use App\User;
use App\BoxPermission;
use App\BoxShare;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class BoxShareController extends Controller
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
     * Display a view for sharing boxes
     *
     * @param Request $request
     * @param BoxPermission $permission
     * @return Response
     */
    public function new(Request $request, Box $box)
    {
        $this->authorize('shareable', $box);

        return view('shares.boxes.new', [
            'box' => $box
        ]);
    }

    /**
     * Create a new entry for box_shares which in addition
     *     creates a new entry in box_permissions
     *
     * TODO: have all routes in the shared box also
     *     be shared
     *
     * @param Request $request
     * @param BoxPermission $permission
     * @return BoxPermission
     */
    public function store(Request $request, Box $box)
    {
        $this->validate($request, [
            'email' => 'required|email|max:255'
        ]);

        $user =
            User::where('email', '=', $request->email)
                 ->firstOrFail();

        $this->authorize('shareable', $box);

        // Creates a new BoxPermission

        $canEdit = $request->edit ? true : false;

        $permission = BoxPermission::create([
            'user_id' => $user->id,
            'box_id' => $box->id,
            'is_owner' => false,
            'can_edit' => $canEdit,
        ]);

        // Creates an instance of BoxShare

        $invitation = BoxShare::create([
            'user_from_id' => $request->user()->id,
            'user_to_id' => $user->id,
            'box_id' => $box->id,
            'accepted' => false,
            'pending' => true,
        ]);

        return redirect('dashboard');
    }

    /**
     * Displays a view of all the users a certain
     *     box has been shared with
     */
    public function index(Request $request, Box $box)
    {
        $this->authorize('index', $box);

        $boxShares =
            $this->shares->forBox($box);

        return view('shares.boxes.index', [
            'box_shares' => $boxShares
        ]);
    }

    /**
     * Deletes a given share
     *
     */
    public function destroy(Request $request, BoxShare $share)
    {
        $this->authorize('destroy', $share);

        $share->delete();

        $permission =
            BoxPermission::where('box_id', $share->box_id)
                ->where('user_id', $request->user()->id)
                ->firstOrFail();

        $permission->delete();

        return redirect('dashboard');
    }
}
