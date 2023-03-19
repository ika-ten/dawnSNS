@extends('layouts.login')

@section('content')


    <div class='container'>
        <h2 class='page-header'>プロフィールを変更する</h2>
        {!! Form::open(['url' => '/user/update']) !!}
        <div class="form-group">
            {!! Form::hidden('id', $profile->id) !!}
            <p>username</p>
            {!! Form::input('username', 'userName', $profile->username, ['required', 'class' => 'form-control']) !!}
            <p>e-mail</p>
            {!! Form::input('mail', 'mail', $profile->mail, ['required', 'class' => 'form-control']) !!}
            <p>password</p>
            {!! Form::input('password', 'passWord', null, ['required', 'class' => 'form-control']) !!}
            <p>bio</p>
            {!! Form::textarea('bio', 'bio', $profile->bio, ['class' => 'form-control','size'=>50, 'maxlength'=>10]) !!}
            <p>image</p>
            {!! Form::file('image-file', null, ['class' => 'form-control']) !!}
        </div>
        <button type="submit" class="btn btn-primary pull-right">更新</button>
        {!! Form::close() !!}
    </div>


@endsection