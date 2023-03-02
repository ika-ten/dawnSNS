@extends('layouts.logout')

@section('content')

{!! Form::open() !!}

<p class="form-title">新規ユーザー登録</p>

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
