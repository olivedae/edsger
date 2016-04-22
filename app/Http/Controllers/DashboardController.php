<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\BoxPermissionRepository;


class DashboardController extends Controller
{
    /**
     * The task repository instance.
     *
     * @var BoxPermissionRepository
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
     * Display a list of all of the user's permissions.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        return view('dashboard', [
            'box_permissions' => $this->permissions->forUser($user)
        ]);
    }
}
