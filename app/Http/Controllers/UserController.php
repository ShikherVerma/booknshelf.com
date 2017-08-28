<?php

namespace App\Http\Controllers;

use App\Events\UserRegistered;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\ShelfRepository;
use App\Repositories\UserRepository;
use Event;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class UserController extends Controller
{
    private $users;
    private $shelves;

    public function __construct(UserRepository $users, ShelfRepository $shelves)
    {
        $this->middleware('auth', [
            'except' => [
                'profile',
                'notes',
                'allShelves',
                'allFollowers',
                'allFollowed',
                'shelf',
            ],
        ]);

        $this->users = $users;
        $this->shelves = $shelves;
    }

    public function profile($username)
    {
        $user = $this->users->findByUsername($username);
        $shelves = $this->shelves->forUser($user);
        $likedBooks = $this->users->getAllLikedBooks($username);
        $topics = $this->users->getAllTopics($username);

        return view('profile', [
            'user' => $user,
            'shelves' => $shelves,
            'likedBooks' => $likedBooks,
            'topics' => $topics,
            // page properties
            'title' => $user->name . "'s profile on Booknshelf",
            'description' => "See all the books that " . $user->name . " has read and liked.",
            'ogImage' => $user->avatar
        ]);
    }

    public function notes($username)
    {
        $user = $this->users->findByUsername($username);
        $notes = $user->notes()->with('book')->where('is_private', false)->get();

        // if current auth user is the one requesting the notes
        // then show all notes including private notes
        if (Auth::check() && auth()->user()->id == $user->id) {
            $notes = $user->notes()->with('book')->get();
            // dd($notes);
        } else {
            // return only public notes
            $notes = $user->notes()->with('book')->where('is_private', false)->get();
        }
        $notes = $notes->groupBy("book_id");

        return view('notes', [
            'user' => $user,
            'notes' => $notes->toArray(),
            // page properties
            'title' => $user->name . "'s notes on Booknshelf",
            'description' => "See all the book notes that " . $user->name . " has created.",
            'ogImage' => $user->avatar
        ]);
    }

    public function allShelves($userId)
    {
        $user = $this->users->findById($userId);

        return response()->json($this->shelves->forUser($user)->toArray());
    }

    public function allFollowers($userId)
    {
        $user = $this->users->findById($userId);

        return response()->json($user->followers()->withCount('followers')->get()->toArray());
    }

    public function allFollowed($userId)
    {
        $user = $this->users->findById($userId);

        return response()->json($user->followedUsers()->withCount('followers')->get()->toArray());
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
            // page properties
            'title' => $shelf->name,
            'description' => $shelf->description,
            'ogImage' => $shelf->cover
        ]);
    }

    public function current()
    {
        return $this->users->current();
    }

    public function likedBooks()
    {
        $user = User::find(Auth::id());
        $allLikedBooks = $user->allLikedBooks();
        $books = $allLikedBooks->map(function ($book) {
            return $book->id;
        });

        return $books;
    }

    public function savedBooks()
    {
        $user = User::find(Auth::id());
        $allSavedBooks = $user->allSavedBooks();
        $books = $allSavedBooks->map(function ($book) {
            return $book->id;
        });

        return $books;
    }

    public function followedTopics()
    {
        $user = User::find(Auth::id());
        $topics = $user->topics()->get();
        $result = $topics->map(function ($book) {
            return $book->id;
        });

        return $result;
    }

    public function followedUsers()
    {
        $user = User::find(Auth::id());
        $users = $user->followedUsers()->get();
        $result = $users->map(function ($user) {
            return $user->id;
        });

        return $result;
    }

    public function followerUsers()
    {
        $user = User::find(Auth::id());
        $users = $user->followers()->get();
        $result = $users->map(function ($user) {
            return $user->id;
        });

        return $result;
    }

    public function shelves()
    {
        $user = $this->users->current();

        return response()->json($this->shelves->forUser($user)->toArray());
    }

    public function followers()
    {
        $user = $this->users->current();

        return response()->json($this->shelves->forUser($user)->toArray());
    }

    public function welcome(UpdateUserRequest $request)
    {
        $this->validate($request, [
//            'email' => 'required|unique:users,email',
            'about' => 'max:255',
        ]);

        $user = $request->user();
        $user->update([
            'username' => $request->username,
            'about' => $request->about,
//            'email' => $request->email,
            'is_onboarded' => true,
        ]);

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
