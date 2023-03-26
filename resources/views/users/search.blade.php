@extends('layouts.login')

@section('content')
<div class="search-box">
  
  {!! Form::open(['route' => 'search', 'method' => 'get']) !!}
  <div class="search-forms">
  {!! Form::text('username' ,'', ['class' => 'search-form', 'placeholder' => ' ユーザー名'] ) !!}
  <input class="search-form-btn" type="image" src="images/post.png"></input>
  {!! Form::close() !!}
</div><!-- /.search-forms -->

    @if(!empty($search))
    <div class="search-form-result">
      <p>検索ワード：{{ $search }}</p>
    </div><!-- /.search-form-result -->
    @endif
</div><!-- /.search-box-->


@foreach ($data as $all_user)
<div class="user-list">
  <div class="user-list-content">
    <img src="/images/{{ $all_user->images }}" alt="" class="round">
    <p>{{ $all_user->username }}</p>
  </div><!-- /.user-list-content -->
  <div class="user-list-follow-btn">
  @if (auth()->user()->isFollowing($all_user->id))
    <form action="{{ route('unfollow', ['user' => $all_user->id]) }}" method="POST">
    @csrf
        {{ method_field('DELETE') }}

        <button class="btn btn-danger"type="submit">フォロー解除</button>
    </form>
  @else
    <form action="{{ route('follow', ['user' => $all_user->id]) }}" method="POST">
    @csrf

        <button class="btn btn-primary" type="submit">フォローする</button>
    </form>
  @endif
  </div><!-- /.user-list-follow-btn -->
</div><!-- /.user-list -->

@endforeach

@endsection