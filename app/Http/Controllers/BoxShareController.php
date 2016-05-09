<?php

namespace App\Http\Controllers;

use App\DefaultBox;
use App\DefaultBoxContainsBoxes;
use App\User;
use App\BoxPermission;
use App\BoxShare;
use App\Repositories\BoxShareRepository;
use App\Box;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class BoxShareController extends Controller
{
    /**
     * The box share repository instance.
     *
     * @var BoxShareRepository
     */
    protected $shares;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BoxShareRepository $shares)
    {
        $this->middleware('auth');
        $this->shares = $shares;
    }

    /**
     * Display a view for sharing boxes
     *
     * @param Request $request
     * @param Box $box
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
     * @param Box $box
     * @return Response
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

        /**
         * Creates a new box permission
         *     as it is a foreign key in box_shares
         */

        $canEdit = $request->edit ? true : false;

        $permission = BoxPermission::create([
            'user_id' => $user->id,
            'box_id' => $box->id,
            'is_owner' => false,
            'can_edit' => $canEdit,
        ]);

        /**
         * Creates a new instance of BoxShare
         */

        $invitation = BoxShare::create([
            'user_from_id' => $request->user()->id,
            'user_to_id' => $user->id,
            'box_id' => $box->id,
            'accepted' => false,
            'pending' => true,
        ]);

        /**
         * Puts it in the default box for the user
         */

        $defaultBox = DefaultBox::where('user_id', $user->id)->first();
        DefaultBoxContainsBoxes::create([
            'default_box_id' => $defaultBox->id,
            'box_id' => $box->id,
        ]);

        $box->shareAllContents($request->user(), $user, $canEdit);

        return redirect('/');
    }

    /**
     * Displays a view of all the users a certain
     *     box has been shared with.
     *
     * @param Request $request
     * @param Box $box
     * @return Response
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
     * @param Request $request
     * @param BoxShare $share
     * @return Response
     */
    public function destroy(Request $request, BoxShare $share)
    {
        $this->authorize('destroy', $share);

        $share->delete();

        $permission =
            BoxPermission::where('box_id', $share->box_id)
                ->where('user_id', $request->user()->id)
                ->first();

        $permission->delete();

        $defaultBox =
            DefaultBox::where('user_id', $request->user()->id)
                ->first();

        $containerEntry =
            DefaultBoxContainsBoxes::where('default_box_id', $defaultBox->id)
                ->where('box_id', $share->box_id)
                ->first();

        $containerEntry->delete();

        return redirect('home');
    }
}
