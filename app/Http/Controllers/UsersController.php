<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Post;
use App\User;
use App\Follow;

class UsersController extends Controller
{
    //


    public function search(User $user, Follow $follow, Request $request)
    {
        $follow_count = $follow->getFollowCount($user->id);
        $follower_count = $follow->getFollowerCount($user->id);

        $all_users = $user->getAllUsers(auth()->user()->id);
        $user = auth()->user();

        $follow_ids = $follow->followingIds($user->id);
        $following_ids = $follow_ids->pluck('follower')->toArray();


        $search = $request->input('username');
        if ($request->has('username') && $search != '') {
            $users = User::where('username', 'like', "%{$search}%")->where('id', '<>', $user->id)->get();
            $data = $users;
        } else {
            $users = $user->getAllUsers(auth()->user()->id);
            $data = $users;
        }
        

        return view('users.search', [
            'user'      => $user,
            'all_users'  => $all_users,
            'follow_count'   => $follow_count,
            'follower_count' => $follower_count,
            'data' => $data,
            'search' => $search,
        ]);
    }

     // フォロー
    public function follow(User $user)
    {
        $follower = auth()->user();
        // フォローしているか
        $is_following = $follower->isFollowing($user->id);
        if(!$is_following) {
             // フォローしていなければフォローする
            $follower->follow($user->id);
            return back();
        }
    }
    
     // フォロー解除
    public function unfollow(User $user)
    {
        $follower = auth()->user();
         // フォローしているか
        $is_following = $follower->isFollowing($user->id);
        if($is_following) {
            // フォローしていればフォローを解除する
            $follower->unfollow($user->id);
            return back();
        }
    }

    public function edit(User $user)
    {
        return view('users.profile', ['user' => $user]);
    }


    public function index(User $user, Follow $follow, Post $post, $id){
        $follow_count = $follow->getFollowCount($user->id);
        $follower_count = $follow->getFollowerCount($user->id);

        
        $user = auth()->user();

        $profile = DB::table('users')
            ->where('id', $id)
            ->first();

        $timelines = DB::table('posts')
            ->where('user_id', $id)
            ->get();
        
        $follow_ids = $follow->followingIds($user->id);
        $following_ids = $follow_ids->pluck('follower')->toArray();
        
        //$timelines = $post->getTimelines($user->id, $following_ids);
        
        return view('users.profile', [
            'user'      => $user,
            'timelines' => $timelines,
            'follow_count'   => $follow_count,
            'follower_count' => $follower_count,
            'profile' => $profile,
        ]);
    }
    
    public function update(Request $request) {
    
        $id = $request->input('id');
        $user_name = $request->input('userName');
        $mail = $request->input('mail');
        $password = $request->input('passWord');
        $bio = $request->input('bio');

        $request->validate(
            [
                'username' => 'required|min:4|max:12',
                'mail' => 'required|min:4|max:12|unique:users,mail,'.$id.'',
                'password' => 'nullable|numeric|digits_between:4,12|unique:users,password',
                'bio' => 'max:200',
                'image-file' => 'image',
            ],
            [
                "required" => "入力必須",
                "username.min" => "ユーザーネームは4文字以上から",
                "mail.min" => "メールアドレスは4文字以上から",
                "password.min" => "パスワードは4文字以上から",
                "username.max" => "ユーザーネームは12文字以内",
                "mail.max" => "メールアドレスは12文字以内",
                "password.max" => "パスワードは12文字以内",
                "digits_between" => "4字以上12字以内",
                "unique" => "既に存在します",
                "image" => "jpg,png,bmp,gif,svgの拡張子のみ有効です"
            ],
        );

        $image = $request->file('image-file');
        $filename = $image->getClientOriginalName();
        $request->file('image-file')->storeAs('images',$filename, 'public_uploads');

        DB::table('users')
            ->where('id', $id)
            ->update([
                'username' => $user_name,
                'mail' => $mail,
                'password' => bcrypt($password),
                'bio' => $bio,
                'images' => $filename
            ]);

        return back();
    }

}
