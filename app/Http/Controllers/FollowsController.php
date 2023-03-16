<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Post;
use App\Follow;

class FollowsController extends Controller
{
    
    public function followList(User $user, Post $post, Follow $follow){
        $follow_count = $follow->getFollowCount($user->id);
        $follower_count = $follow->getFollowerCount($user->id);

        $user = auth()->user();

        $follow_ids = $follow->followingIds($user->id);
        $following_ids = $follow_ids->pluck('follower')->toArray();

        $follow_id_lists = User::find($follow_ids);
        $timelines = $post->getTimelines($user->id, $following_ids);

        return view('follows.followList',[ 
            'user' => $user, 
            'timelines' => $timelines,
            'follow_id_lists' => $follow_id_lists,
            'follow_count'   => $follow_count,
            'follower_count' => $follower_count
        ]);
    }

    public function followerList(User $user, Post $post, Follow $follow){
        $follow_count = $follow->getFollowCount($user->id);
        $follower_count = $follow->getFollowerCount($user->id);

        $user = auth()->user();

        $follow_ids = $follow->followingIds($user->id);
        $following_ids = $follow_ids->pluck('follow')->toArray();

        $follow_id_lists = User::find($follow_ids);
        $timelines = $post->getTimelines($user->id, $following_ids);

        return view('follows.followerList',[ 
            'user' => $user, 
            'timelines' => $timelines,
            'follow_id_lists' => $follow_id_lists,
            'follow_count'   => $follow_count,
            'follower_count' => $follower_count
        ]);
    }

    
}
