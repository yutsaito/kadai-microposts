<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'MicropostsController@index');

    //中間ﾃﾞｰﾀﾍﾞｰｽ登録の確認お試しのためのﾙｰﾄ、ここなら動くはず
    Route::get('/test/','FavoritesController@test');

// ユーザ登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

// ログイン認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

// ユーザ機能
//Laravel におけるミドルウェアは Controller にアクセスする前に事前に確認される条件 
Route::group(['middleware' => ['auth']], function () {
    Route::resource('users', 'UsersController', ['only' => ['index', 'show']]);
    
    Route::group(['prefix' => 'users/{id}'], function () {
        Route::post('follow', 'UserFollowController@store')->name('user.follow');
        Route::delete('unfollow', 'UserFollowController@destroy')->name('user.unfollow');
        Route::get('followings', 'UsersController@followings')->name('users.followings');
        Route::get('followers', 'UsersController@followers')->name('users.followers');
        Route::get('favorites', 'UsersController@favorites')->name('users.favorites');    // 追加　←　ここずっと見落としてて、どうやってViewに表示させるかわからなかった、ようやく気付いた、ひどいなぁ20190620
    });    
    
    // 追加（課題、教材をコピペ）　favorite, unfavorite というルートの作成、
    //このルートの名前はfavorites.favorite と　favorites.unfavorite　とする。
    //他に、FavoritesControllerに store() と destroy() を作る必要がある。
    Route::group(['prefix' => 'microposts/{id}'], function () {
        
        Route::post('favorite', 'FavoritesController@store')->name('favorites.favorite');
        Route::delete('unfavorite', 'FavoritesController@destroy')->name('favorites.unfavorite');
        
        //Route::post('favorite',function(){echo "Hello Laravel";})->name('favorites.favorite');
        //Route::post('unfavorite',function(){echo "Hi Laravel";})->name('favorites.unfavorite');
    });    
    
    Route::resource('microposts', 'MicropostsController', ['only' => ['store', 'destroy']]);

    //中間ﾃﾞｰﾀﾍﾞｰｽ登録の確認お試しのためのﾙｰﾄ →　この位置だとAuthがきいてて表示Login画面にリダイレクトされてしまう。
    //Route::get('/test/','FavoritesController@test');
   
    
//課題　お気に入り機能  
/*    Route::group(['prefix' => 'microposts/{id}'], function () {
        Route::post('    ', 'MicropostsController@store')->name('user.follow');
        Route::delete('unfavorite', 'MicropostsController@destroy')->name('user.unfollow');
        Route::get('    ', 'MicropostsController@      ')->name('users.followings');
        Route::get('    ', 'MicropostsController@      ')->name('users.followers');
    });
    
 */
 
}); 
 


 
