@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('layouts.sidevar')
        </div>
        <div class="col-md-9">
            <h3>会員情報編集画面</h3>
            <div class="card">
                <div class="card-body">
                    @include('layouts/errors')
                    <form method="post" action="{{ route('users.update', [$user->id]) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}<!-- 悪意ある投稿から保護する -->
                        {{ Form::hidden('_method', 'put') }}
                        <div class="form">
                            <div class="form-title">
                                {!! Form::label('name', '名前') !!}<br>
                                {{ Form::text('name', $user->name) }}
                            </div>
                            <div class="form-image">
                                {!! Form::label('image', 'プロフィール画像') !!}<br>
                                {{ Form::file('image', $user->image) }}
                            </div>
                            <div class="form-keyword">
                                {!! Form::label('email', 'メールアドレス') !!}<br>
                                {{ Form::text('email', $user->email) }}
                            </div>
                            <div class="form-submit">
                                {{Form::submit('保存する', ['class' => 'btn btn-secondary btn-lg'])}}
                            </div>
                        </div>
                    </form>





                </div>
            </div>
        </div>
    </div>
</div>
@endsection
