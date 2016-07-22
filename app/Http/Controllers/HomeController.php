<?php

namespace App\Http\Controllers;

use App\Repositories\ShelfRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ShelfRepository $)
    {
        $this->middleware('auth', ['except' => [
            'index'
        ]]);
    }

    public function index()
    {
        return view('home');
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
