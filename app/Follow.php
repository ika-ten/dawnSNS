<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    public function getFollowCount($user_id)
    {
        return $this->where('follow', $user_id)->count();
    }

    public function getFollowerCount($user_id)
    {
        return $this->where('follower', $user_id)->count();
    }
    //参考：https://teratail.com/questions/297833

    public function followingIds(Int $user_id)
    {
        return $this->where('follow', $user_id)->get('follower');
    }

    public function followedIds(Int $user_id)
    {
        return $this->where('follower', $user_id)->get('follow');
    }

};
