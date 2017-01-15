<?php

namespace App\Http\Controllers;

use App;
use App\Repositories\BookRepository;
use App\Repositories\ShelfRepository;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $shelves;
    protected $users;
    protected $books;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ShelfRepository $shelves, UserRepository $users, BookRepository $books)
    {
        $this->middleware('auth', ['except' => [
            'index'
        ]]);
        $this->shelves = $shelves;
        $this->users = $users;
        $this->books = $books;
    }

    public function index()
    {

        $user = User::where('username', 'topic')->firstOrFail();

        if (is_null($user)) {
            $topics = [];
        } else {
            $topics = $this->shelves->forUser($user)->toArray();
        }

        return view('home', [
            'topics' => $topics,
        ]);
    }

    public function welcome(Request $request)
    {
        return view('welcome', ['user' => $request->user()]);
    }

    public function landing()
    {
        return view('landing');
    }
}
