@extends('layouts.login')

@section('content')


@if($profile->id === Auth::user()->id)

    <div class="profile-form">
        <img class="profile-user-image round" src="{{ asset('images/'. $profile -> images) }}" alt="user profile image">
        {!! Form::open(['url' => '/user/update', 'enctype' => 'multipart/form-data']) !!}
        <ul class="form-group">
            {!! Form::hidden('id', $profile->id) !!}
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
            @endif

            <li>
              {{ Form::label('UserName') }}
              {!! Form::input('username', 'userName', $profile->username, ['class' => 'profile-form']) !!}
            </li>
            <li>
              {{ Form::label('MailAddress') }}
              {!! Form::input('mail', 'mail', $profile->mail, ['class' => 'profile-form']) !!}
            </li>
            <li>
              {{ Form::label('Password') }}
              {!! Form::input('password', 'oldPassWord', $profile->password_base, ['disabled','class' => 'profile-form']) !!}
            </li>
            <li>
              {{ Form::label('new Password') }}
              {!! Form::input('password', 'passWord', null, ['class' => 'profile-form']) !!}
            </li>
            <li class="bio-form">
              {{ Form::label('Bio') }}
              {!! Form::textarea('bio', $profile->bio, ['class' => 'profile-form profile-form-bio',]) !!}
            </li>
            <li class="image-form">
              {{ Form::label('Icon image') }}
              {!! Form::file('image-file', null, ['class' => 'profile-form profile-form-image']) !!}
            </li>
        </ul>
        <button type="submit" class="btn btn-success change-btn">更新</button>
        {!! Form::close() !!}
    </div>
@else
  
<!-- profile -->
<div class="profile">
  <img class="profile-user-image round" src="{{ asset('images/'. $profile -> images) }}" alt="user profile image">
  <div class="profile-box">
    <div class="profile-name profile-content">
      <p class="profile-title">Name</p>
      <p class="profile-username">{{ $profile -> username}}</p>
    </div>
    <div class="profile-bio profile-content">
      <p class="profile-title">Bio</p>
      <p class="profile-user-bio">{{ $profile -> bio}}</p>
    </div>
  </div><!-- /.profile-box -->

  <div class="user-list-follow-btn profile-btn">
  @if (auth()->user()->isFollowing($profile->id))
    <form action="{{ route('unfollow', ['user' => $profile->id]) }}" method="POST">
    @csrf
        {{ method_field('DELETE') }}

        <button class="btn btn-danger" type="submit">フォロー解除</button>
    </form>
  @else
    <form action="{{ route('follow', ['user' => $profile->id]) }}" method="POST">
    @csrf

        <button class="btn btn-primary" type="submit">フォローする</button>
    </form>
  @endif
  </div><!-- /.user-list-follow-btn -->
</div><!-- /.profile -->

@if (isset($timelines))
@foreach ($timelines as $timeline)
  <div class="tweets">
      <div class="tweets-box">
          <div class="tweet-title">
            <div class="tweet-user-img">
                <p><img src="{{ asset('images/'. $profile -> images) }}" class="round" width="50px" height="50px"></p>
            </div><!-- /.tweet-user-img -->
            <div class="tweet-user-name">
                <p>{{ $profile->username }}</p>
            </div><!-- /.tweet-user-name -->
            <div class="tweet-created-time">
                <p>{{ $timeline->created_at }}</p>
            </div><!-- /.tweet-created-time -->
        </div><!-- /.tweet-title -->
        <div class="tweet-timeline">
            <p class="tweets-top-text">{!! nl2br(e($timeline->posts)) !!}</p>
        </div><!-- /.tweet-timeline -->
      </div><!-- /.tweets-box -->
  </div>
@endforeach
@endif


@endif


@endsection