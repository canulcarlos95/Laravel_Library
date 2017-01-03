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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::resource('libro','LibroContoller', ['only' => ['index', 'store', 'update', 'destroy','edit']]);
Route::resource('autor','AutorContoller', ['only' => ['index', 'store', 'update', 'destroy','edit']]);
Route::post('/update','AutorContoller@update');
Route::get('/redirect', 'SocialAuthController@redirect');
Route::get('/callback', 'SocialAuthController@callback');
