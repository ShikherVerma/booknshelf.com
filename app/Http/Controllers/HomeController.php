<?php

namespace App\Http\Controllers;

use App\Repositories\ShelfRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $shelves;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ShelfRepository $shelves)
    {
        $this->middleware('auth', ['except' => [
            'index'
        ]]);
        $this->shelves = $shelves;
    }

    public function index()
    {
        $shelves = $this->shelves->ourPicks();
        return view('home', ['shelves' => $shelves->toArray()]);
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
