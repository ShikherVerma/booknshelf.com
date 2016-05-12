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

// Sociallte auth
Route::get('auth/twitter', 'Auth\AuthController@redirectToProviderTwitter');
Route::get('auth/twitter/callback', 'Auth\AuthController@handleProviderCallbackTwitter');

Route::get('auth/facebook', 'Auth\AuthController@login_facebook');
Route::get('login_facebook', 'Auth\AuthController@login_facebook');

Route::get('register', ['as' => 'register', 'uses' => 'Auth\AuthController@getRegister']);
Route::post('register', ['as' => 'register', 'uses' => 'Auth\AuthController@postRegister']);



Route::get('register/confirm/{token}', function($token) {
	User::where('verify_token', $token)->firstOrFail()->confirmEmail();
	flash()->success('Sweet!', 'You are now confirmed. Thanks so much!');
	return redirect('/home');
});
