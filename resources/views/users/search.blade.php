@extends('layouts.login')

@section('content')
<div class="search-form">
    {!! Form::open(['route' => 'search', 'method' => 'get']) !!}
</div><!-- /.search-form -->

@foreach ($all_users as $user)
<div class="user-list">
  <div class="user-list-content">
    <img src="images/dawn.png" alt="" class="round"><!-- src="{{ $user->profile_image }}" -->
    <p>{{ $user->username }}</p>
  </div><!-- /.user-list-content -->
  <div class="user-list-follow-btn">
  @if (auth()->user()->isFollowing($user->id))
    <form action="{{ route('unfollow', ['id' => $user->id]) }}" method="POST">
    @csrf
        {{ method_field('DELETE') }}

        <button type="submit">フォロー解除</button>
    </form>
  @else
    <form action="{{ route('follow', ['id' => $user->id]) }}" method="POST">
    @csrf

        <button type="submit">フォローする</button>
    </form>
  @endif
  </div><!-- /.user-list-follow-btn -->
</div><!-- /.user-list -->

@endforeach

@endsection