<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::group(['prefix'=>'v1'], function(){
  Route::resource('book','LibroContoller', ['only' => ['create','update','destroy']]);
  Route::resource('author','AutorContoller', ['only' => ['create','update','destroy']]);
  Route::resource('editorial','EditorialController', ['only' => ['update']]);
});
