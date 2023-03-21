@extends('layouts.login')

@section('content')
<div class="follow-lists">
  <p>Follow list</p>
  <div class="follow-images">
  @foreach ($follower_id_lists as $follower_id_list)
    <div class="follow-image">
      <a href="/profile/{{ $follower_id_list -> id}}">
        <img src="images/{{ $follower_id_list -> images}}" alt="follower image" class='round' width="55px" height="55px">
      </a>
    </div><!-- follow-image -->
  @endforeach
  </div><!-- follow-images -->
</div><!-- follow-lists -->





@if (isset($timelines))
@foreach ($timelines as $timeline)
  <div class="tweets-top">
    <div class="card">
      <div class="tweet-timelines">
        <div id="top-image2" class="top-image2">
          <p><img src="images/{{$timeline->user->images}}" class="round" width="50px" height="50px"></p>
        </div>
        <div class="timelines">
          <p class="tweets-top-username">{{ $timeline->user->username }}</p>
          <p class="tweets-top-text">{!! nl2br(e($timeline->posts)) !!}</p>
        </div>
        <div class="tweets-top-time">
          <p>{{ $timeline->created_at }}</p>
        </div>
      </div> 
      @if ($timeline->user_id === Auth::user()->id)
      <div class="tweet-menu">
      <a class="edit-btn" href="/post/{{ $timeline->id }}/update-form"><img src="images/edit.png" alt=""></a>
      <a class="trash-btn" href="/post/{{ $timeline->id }}/delete"><img src="images/trash.png" alt=""  onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')"></a>
      </div>
      @endif
    </div>
  </div>
@endforeach
@endif


@endsection