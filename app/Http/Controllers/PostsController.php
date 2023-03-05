<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Follow;

class PostsController extends Controller
{
    //
    public function index(User $user, Follow $follow){
        $follow_count = $follow->getFollowCount($user->id);
        $follower_count = $follow->getFollowerCount($user->id);

        return view('posts.index', [
            'follow_count'   => $follow_count,
            'follower_count' => $follower_count
        ]);
        //Follow.php(モデル)で関数を定義してコントローラーでその関数を使い変数に代入する
        //ことでビュー(index.blade.php)で変数の値を表示できる
        //LESSON6 Laravelページの表示/READの実装が参考になる
    }

    public function __construct()
    {
        $this->middleware('auth');
    }
}
