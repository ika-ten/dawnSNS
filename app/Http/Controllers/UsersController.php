<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Post;
use App\User;
use App\Follow;

class UsersController extends Controller
{
    //
    public function profile(){
        return view('users.profile');
    }


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

    public function update(Request $request, User $user)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'screen_name'   => ['required', 'string', 'max:50', Rule::unique('users')->ignore($user->id)],
            'name'          => ['required', 'string', 'max:255'],
            'profile_image' => ['file', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'email'         => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)]
        ]);
        $validator->validate();
        $user->updateProfile($data);

        return redirect('users.profile'.$user->id);
    }

    public function index(User $user, Follow $follow, Post $post){
        $follow_count = $follow->getFollowCount($user->id);
        $follower_count = $follow->getFollowerCount($user->id);

        
        $user = auth()->user();
        
        //$follow_ids = $follow->followingIds($user->id);
        //$following_ids = $follow_ids->pluck('follower')->toArray();
        
        //$timelines = $post->getTimelines($user->id, $following_ids);

        return view('users.profile', [
            'user'      => $user,
            //'timelines' => $timelines,
            'follow_count'   => $follow_count,
            'follower_count' => $follower_count
        ]);
    }

}
