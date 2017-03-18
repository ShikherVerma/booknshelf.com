<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::auth();


Route::get('/', 'HomeController@index');

// Socialite auth for facebook
Route::get('auth/facebook', 'Auth\LoginController@loginFacebook');
Route::get('login_facebook', 'Auth\LoginController@loginFacebook');

// Socialite auth for twitter
Route::get('auth/twitter', 'Auth\LoginController@loginTwitter');
Route::get('login_twitter', 'Auth\LoginController@loginTwitter');

// onboarding welcome page and static pages
Route::get('/welcome', 'HomeController@welcome');
Route::get('/faq', 'HomeController@faq');
Route::get('/story', 'HomeController@story');

// Settings
Route::get('/settings', 'SettingsController@show');

// Profile Contact Information...
Route::put('/settings/profile', 'SettingsController@updateProfile');
Route::post('/settings/photo', 'SettingsController@updatePhoto');

// User
Route::get('/@{username}', ['as' => 'profile_path', 'uses' => 'UserController@profile']);
Route::get('/users/{user_id}/shelves', 'UserController@allShelves');
Route::get('/@{username}/bookshelves', ['as' => 'bookshelves_path', 'uses' => 'UserController@profile']);
Route::get('/@{username}/shelves/{shelf_slug}', ['as' => 'shelf_path', 'uses' => 'UserController@shelf']);
Route::post('/user/welcome', 'UserController@welcome');
Route::get('/user/current', 'UserController@current');
Route::get('/user/current/likes/books', 'UserController@likedBooks');
Route::get('/user/current/saves/books', 'UserController@savedBooks');
Route::get('/user/current/topics', 'UserController@followedTopics');
Route::get('/user/current/followedUsers', 'UserController@followedUsers');

Route::get('/user/shelves', 'UserController@shelves');
Route::get('/disconnect/facebook', 'UserController@disconnectFacebook');

// Search
Route::get('/books/search', 'BookController@search');

// Shelves
Route::post('/shelves', 'ShelfController@store');
Route::get('/shelves/{shelf_id}', 'ShelfController@show');
Route::put('/shelves/{shelf_id}', 'ShelfController@update');
Route::delete('/shelves/{shelf_id}', 'ShelfController@destroy');
Route::get('/shelves/{shelf_id}/books', 'ShelfController@getBooks');
Route::post('/shelves/{shelf_id}/books', 'ShelfController@storeBook');
Route::delete('/shelves/{shelf_id}/books/{book_id}', 'ShelfController@removeBook');

// Topics
Route::get('/topics', 'TopicController@all');
Route::get('/topics/{topic_slug}', 'TopicController@show');
Route::post('/topics/follow', 'TopicController@follow');
Route::post('/topics/unfollow', 'TopicController@unfollow');

// Likes
Route::post('/likes/books/{book_id}/toggle', 'LikeController@toggle');

// Friends
Route::get('/friends', 'FriendsController@index');

// Books
Route::get('/books/{book_id}/likes', 'BookController@likes');
Route::get('/books/{book_id}/reviews', 'BookController@reviews');

// User Follows
Route::post('follows', [
    'as' => 'follows_path',
    'uses' => 'FollowsController@store'
]);

Route::delete('follows/{id}', [
    'as' => 'unfollows_path',
    'uses' => 'FollowsController@destroy'
]);
