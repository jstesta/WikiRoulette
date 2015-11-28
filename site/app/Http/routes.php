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

// The default (index) page route
Route::get('/', 'WikiRouletteController@index');

// The detail view page route
Route::get('/detail/{id}', 'WikiRouletteController@detail');
