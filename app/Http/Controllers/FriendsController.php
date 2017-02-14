<?php

namespace App\Http\Controllers;

use App\Services\FacebookService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class FriendsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(FacebookService $fbService)
    {
        $user = Auth::user();

        if (!$user->isFacebookConnected()) {
            return view('friends', [
                'isFacebookConnected' => false,
                'user' => $user,
                'friends' => [],
            ]);
        }

        // get all facebook friends of the authenticated user
        $friends = $fbService->getFriendsList($user);
        // go over each friend and get more info by facebook_user_id
        $userFriends = collect($friends)->map(function ($friend) {
            return User::where('facebook_user_id', $friend->id)->withCount('shelves')->get();
        })->collapse();

        return view('friends', [
            'isFacebookConnected' => true,
            'friends' => $userFriends,
            'user' => $user,
        ]);
    }
}
