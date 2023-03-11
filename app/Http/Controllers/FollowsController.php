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
    //
    public function followList(){
        
        $follower_id = DB::table('follows')
            ->where('follow',Auth::id())
            ->pluck('follower'); 

        $posts = DB::table('posts')
            ->join('users','posts.user_id','=','users.id')
            ->whereIn('user_id',$follower_id)
            ->select('posts.posts','posts.created_at as created_at','users.id','users.username','users.images')
            ->orderBy('posts.created_at', 'desc')
            ->get();


        return view('follows.followList',compact('posts'));
    }

    public function followerList(){
        $follow_id = DB::table('follows')
        ->where('follower',Auth::id())
        ->pluck('follow');


    $posts = DB::table('posts')
        ->join('users','posts.user_id','=','users.id')
        ->whereIn('user_id',$follow_id)
        ->select('posts.posts','posts.created_at as created_at','users.id','users.username','users.images')
        ->orderBy('posts.created_at', 'desc')
        ->get();

    return view('follows.followerList',compact('posts'));
    }

    //参考：https://www.ritolab.com/posts/93
    //https://dawn-techschool.com/curriculum/server/6/41
    //
    

    
}
