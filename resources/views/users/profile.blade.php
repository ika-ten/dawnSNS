@extends('layouts.login')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if($profile->id === Auth::user()->id)
    <div class='container'>
        <h2 class='page-header'>プロフィールを変更する</h2>
        {!! Form::open(['url' => '/user/update', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {!! Form::hidden('id', $profile->id) !!}
            <p>username</p>
            {!! Form::input('username', 'userName', $profile->username, ['class' => 'form-control']) !!}
            <p>e-mail</p>
            {!! Form::input('mail', 'mail', $profile->mail, ['class' => 'form-control']) !!}
            <p>password</p>
            {!! Form::input('password', 'passWord', null, ['class' => 'form-control']) !!}
            <p>bio</p>
            {!! Form::input('bio', 'bio', $profile->bio, ['class' => 'form-control','size'=>50, 'maxlength'=>10]) !!}
            <p>image</p>
            {!! Form::file('image-file',null, ['class' => 'form-control']) !!}
        </div>
        <button type="submit" class="btn btn-primary pull-right">更新</button>
        {!! Form::close() !!}
    </div>
@else
  
<!-- profile -->
<div class="profile">
  <img class="profile-user-image round" src="{{ asset('images/'. $profile -> images) }}" alt="user profile image">
  <div class=profile-name>
    <p>Name</p>
    <p class="profile-username">{{ $profile -> username}}</p>
  </div>
  <div class="profile-bio">
    <p>Bio</p>
    <p class="profile-user-bio">{{ $profile -> bio}}</p>
  </div>

    <div class="user-list-follow-btn">
  @if (auth()->user()->isFollowing($profile->id))
    <form action="{{ route('unfollow', ['user' => $profile->id]) }}" method="POST">
    @csrf
        {{ method_field('DELETE') }}

        <button type="submit">フォロー解除</button>
    </form>
  @else
    <form action="{{ route('follow', ['user' => $profile->id]) }}" method="POST">
    @csrf

        <button type="submit">フォローする</button>
    </form>
  @endif
  </div><!-- /.user-list-follow-btn -->
  
  
  @foreach ($timelines as $timeline)
  <div class="tweets-top">
    <div class="card">
      <div class="tweet-timelines">
        <div id="top-image2" class="top-image2">
          <p><img src="{{ asset('images/'. $profile -> images) }}" class="round" width="50px" height="50px"></p>
        </div>
        <div class="timelines">
          <p class="tweets-top-username">{{ $profile->username }}</p>
          <p class="tweets-top-text">{!! ($timeline->posts) !!}</p>
        </div>
        <div class="tweets-top-time">
          <p>{{ $timeline->created_at }}</p>
        </div>
      </div> 
    </div>
  </div>
@endforeach
</div>


@endif


@endsection