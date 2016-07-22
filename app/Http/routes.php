<?php

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

$router->get('/', 'HomeController@index');

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

$router->get('/crafted-by-us', 'PageController@craftedByus');

// onboarding welcome page
Route::get('/welcome', 'HomeController@welcome');
// Settings
$router->get('/settings', 'SettingsController@show');
// Profile Contact Information...
$router->put('/settings/profile', 'SettingsController@updateProfile');
$router->post('/settings/photo', 'SettingsController@updatePhoto');

// User
$router->get('/@{username}', 'UserController@profile');
$router->get('/users/{user_id}/shelves', 'UserController@allShelves');
$router->get('/@{username}/bookshelves', 'UserController@profile');
$router->get('/@{username}/shelves/{shelf_slug}', 'UserController@shelf');
$router->post('/user/welcome', 'UserController@welcome');
$router->get('/user/current', 'UserController@current');
$router->get('/user/shelves', 'UserController@shelves');

// Book Search
$router->get('/books/search', 'BookController@search');

// Shelves
$router->post('/shelves', 'ShelfController@store');
$router->get('/shelves/{shelf_id}', 'ShelfController@show');
$router->put('/shelves/{shelf_id}', 'ShelfController@update');
$router->delete('/shelves/{shelf_id}', 'ShelfController@destroy');
$router->get('/shelves/{shelf_id}/books', 'ShelfController@getBooks');
$router->post('/shelves/{shelf_id}/books', 'ShelfController@storeBook');
$router->delete('/shelves/{shelf_id}/books', 'ShelfController@removeBook');
