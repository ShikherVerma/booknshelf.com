<?php

namespace App\Http\Controllers;

use App\Events\UserRegistered;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\ShelfRepository;
use App\Repositories\UserRepository;
use Event;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $users;
    private $shelves;

    public function __construct(UserRepository $users, ShelfRepository $shelves)
    {
        $this->middleware('auth', ['except' => [
            'profile',
            'allShelves',
            'shelf'
        ]]);

        $this->users = $users;
        $this->shelves = $shelves;
    }

    public function profile($username)
    {
        $user = $this->users->findByUsername($username);
        $shelves = $this->shelves->forUser($user);
        $likes = $this->users->likes($username);

        return view('profile', [
            'user' => $user,
            'shelves' => $shelves,
            'likes' => $likes
        ]);
    }

    public function allShelves($userId)
    {
        $user = $this->users->findById($userId);
        return response()->json($this->shelves->forUser($user)->toArray());
    }

    public function shelf($username, $slug)
    {
        $user = $this->users->findByUsername($username);
        $shelf = $this->shelves->findBySlug($user, $slug);

        $books = $this->shelves->books($shelf);

        return view('shelf', [
            'user' => $user,
            'shelf' => $shelf,
            'books' => json_encode($books),
        ]);
    }

    public function current()
    {
        return $this->users->current();
    }

    public function shelves()
    {
        $user = $this->users->current();
        return response()->json($this->shelves->forUser($user)->toArray());
    }

    public function welcome(UpdateUserRequest $request)
    {
        $this->validate($request, [
            'about' => 'max:255',
        ]);

        $user = $request->user();
        $user->update([
            'username' => $request->username,
            'about' => $request->about,
            'is_onboarded' => true,
        ]);

        Event::fire(new UserRegistered($user));

        return redirect('/');
    }

    public function disconnectFacebook(Request $request)
    {
        $user = $request->user();
        $user->facebook_user_id = null;
        $user->fb_token = null;
        $user->save();

        return back();
    }
}
