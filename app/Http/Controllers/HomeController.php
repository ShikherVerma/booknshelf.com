<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function welcome(Request $request)
    {
        return view('welcome', ['user' => $request->user()]);
    }

    public function craftedByUs(Request $request)
    {
        return view('crafted-by-us', ['user' => $request->user()]);
    }

}
