<?php

namespace App\Http\Controllers;

use App\BoxPermission;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\BoxPermissionRepository;
use App\Box;
use DB;

class BoxPermissionController extends Controller
{
    /**
     * The task repository instance.
     *
     * @var TaskRepository
     */
    protected $permissions;


    /**
     * Create a new controller instance.
     *
     * @param  BoxPermissionRepository  $permissions
     * @return void
     */
    public function __construct(BoxPermissionRepository $permissions)
    {
        $this->middleware('auth');
        $this->permissions = $permissions;
    }


    /**
     * Create a new entry in box_permissions, which
     *     is the default for owners making a new
     *     box.
     *
     * @param Request $request
     * @return BoxPermission
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $box = Box::create([
            'name' => $request->name
        ]);

        $user = $request->user();

        $permission = BoxPermission::create([
            'user_id' => $user->id,
            'box_id' => $box->id,
            'is_owner' => true,
            'can_edit' => true,
        ]);

        return redirect('dashboard');
    }

     /**
     * Display a view for creating new boxes
     *
     * @param  Request  $request
     * @return Response
     */
    public function new(Request $request)
    {
        return view('boxes.new');
    }

    /**
     * Deletes an entry in box_permissions.
     *     In addition, deletes the actual
     *     box if the user is the owner.
     *
     * @param Request $request
     * @param BoxPermission $permission
     * @return Response
     */
    public function destroy(Request $request, BoxPermission $permission)
    {
        $this->authorize('destroy', $permission);

        /*
         * Delete the instance of BoxPermission
         */
        $permission->delete();

        /*
         * If they're the owner of hte box,
         *     delete that box also which
         *     cascades for entries in
         *     box_permissions.
         */
        if ($permission->is_owner) {
            Box::destroy($permission->box_id);
        }

        return redirect('dashboard');
    }
}
