<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="{{asset('css/reset.css')}}">
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->
</head>
<body>
    <header>
            <div id = "head">
                <div id="head-left">
                    <h1><a href="/top"><img src="{{asset('images/main_logo.png')}}"></a></h1>
                </div><!-- /.head-left -->
                <div id="head-right">
                    <div id="head-right-box1">
                        <p>{{ $user->username }}さん</p>
                    </div><!-- /#head-right-box1 -->
    
                    <div id="head-right-box2">
                        <div class="menu-trigger"></div><!-- /.menu-trigger -->
                    </div><!-- /#head-right-box2 -->
    
                    
                    <div id="head-right-box3">
                        <img src="{{asset('images/'.$user->images)}}" class="round" width="50px" height="50px">
                    </div><!-- /#head-right-box3 -->
                </div><!-- /#head-right -->
    
                <div id="accordion-content">
                    <ul>
                        <li><a href="/top">ホーム</a></li>
                        <li><a href="/profile/{{ $user->id }}">プロフィール</a></li>
                        <li><a href="/logout">ログアウト</a></li>
                    </ul>
                </div><!-- /#accordion-content -->
            </div><!-- /#head -->
    </header>


        <div id="row">
            <div id="container">
                @yield('content')
            </div >
            <div id="side-bar">
                <div id="confirm">
                    <div class="confirm-box">
                        <p>{!! $user->username !!}さんの</p>
                    </div><!-- /.confirm-box -->
                    <div class="confirm-box">
                        <div class="confirm-box-text">
                            <p>フォロー数</p>
                            <p>{{ $user->followsCount() }}名</p>
                        </div><!-- /.confirm-box-text -->
                        <div class="confirm-box-btn text-right">
                            <p class="btn"><a href="/follow-list">フォローリスト</a></p>
                        </div><!-- /.confirm-box-btn -->
                    </div>
                    <div class="confirm-box">
                        <div class="confirm-box-text">
                            <p>フォロワー数</p>
                            <p>{{ $user->followersCount() }}名</p>
                        </div><!-- /.confirm-box-text -->
                        <div class="confirm-box-btn text-right">
                            <p class="btn"><a href="/follower-list">フォロワーリスト</a></p>
                        </div><!-- /.confirm-box-btn text-right -->
                    </div>
                    <div class="search-btn text-center">
                        <p class="btn"><a href="/search">ユーザー検索</a></p>
                    </div><!-- /.search-btn -->
                </div>
            </div>
        </div>

    <footer>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>