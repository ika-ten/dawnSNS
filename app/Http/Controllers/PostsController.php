<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\User;
use App\Follow;

class PostsController extends Controller
{
    //
    public function index(User $user, Follow $follow, Post $post, Request $request){
        $follow_count = $follow->getFollowCount($user->id);
        $follower_count = $follow->getFollowerCount($user->id);

        
        $user = auth()->user();
        
        $follow_ids = $follow->followingIds($user->id);
        $following_ids = $follow_ids->pluck('follower')->toArray();
        
        $timelines = $post->getTimelines($user->id, $following_ids);

        if($request->filled('upPost')){
            $post_id = $request->input('id');
            $user_editPost = $request->input('upPost');


            Post::where('id',$post_id)->update(['posts' => $user_editPost]);

            return redirect('/top');
        }

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

    public function updateForm()
    {
        $post = DB::table('posts')
            ->where('id', 1)
            ->first();
        return view('posts.updateForm', [
                    'post' => $post
                ]);
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $up_post = $request->input('upPost');
        DB::table('posts')
            ->where('id', $id)
            ->update(
                ['posts' => $up_post]
            );

        return redirect('posts');
    }

    public function delete($id)
    {
        DB::table('posts')
            ->where('id', $id)
            ->delete();

        return redirect('posts');
    }

    public function test()
    {
        $user = auth()->user();
        $id = $user->id;

        $timelines = DB::table('posts')
                        ->where('user_id', $id)
                        ->get();

        return view('test',
            [
                'user' => $user,
                'id'  => $id,
                'timelines' => $timelines
            ]
            );
    }
}
