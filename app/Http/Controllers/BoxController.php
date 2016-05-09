<?php

namespace App\Http\Controllers;

use App\BoxContainsBoxes;
use App\BoxPermission;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\BoxRepository;
use App\Box;
use App\DefaultBox;
use App\DefaultBoxContainsBoxes;

class BoxController extends Controller
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
     * Display a list of all of the user's boxes.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        $boxes =
            $this->boxes
                 ->forUser($request->user());

        return view('boxes.index', [
            'boxes' => $boxes,
        ]);
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
            'parent' => 'required',
        ]);

        $inDefaultBox = $request->parent == 'default' ? true : false;

        $box = Box::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        $user = $request->user();

        $permission = BoxPermission::create([
            'user_id' => $user->id,
            'box_id' => $box->id,
            'is_owner' => true,
            'can_edit' => true,
        ]);

        if ($inDefaultBox) {
            $defaultBox =
                DefaultBox::where('user_id', $request->user()->id)
                    ->first();

            DefaultBoxContainsBoxes::create([
                'box_id' => $box->id,
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
            BoxContainsBoxes::create([
                'parent_box_id' => $parent->id,
                'box_id' => $box->id,
            ]);
        }

        return redirect('/');
    }

    /**
    * Display a view for creating new boxes
    *
    * @param  Request  $request
    * @return Response
    */
   public function new(Request $request)
   {
       $user = $request->user();
       $boxes = $this->boxes->forUser($user);
       return view('boxes.new', [
           "boxes" => $boxes,
       ]);
   }

   /**
    * Deletes an entry in boxes if and
    *     only if the user deleteing
    *     the box is the owner of it.
    *
    * @param Request $request
    * @param Box $box
    * @return Response
    */
   public function destroy(Request $request, Box $box)
   {
       $this->authorize('destroy', $box);

       $box->deleteAllContents();
       $box->delete();

       return redirect('/');
   }
}
