@extends('layouts.login')

@section('content')
<div class="search-forms">
  {!! Form::open(['route' => 'search', 'method' => 'get']) !!}
  <div class="search-form">
  {!! Form::text('username' ,'', ['class' => 'search-form', 'placeholder' => ' ユーザー名'] ) !!}
    <input type="image" src=""></input>
    {!! Form::close() !!}

    @if(!empty($search))
    <div class="search-form-result">
      <label for="form"></label>
      <p>{{ $search }}</p>
    </div><!-- /.search-form-result -->
    @endif
  </div><!-- /.search-form -->
</div><!-- /.search-forms-->


@foreach ($data as $all_user)
<div class="user-list">
  <div class="user-list-content">
    <img src="/images/{{ $all_user->images }}" alt="" class="round" width="50px" height="50px">
    <p>{{ $all_user->username }}</p>
  </div><!-- /.user-list-content -->
  <div class="user-list-follow-btn">
  @if (auth()->user()->isFollowing($all_user->id))
    <form action="{{ route('unfollow', ['user' => $all_user->id]) }}" method="POST">
    @csrf
        {{ method_field('DELETE') }}

        <button type="submit">フォロー解除</button>
    </form>
  @else
    <form action="{{ route('follow', ['user' => $all_user->id]) }}" method="POST">
    @csrf

        <button type="submit">フォローする</button>
    </form>
  @endif
  </div><!-- /.user-list-follow-btn -->
</div><!-- /.user-list -->

@endforeach

@endsection