<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register the API routes for your application as
| the routes are automatically authenticated using the API guard and
| loaded automatically by this application's RouteServiceProvider.
|
*/

Route::group(['prefix' => 'api'], function () {
    Route::get('/tasks', 'API\Bookshelf@all');
    Route::post('/task', 'API\Bookshelf@store');
    Route::delete('/task/{task}', 'API\Bookshelf@destroy');

    Route::get('/activity', 'API\ActivityController@all');
});
