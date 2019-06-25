<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function microposts()
    {
        return $this->hasMany(Micropost::class);
    }
    
    public function followings()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'user_id', 'follow_id')->withTimestamps();
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'follow_id', 'user_id')->withTimestamps();
    }

    public function follow($userId)
    {
        // 既にフォローしているかの確認
        $exist = $this->is_following($userId);
        // 相手が自分自身ではないかの確認
        $its_me = $this->id == $userId;
    
        if ($exist || $its_me) {
            // 既にフォローしていれば何もしない
            return false;
        } else {
            // 未フォローであればフォローする
            $this->followings()->attach($userId);
            return true;
        }
    }
    
    public function unfollow($userId)
    {
        // 既にフォローしているかの確認
        $exist = $this->is_following($userId);
        // 相手が自分自身ではないかの確認
        $its_me = $this->id == $userId;
    
        if ($exist && !$its_me) {
            // 既にフォローしていればフォローを外す
            $this->followings()->detach($userId);
            return true;
        } else {
            // 未フォローであれば何もしない
            return false;
        }
    }
    
    public function is_following($userId)
    {
        return $this->followings()->where('follow_id', $userId)->exists();
    }
    
    public function feed_microposts()
    {
        $follow_user_ids = $this->followings()->pluck('users.id')->toArray();
        $follow_user_ids[] = $this->id;
        return Micropost::whereIn('user_id', $follow_user_ids);
    }  
    
    
    
    //課題
     public function favorites()
    {
        return $this->belongsToMany(Micropost::class, 'favorites', 'user_id', 'micropost_id')->withTimestamps();
        //ここの'favorites' が中間テーブル
    } 
 
 
 
    public function is_favoring($micropost_id){
                                                            //return true;
                                                            //とりあえずtrueを返しておく
                                                            //下の favorites() はテーブルではなく、メソッド public function favorites()?。
                                                            //ここでuser-id, micropost_id で指定して返す。順番は関係あるのか？　ここのfavorites.user-id というのは確かﾃｰﾌﾞﾙfavoritesのuser_idカラムだろう
        
    //echo($micropost_id);
        
    //return $this->favorites()->where('favorites.user_id', $micropost_id)->exists();
                                                            //echo($this->favorites()->where('favorites.user_id', $micropost_id)->exists());
                                                            //dd($this->favorites()->where('favorites.user_id', $micropost_id)->exists());
                                                            //echo"表示されなきゃおかしい";
                                                            //ここのコードの意味が理解できてなかったが比較しているとのことらしい。
    return $this->favorites()->where('favorites.micropost_id', $micropost_id)->exists();                                                        
    }   



    
    public function favorite($micropost_id){
                                                            //とりあえず、echoで確認
                                                            //console.log("お気に入り登録したよ！"); console使えないらしい
                                                            //echo "お気に入り登録したよ！";
        // 既にfavoriteしているかの確認
        $exist = $this->is_favoring($micropost_id);
                                                            // 相手が自分自身ではないかの確認 ←　いらない
                                                            //$its_me = $this->id == $userId;
                                    
                                                            //if ($exist || $its_me) {
        if ($exist) {            
            // 既にお気に入り登録していれば
            return true;
        } else {
            // 未登録お気に入りであればお気に入りにする
            $this->favorites()->attach($micropost_id);      //"この"favorite関数ｲﾝｽﾀﾝｽ(上）に変数$micropost_id をfavoriteテーブルにアタッチする
                                                            //この、なので、user_id は今ﾛｸﾞｲﾝしているユーザーになっている、という感じ？
            
            return false;
        }        
    }

    public function unfavorite($micropost_id){
                                                            //とりあえず、echoで確認
                                                            //console.log("お気に入り登録からけしちゃったよ！");
                                                            //echo "お気に入り登録からけしちゃったよ！";
        // 既にお気に入り登録しているかの確認
        $exist = $this->is_favoring($micropost_id);
                                                            // 相手が自分自身ではないかの確認
                                                            //$its_me = $this->id == $userId;
                                                            //if ($exist && !$its_me) {
        if ($exist) {            
            // 既にフォローしていればフォローを外す
            $this->favorites()->detach($micropost_id);
            return false;
        } else {
            // 未フォローであれば何もしない
            return true;
        }        
    }    
    
         
   /* 間違えた
    public function deletefavorite($micropostId){
        //とりあえず何もしない
    }
    
    public function addfavorite($micropostId){
        //とりあえず何もしない
    }

    */
    
/*    
    public function addfavorite($micropostId)       //この$micropostIdは次のTINKERで$変数->id などとして指定するハズ、教材参照
    {
        // 既にお気に入り登録しているかの確認
        $exist = $this->is_favoring($micropostId);
        // 相手が自分自身のmicropostではないかの確認
        $its_mine = $this->id == $micropostId;      //この書き方は以前質問してるはず。なんだっけ？調べること！
        //もし、このid ($this->id) が $micropostId と等しければ、それをtrueとして変数$its_mine にいれよ
        //いや、これではだめだな！
        //もし、このid ($this->id) が このuser のもつ　$micropostId と等しければ、それを変数$its_mine にいれよ
        //何か変だ、$this をわかってないな、このthis は何を示している？
        //これは外部から$user->addfavorite とするためのもので、$this は$user つまりUser
        //のインスタンスを表し、そのユーザーのIDとなる
        
 
    //これ、別のユーザーのところでだけ、お気に入りを表示させればいいのでは？
 
 
 
 
 
 
 
 
 
 
 
 
    
        if ($exist || $its_me) {
            // 既にフォローしていれば何もしない
            return false;
        } else {
            // 未フォローであればフォローする
            $this->followings()->attach($userId);
            return true;
        }
    }
    
    public function unfollow($userId)
    {
        // 既にフォローしているかの確認
        $exist = $this->is_following($userId);
        // 相手が自分自身ではないかの確認
        $its_me = $this->id == $userId;
    
        if ($exist && !$its_me) {
            // 既にフォローしていればフォローを外す
            $this->followings()->detach($userId);
            return true;
        } else {
            // 未フォローであれば何もしない
            return false;
        }
    }
    
    public function is_following($userId)
    {
        return $this->followings()->where('follow_id', $userId)->exists();
    }


  */  
    
    
}