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
    return view('landing');
});

Route::auth();

Route::get('/home', 'HomeController@index');
// onboarding welcome page
Route::get('/welcome', 'HomeController@welcome');

// Socialite auth for facebook
Route::get('auth/facebook', 'Auth\AuthController@loginFacebook');
Route::get('login_facebook', 'Auth\AuthController@loginFacebook');
// Socialite auth for twitter
Route::get('auth/twitter', 'Auth\AuthController@loginTwitter');
Route::get('login_twitter', 'Auth\AuthController@loginTwitter');
// register auth routes
Route::get('register', ['as' => 'register', 'uses' => 'Auth\AuthController@getRegister']);
Route::post('register', ['as' => 'register', 'uses' => 'Auth\AuthController@postRegister']);

// Settings
$router->get('/settings', 'SettingsController@show');
// Profile Contact Information...
$router->put('/settings/profile', 'SettingsController@updateProfile');
$router->post('/settings/photo', 'SettingsController@updatePhoto');
// User
$router->post('/user/welcome', 'UserController@welcome');
//
$router->get('/user/current', 'UserController@current');
$router->get('/user/shelves', 'UserController@shelves');

// Books Search
$router->get('/books/search', 'BookController@search');

// Profile
// TODO: We have to verify that username exists otherwise redirect to /home
$router->get('/{username}/shelves/{shelf_id}', 'ShelfController@show');
$router->get('/{username}', 'UserController@profile');

// Books
// $router->get('/book/autocomplete', 'BookController@index');
$router->get('/book/{service_id}', 'BookController@show');

// Shelves
$router->post('/shelf/store', 'ShelfController@store');
$router->put('/shelf/{shelf_id}', 'ShelfController@update');
$router->delete('/shelf/{shelf_id}', 'ShelfController@destroy');

// add the given book to the given shelf
$router->post('/shelves/{shelf_id}/books/{book_id}/store', 'ShelfController@storeBookToShelf');
// get a specific book in the collection
$router->get('/shelves/{shelf_id}/books/{book_id}', 'ShelfController@storeBookToShelf');
// get all the books in the collection
$router->get('/shelves/{shelf_id}/books', 'ShelfController@storeBookToShelf');
