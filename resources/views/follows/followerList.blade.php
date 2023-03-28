@extends('layouts.login')

@section('content')
<div class="follow-lists">
  <p>Follower list</p>
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
  <div class="tweets">
      <div class="tweets-box">
          <div class="tweet-title">
            <div class="tweet-user-img">
                <p><img src="images/{{$timeline->user->images}}" class="round" width="50px" height="50px"></p>
            </div><!-- /.tweet-user-img -->
            <div class="tweet-user-name">
                <p>{{ $timeline->user->username }}</p>
            </div><!-- /.tweet-user-name -->
            <div class="tweet-created-time">
                <p>{{ $timeline->created_at }}</p>
            </div><!-- /.tweet-created-time -->
        </div><!-- /.tweet-title -->
        <div class="tweet-timeline">
            <p class="tweets-top-text">{!! nl2br(e($timeline->posts)) !!}</p>
        </div><!-- /.tweet-timeline -->
      </div><!-- /.tweets-box -->
      @if ($timeline->user_id === Auth::user()->id)
      <div class="tweet-menu">
        <a class="edit-btn modalopen" href="" data-target="edit-modal-{{ $timeline -> id }}"><img src="images/edit.png" alt=""></a>
         <a class="trash-btn" href="/post/{{ $timeline->id }}/delete" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')"></a>
      </div>
      @endif
      
      
      
      <!-- edit-modal -->
      <div class="modal-main js-modal" id="edit-modal-{{ $timeline -> id }}">
        <div class="modal-inner">
          <div class="inner-content">
            {!! Form::open(['url' => '/top','method' => 'post']) !!}
            {!! Form::hidden('id', $timeline->id) !!}
            {!! Form::input('text', 'upPost', $timeline->posts, ['required', 'class' => 'form-control']) !!}
            <div class="modal-edit-btn">
              <button class="edit-btn"><img src="images/edit.png" alt=""></button>
            </div><!-- /.modal-edit-btn -->  
            {!! Form::close()!!}
          </div>
        </div>
      </div>

  </div>
@endforeach
@endif


@endsection