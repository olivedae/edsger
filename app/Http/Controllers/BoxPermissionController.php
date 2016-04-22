<?php

namespace App\Http\Controllers;

use App\BoxPermission;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\BoxPermissionRepository;
use App\Box;

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
     * @param User $user Box $box
     * @return BoxPermission
     */
    public function ownerStore(Request $request)
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
            'can_edit_contents' => true,
            'can_share' => true,
            'can_revoke_shares' => true,
            'can_edit_box_settings' => true,
            'can_edit_contents_settings' => true
        ]);

        return redirect('dashboard');
    }

     /**
     * Display a list of all of the user's permissions.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        return view('boxes.index', [
            'box_permissions' => $this->permissions->forUser($request->user()),
        ]);
    }
}

