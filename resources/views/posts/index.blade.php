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
      <?php echo $timeline ?>
      @if ($timeline->user_id === Auth::user()->id)
      <div class="tweet-menu">
        <!--
        <a class="edit-btn" href="/post/{{ $timeline->id }}/update-form"><img src="images/edit.png" alt=""></a>
        -->
        <a class="edit-btn" class="modalopen" href="" data-target="edit-modal-{{ $timeline -> id }}"><img src="images/edit.png" alt=""></a>
        <a class="trash-btn" href="/post/{{ $timeline->id }}/delete"><img src="images/trash.png" alt=""  onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')"></a>
        <!-- edit-modal -->
        <div class="modal-main js-modal" id="edit-modal-{{ $timeline -> id }}">
          <div class="modal-inner">
            <div class="inner-content">
              <?php echo $timeline ?>
              {!! Form::open(['url' => '/top','method' => 'post']) !!}
              {!! Form::hidden('id', $timeline->id) !!}
              {!! Form::input('text', 'upPost', $timeline->posts, ['required', 'class' => 'form-control']) !!}
                <button class="inner-post-edit-image">
                  <img src="images/edit.png" alt="">
                </button>
                <a class="send-button modalClose">Close</a><!-- /.send-button modalClose -->
              {!! Form::close()!!}
            </div>
          </div>
        </div>
      </div>
      @endif
    </div>
  </div>
@endforeach
@endif








@endsection