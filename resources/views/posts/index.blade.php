@extends('layouts.login')

@section('content')
<div id="post-area">
    <form class="post-area-form" method="POST" action="{{ url('posts/store') }}">
    @csrf
        <div class="post-area-form-icon">
            <img src="images/dawn.png" class="round">
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

  <!-- 4.2 ログインユーザーのつぶやきを表示 -->
  <!-- 4.2.1 ログインユーザーのフォローのつぶやき表示を表示 -->
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


      <div class="tweet-menu">





      </div>

      @endif

    </div>
  </div>
  @endforeach
  @endif




@endsection