<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use DB;

class FollowsController extends Controller
{

    private $userRepo = null;

    public function __construct(UserRepository $userRepo)
    {
        $this->middleware('auth');
        $this->userRepo = $userRepo;
    }

    /**
     * Follow a user.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:users,id',
        ]);

        $count = DB::table('follows')->where([
            'follower_id' => $request->user()->id,
            'followed_id' => $request->id,
        ])->count();

        if ($count > 0) {
            return response()->json(['You already follow this user.'], 400);
        }

        return $this->userRepo->follow($request->id, $request->user());
    }

    /**
     * Unfollow a user.
    */
    public function destroy(Request $request, $id)
    {
        return $this->userRepo->unfollow($id, $request->user());
    }
}
