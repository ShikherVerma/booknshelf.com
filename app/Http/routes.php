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

// TODO: We should have one for guest and one landing page for
// auth users
$router->get('/', function() {
    return view('landing');
});

Route::auth();
// Socialite auth for facebook
Route::get('auth/facebook', 'Auth\AuthController@loginFacebook');
Route::get('login_facebook', 'Auth\AuthController@loginFacebook');
// Socialite auth for twitter
Route::get('auth/twitter', 'Auth\AuthController@loginTwitter');
Route::get('login_twitter', 'Auth\AuthController@loginTwitter');
// register auth routes
Route::get('register', ['as' => 'register', 'uses' => 'Auth\AuthController@getRegister']);
Route::post('register', ['as' => 'register', 'uses' => 'Auth\AuthController@postRegister']);

$router->get('/crafted-by-us', 'StaticPageController@craftedByus');

// onboarding welcome page
Route::get('/welcome', 'HomeController@welcome');
// Settings
$router->get('/settings', 'SettingsController@show');
// Profile Contact Information...
$router->put('/settings/profile', 'SettingsController@updateProfile');
$router->post('/settings/photo', 'SettingsController@updatePhoto');

// User
$router->get('/{username}', 'UserController@profile');
$router->get('/{username}/bookshelves', 'UserController@profile');
$router->post('/user/welcome', 'UserController@welcome');
$router->get('/user/current', 'UserController@current');
$router->get('/user/shelves', 'UserController@shelves');

// Books Search
$router->get('/books/search', 'BookController@search');


// Books
// $router->get('/book/autocomplete', 'BookController@index');
$router->get('/book/{service_id}', 'BookController@show');

// Shelves
$router->post('/shelves', 'ShelfController@store');
$router->get('/shelves/{shelf_id}', 'ShelfController@show');
$router->put('/shelves/{shelf_id}', 'ShelfController@update');
$router->delete('/shelves/{shelf_id}', 'ShelfController@destroy');
$router->post('/shelves/{shelf_id}/books', 'ShelfController@storeBookToShelf');
$router->delete('/shelves/{shelf_id}/books', 'ShelfController@removeBookFromShelf');

// get a specific book in the collection // TEMP
$router->get('/shelves/{shelf_id}/books/{book_id}', 'ShelfController@storeBookToShelf');
// get all the books in the collection // TEMP
$router->get('/shelves/{shelf_id}/books', 'ShelfController@storeBookToShelf');

