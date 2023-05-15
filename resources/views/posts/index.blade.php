@extends('layouts.login')

@section('content')
<div id="post-area">
    <form class="post-area-form" method="POST" action="{{ url('posts/store') }}">
    @csrf
        <div class="post-area-form-icon">
            <img src="images/{{$user->images}}" class="round" width="50px" height="50px">
        </div><!-- /#post-area-form-icon -->
        <div class="post-area-form-textarea">
            <textarea name="posts" cols="100" rows="5" require placeholder="何を呟こうか...?"></textarea><!-- /# -->
        </div><!-- /.post-area-form-textarea -->
        <div class="post-area-form-postbtn">
                <input type="image" src="images/post.png"></input>
            <!-- 参考： https://dekiru.net/article/12958/ -->
        </div><!-- /.post-area-form-postbtn -->
    </form>
</div><!-- /#post-area -->


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
        <a class="trash-btn" href="post/{{ $timeline->id }}/delete" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')"></a>
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