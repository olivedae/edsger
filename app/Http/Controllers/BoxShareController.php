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
    public function new(Request $request, BoxPermission $permission)
    {
        $this->authorize('shareable', $permission);

        return view('shares.boxes.new', [
            'permission' => $permission
        ]);
    }

    /**
     * Create a new entry for box_shares which in addition
     *     creates a new entry in box_permissions
     *
     * @param Request $request
     * @param BoxPermission $permission
     * @return BoxPermission
     */
    public function store(Request $request, BoxPermission $permission)
    {
        $this->validate($request, [
            'email' => 'required|email|max:255'
        ]);

        $user =
            User::where('email', '=', $request->email)
                 ->firstOrFail();

        $this->authorize('shareable', $permission);

        // Creates a new BoxPermission

        $canEdit = $request->edit ? true : false;

        $new_permission = BoxPermission::create([
            'user_id' => $user->id,
            'box_id' => $permission->box_id,
            'is_owner' => false,
            'can_edit' => $canEdit,
        ]);

        // Creates an instance of BoxShare

        $invitation = BoxShare::create([
            'user_from_id' => $request->user()->id,
            'user_to_id' => $user->id,
            'box_id' => $permission->box_id,
            'accepted' => false,
            'pending' => true,
        ]);

        return redirect('dashboard');
    }
}
