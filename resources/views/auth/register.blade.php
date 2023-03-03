@extends('layouts.logout')

@section('content')

{!! Form::open() !!}

<p class="form-title">新規ユーザー登録</p>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<!-- 参考:https://readouble.com/laravel/6.x/ja/validation.html#:~:text=is%20credit%20card.-,%E4%BD%BF%E7%94%A[%E2%80%A6]-%E4%BD%BF%E7%94%A8%E5%8F%AF%E8%83%BD%E3%81%AA-->

{{ Form::label('UserName') }}
{{ Form::text('username',null,['class' => 'input']) }}

{{ Form::label('MailAddress') }}
{{ Form::text('mail',null,['class' => 'input']) }}

{{ Form::label('Password') }}
{{ Form::text('password',null,['class' => 'input']) }}

{{ Form::label('Password confirm') }}
{{ Form::text('password_confirmation',null,['class' => 'input']) }}

{{ Form::submit('登録') }}

<p><a href="/login">ログイン画面へ戻る</a></p>

{!! Form::close() !!}


@endsection
