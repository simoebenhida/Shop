<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!

*/

Route::get('/', function () {
    return view('shop.nearby');
})->middleware('auth');

Route::get('/preferred-shops',function() {
    return view('shop.preferred');
})->middleware('auth');

Route::post('/preferred-shops','ShopController@preferred');
Route::post('/shops','ShopController@index');
Route::post('/shops/{shop}/like','LikeController@like');
Route::post('/shops/{shop}/destroy','LikeController@destroy');
Route::post('/shops/{shop}/dislike','LikeController@dislike');

Auth::routes();
