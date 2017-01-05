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
Route::get('/callback', 'SocialAuthController@callback');
Route::group(['prefix'=>'api'], function(){
  Route::group(['prefix'=>'v1'], function(){
    Route::group(['middleware' => 'auth'], function () {
      Route::resource('libro','LibroContoller', ['only' => ['index']]);
      Route::resource('autor','AutorContoller', ['only' => ['index']]);
      Route::get('/author','AutorContoller@index')->name('author.index');
      Route::get('/book','LibroContoller@index')->name('book.index');
    });
    Route::get('/redirect', 'SocialAuthController@redirect');
  });
});
