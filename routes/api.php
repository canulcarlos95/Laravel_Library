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
    Route::post('/author/add','AutorContoller@store')->name('author.add');
    Route::post('/book/add','LibroContoller@store')->name('book.add');
    Route::put('/author/update','AutorContoller@update')->name('author.update');
    Route::put('/book/update','LibroContoller@update')->name('book.update');
    Route::put('/editorial/update','EditorialContoller@update')->name('editorial.update');
    Route::delete('/author/delete/{autor}','AutorContoller@destroy')->name('author.delete');
    Route::delete('/book/delete/{libro}','LibroContoller@destroy')->name('book.delete');
});
