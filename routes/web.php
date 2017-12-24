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
//use MongoDB\Client as Mongo;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
//    $like = new App\Like;
//    $like->user_id = Auth::user()->id;
//    $like->shop_id = App\Shop::first()->id;
//    $like->save();
//    return App\Like::find('5a401921c6e47b28d63f80a3')->shops;

//    return App\Shop::find('5a0c6711fb3aac66aafe26c4')->isLiked();
//    return App\Shop::all()->toArray();
    return view('shop.nearby',[
        'shops' => \App\Shop::all()
    ]);
});
Route::get('/preferred-shops','ShopController@preferred');
Route::post('/shops','ShopController@index');
Route::post('/shops/{shop}/like','LikeController@store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
