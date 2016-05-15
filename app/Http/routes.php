<?php

use App\User;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

// Socialite auth for facebook
Route::get('auth/facebook', 'Auth\AuthController@loginFacebook');
Route::get('login_facebook', 'Auth\AuthController@loginFacebook');

// register auth routes
Route::get('register', ['as' => 'register', 'uses' => 'Auth\AuthController@getRegister']);
Route::post('register', ['as' => 'register', 'uses' => 'Auth\AuthController@postRegister']);

// shelf resource routes
Route::resource('shelf', 'ShelfController');

Route::get('register/confirm/{token}', function($token) {
	User::where('verify_token', $token)->firstOrFail()->confirmEmail();
	flash()->success('Sweet!', 'You are now confirmed. Thanks so much!');
	return redirect('/home');
});

// Settings
$router->get('/settings', 'SettingsController@show');
// Profile Contact Information...
$router->put('/settings/profile', 'SettingsController@updateProfile');
$router->post('/settings/photo', 'SettingsController@updatePhoto');
