<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FavoritesController extends Controller
{
    //favoriteのpostで呼ばれるstoreｱｸｼｮﾝ
    //public function store(Request $request, $micropost_id)
    public function store(Request $request, $micropost_id)
    {
       // echo "Hello Laravel";
        \Auth::user()->favorite($micropost_id);
        
        return back();
    }
    
    //favoriteのdeleteで呼ばれるsdeleteｱｸｼｮﾝ
    //public function destroy($micropost_id)
    public function destroy($micropost_id)
    {
        //echo "Hi Laravel";
        \Auth::user()->unfavorite($micropost_id);
        
        return back();
    }  
    
    //中間ﾃﾞｰﾀﾍﾞｰｽ登録確認お試しﾒｿｯﾄﾞ
    public function test(){
        $favorites=DB::select('SELECT * FROM favorites');
        //var_dump($favorites);
        dd($favorites);
    }
}
