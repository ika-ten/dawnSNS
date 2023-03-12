@extends('layouts.login')

@section('content')
<div class="follow-lists">
  <p>Follow list</p>
  <div class="follow-images">
  @foreach ($follow_id_lists as $follow_id_list)
    <div class="follow-image">
      <a href="/profile/{{ $follow_id_list -> id}}">
        <img src="images/{{ $follow_id_list -> images}}" alt="follow image" class='round' width="55px" height="55px">
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
          <p><img src="images/dawn.png" class="rounded-circle"></p>
        </div>
        <div class="timelines">
          <p class="tweets-top-username">{{ $timeline->user->username }}</p>
          <p class="tweets-top-text">{!! nl2br(e($timeline->posts)) !!}</p>
        </div>
        <div class="tweets-top-time">
          <p>{{ $timeline->created_at }}</p>
        </div>
      </div> 
      @if ($timeline->id === Auth::user()->id)
      <div class="tweet-menu"></div>
      @endif
    </div>
  </div>
@endforeach
@endif


@endsection