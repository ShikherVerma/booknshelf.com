<?php

namespace App\Http\Controllers;

use App;
use App\Repositories\BookRepository;
use App\Repositories\ShelfRepository;
use App\Repositories\UserRepository;
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
        $shelves = $this->shelves->ourPicks();
        return view('home', [
            'shelves' => $shelves->toArray(),
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
