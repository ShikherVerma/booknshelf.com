<?php

namespace App\Http\Controllers;

use App\Repositories\ShelfRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $shelves;
    protected $users;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ShelfRepository $shelves, UserRepository $users)
    {
        $this->middleware('auth', ['except' => [
            'index'
        ]]);
        $this->shelves = $shelves;
        $this->users = $users;
    }

    public function index()
    {
        $shelves = $this->shelves->ourPicks();
        $users = $this->users->ourPicks();
        return view('home', [
            'shelves' => $shelves->toArray(),
            'users' => $users->toArray()
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
