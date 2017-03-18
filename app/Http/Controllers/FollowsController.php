<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;

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
