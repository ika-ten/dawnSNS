<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    public function getTimeLines(Int $user_id, Array $follow_ids)
    {
        // 自身とフォローしているユーザIDを結合する
        $follow_ids[] = $user_id;
        return $this->whereIn('user_id', $follow_ids)->orderBy('created_at', 'DESC')->paginate(50);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function postStore(Int $user_id, array $data)
    {
        $this->user_id = $user_id;
        $this->posts = $data['posts'];
        $this->save();

        return;
    }

    public function getEditPost(Int $user_id, Int $post_id)
    {
        return $this->where('user_id', $user_id)->where('id', $post_id)->first();
    }

    public function edit(Post $post)
    {
        $user = auth()->user();
        $posts = $post->getEditPost($user->id, $post->id);

        if (!isset($posts)) {
            return redirect('posts');
        }

        return view('posts.index', [
            'user'   => $user,
            'posts' => $posts
        ]);
    }

}
