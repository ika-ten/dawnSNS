@extends('layouts.login')

@section('content')
<div id="post-area">
    <form class="post-area-form" action="POST" action="{{ route('top.store') }}">
        <div id="post-area-form-icon">
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






@endsection