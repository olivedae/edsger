<?php

namespace App\Http\Controllers;

use App\BoxPermission;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\BoxRepository;
use App\Box;
use DB;
use App\DefaultBox;
use App\DefaultBoxContainsBoxes;

class BoxPermissionController extends Controller
{
    /**
     * The box repository instance.
     *
     * @var BoxRepository
     */
    protected $boxes;


    /**
     * Create a new controller instance.
     *
     * @param  BoxPermissionRepository  $permissions
     * @return void
     */
    public function __construct(BoxRepository $boxes)
    {
        $this->middleware('auth');
        $this->boxes = $boxes;
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
            'name' => $request->name,
            'description' => $request->description,
            'in_default_box' => true
        ]);

        $user = $request->user();

        $permission = BoxPermission::create([
            'user_id' => $user->id,
            'box_id' => $box->id,
            'is_owner' => true,
            'can_edit' => true,
        ]);

        $defaultBox =
            DefaultBox::where('user_id', $request->user()->id)
                ->first();

        DefaultBoxContainsBoxes::create([
            'box_id' => $box->id,
            'default_box_id' => $defaultBox->id,
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
    public function destroy(Request $request, Box $box)
    {
        $this->authorize('destroy', $box);

        /*
         * Delete the instance of BoxPermission
         */
        $permission =
            BoxPermission::where('user_id', $request->user()->id)
                ->where('box_id', $box->id)
                ->first();

        $permission->delete();

        /*
         * If they're the owner of hte box,
         *     delete that box also which
         *     cascades for entries in
         *     box_permissions.
         */
        if ($permission->is_owner) {
            $box->delete();
        }

        return redirect('dashboard');
    }
}
