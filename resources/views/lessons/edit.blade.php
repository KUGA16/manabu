@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('layouts.sidevar')
        </div>
        <div class="col-md-9">
        <h3>レッスン編集</h3>
            <div class="card">
                <div class="card-body">
                    @include('layouts/errors')
                    <form method="post" action="{{ route('lessons.update', [$lesson->id]) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}<!-- 悪意ある投稿から保護する -->
                        {{ Form::hidden('_method', 'put') }}
                        <div class="form">
                            <div class="form-title">
                                {!! Form::label('title', 'タイトル') !!}<br>
                                {{ Form::text('title', $lesson->title) }}
                            </div>
                            <div class="form-image">
                                {!! Form::label('image', 'イメージ画像') !!}<br>
                                {{ Form::file('image') }}
                            </div>
                            <div class="form-keyword">
                                {!! Form::label('keyword', 'キーワード') !!}<br>
                                {{ Form::text('keyword', $lesson->keyword) }}
                            </div>
                            <div class="form-category">
                                {!! Form::label('category_id', 'カテゴリー') !!}<br>
                                {{ Form::select('category_id',['プログラミング', 'デザイン', '動画・写真', '起業・経営'], $lesson->category_id, ['placeholder' => '選択してください']) }}
                            </div>
                            <div class="form-date">
                                {{ Form::label('date', '開催日')}}<br>
                                {{ Form::date('date', $lesson->date) }}
                            </div>
                            <div class="form-time">
                                {{ Form::label('time', '開催時間')}}<br>
                                {{ Form::time('time', $lesson->time) }}
                            </div>
                            <div class="form-address">
                                {!! Form::label('l_address', '開催住所') !!}<br>
                                {{ Form::select('l_address', ['東京都', '埼玉県', '千葉県', '神奈川県'], $lesson->l_address, ['placeholder' => '選択してください'])}}
                                {{ Form::text('m_address', $lesson->m_address) }}
                            </div>
                            <div class="form-body">
                                {!! Form::label('body', 'レッスン内容') !!}<br>
                                {{ Form::textarea('body', $lesson->body, ['size' => '100x8']) }}
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