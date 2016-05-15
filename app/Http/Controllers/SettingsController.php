<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        return view('settings');
    }

    public function updateContact()
    {
        return true;
    }

    public function updatePhoto()
    {
        return true;
    }

    public function updatePassword()
    {
        return true;
    }
}
