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
            'index',
            'about',
            'search'
        ]]);
        $this->shelves = $shelves;
        $this->users = $users;
        $this->books = $books;
    }

    public function index()
    {

        $topics = [];
        $shelves = $this->shelves->ourPicks();
        $books = App\Book::whereIn('asin', [
            '1501135910',
            '0143109677',
            '0060555661',
            '0066620996',
            '0062273205',
            '1599869772',
            '0393061329',
            '0743297334',
            '0345391802',
            '0553380168'

        ])->get();
        $books->load('authors', 'likes');
        return view('home', [
            'shelves' => $shelves->toArray(),
            'topics' => $topics,
            'books' => json_encode($books)
        ]);
    }

    public function about()
    {
        return view('static.about');
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
