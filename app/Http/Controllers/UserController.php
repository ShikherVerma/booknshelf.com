<?php

namespace App\Http\Controllers;

use Event;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Events\UserRegistered;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepository;
use App\Repositories\ShelfRepository;

class UserController extends Controller
{
    private $users;
    private $shelves;

    public function __construct(UserRepository $users, ShelfRepository $shelves)
    {
        $this->middleware('auth');
        $this->users = $users;
        $this->shelves = $shelves;
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

    public function shelf($username, $shelfSlug) {
        $user = $this->users->current();
        $shelf = $user->shelves()->where('slug', $shelfSlug)->firstOrFail();
        $books = [];
        foreach ($shelf->books()->get() as $book) {
            $book->categories = $book->categories()->get();
            $book->authors = $book->authors()->get();
            $books[] = $book;
        }
        // dd($books);
        return view('shelf', [
            'user' => $user,
            'shelf' => $shelf,
            'books' => json_encode($books),
        ]);
    }

    public function profile()
    {
        $user = $this->users->current();
        return view('profile', [
            'user' => $user,
            'shelves' => $this->shelves->forUser($user),
        ]);
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
}
