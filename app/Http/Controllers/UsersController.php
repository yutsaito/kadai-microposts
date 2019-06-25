<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User; 

class UsersController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(10);

        return view('users.index', [
            'users' => $users,
        ]);
    }
    
    public function show($id)
    {
        $user = User::find($id);
        $microposts = $user->microposts()->orderBy('created_at', 'desc')->paginate(10);

        $data = [
            'user' => $user,
            'microposts' => $microposts,
        ];

        $data += $this->counts($user);

        return view('users.show', $data);
    }
    
    public function followings($id)
    {
        $user = User::find($id);
        $followings = $user->followings()->paginate(10);

        $data = [
            'user' => $user,
            'users' => $followings,
        ];

        $data += $this->counts($user);

        return view('users.followings', $data);
    }

    public function followers($id)
    {
        $user = User::find($id);
        $followers = $user->followers()->paginate(10);

        $data = [
            'user' => $user,
            'users' => $followers,
        ];

        $data += $this->counts($user);

        return view('users.followers', $data);
    }
    
    //これはnavtabs.blade,php から、Route::post('favorite', 'FavoritesController@store')->name('favorites.favorite'); で
    //FavoritesController@store
    public function favorites($id){

        $user = User::find($id);
                //$favorites = $user->favorites()->paginate(10);
        $microposts = $user->favorites()->paginate(10);
        $data = [
            'user' => $user,
                    //'favorites' => $favorites,
            'microposts' => $microposts,
        ]; 
        
        $data += $this->counts($user);  //thisがfavorite()このメソッド
        
                //echo($user);
                //dd($user);
                //echo($microposts);
                //dd($microposts);
                //dd($microposts->toArray());  //配列はこっちで確認する、ということらしい
                //echo は文字列や数値などの単一データしか出力できないので、dd()を使うと良いですよ。
        
        return view('users.favorites', $data);
    }
}
