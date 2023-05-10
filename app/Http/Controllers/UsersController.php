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

       
        $old_password = DB::table('users')
            ->where('id', $id)
            ->value('password_base');

        $old_image = DB::table('users')
            ->where('id', $id)
            ->value('images');

        $follow_ids = $follow->followingIds($user->id);
        $following_ids = $follow_ids->pluck('follower')->toArray();
        
        //$timelines = $post->getTimelines($user->id, $following_ids);
        
        return view('users.profile', [
            'user'      => $user,
            'timelines' => $timelines,
            'follow_count'   => $follow_count,
            'follower_count' => $follower_count,
            'profile' => $profile,
            'old_password' => $old_password,
            'old_image' => $old_image
        ]);
    }
    
    public function update(Request $request) {
    
        $id = $request->input('id');
        $user_name = $request->input('userName');
        $mail = $request->input('mail');
        $bio = $request->input('bio');

        $old_password = DB::table('users')
            ->where('id', $id)
            ->value('password_base');

        $old_image = DB::table('users')
            ->where('id', $id)
            ->value('images');



        if($request->input('passWord')) {
            $password = $request->input('passWord');
        } else {
            $password = $old_password;
        };

        $request->validate(
            [
                'userName' => 'required|min:4|max:12',
                'mail' => 'required|min:4|unique:users,mail,'.$id.'',
                'passWord' => 'nullable|min:4',
                'bio' => 'max:200',
                'image-file' => 'image',
            ],
            [
                "userName.required" => "ユーザーネームは入力必須",
                "mail.required" => "メールアドレスは入力必須",
                "userName.min" => "ユーザーネームは4文字以上から",
                "mail.min" => "メールアドレスは4文字以上から",
                "passWord.min" => "パスワードは4文字以上から",
                "userName.max" => "ユーザーネームは12文字以内",
                "unique" => "既に存在します",
                "image" => "jpg,png,bmp,gif,svgの拡張子のみ有効です"
            ],
        );

        if($request->file('image-file') != null){
            $image = $request->file('image-file');
            $filename = $image->getClientOriginalName();
            $request->file('image-file')->storeAs('images',$filename, 'public_uploads');
        } else {
            $filename = $old_image;
        }

        DB::table('users')
            ->where('id', $id)
            ->update([
                'username' => $user_name,
                'mail' => $mail,
                'password' => bcrypt($password),
                'password_base' => $password,
                'bio' => $bio,
                'images' => $filename
            ]);

        return back();
    }

}
