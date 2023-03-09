<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Post;
use App\User;
use App\Follow;

class PostsController extends Controller
{
    //
    public function index(User $user, Follow $follow, Post $post){
        $follow_count = $follow->getFollowCount($user->id);
        $follower_count = $follow->getFollowerCount($user->id);

        
        $user = auth()->user();
        
        $follow_ids = $follow->followingIds($user->id);
        $following_ids = $follow_ids->pluck('follower')->toArray();
        
        $timelines = $post->getTimelines($user->id, $following_ids);

        return view('posts.index', [
            'user'      => $user,
            'timelines' => $timelines,
            'follow_count'   => $follow_count,
            'follower_count' => $follower_count
        ]);
        //Follow.php(モデル)で関数を定義してコントローラーでその関数を使い変数に代入する
        //ことでビュー(index.blade.php)で変数の値を表示できる
        //LESSON6 Laravelページの表示/READの実装が参考になる
    }


    public function store(Request $request, Post $post)
    {
        $user = auth()->user();
        $data = $request->all();
        $validator = Validator::make($data, [
            'posts' => ['required', 'string', 'max:140']
        ]);

        $validator->validate();
        $post->postStore($user->id, $data);

        return redirect('posts');
    }
    //参考：https://qiita.com/namizatork/items/c9ed67f98fc3e5ce67c7

    public function __construct()
    {
        $this->middleware('auth');
    }
}
