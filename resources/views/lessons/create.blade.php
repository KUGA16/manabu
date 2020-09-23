@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-3">
      <div class="card">
        <div class="card-body">
           サイドバー
        </div>
      </div>
    </div>
    <div class="col-md-9">
     <h3>レッスン作成</h3>
     <div class="card">
        <div class="card-body">
            <form method="post" action="{{ route('lessons.store') }}" enctype="multipart/form-data">
            @csrf <!-- 悪意ある投稿から保護する -->
                <div class="form">
                    <div class="form-title">
                        {!! Form::label('title', 'タイトル') !!}<br>
                        {!! Form::text('title', old('title')) !!}
                    </div>
                    <div class="form-image">
                        {!! Form::label('image', 'イメージ画像') !!}<br>
                        {!! Form::file('image') !!}
                    </div>
                    <div class="form-keyword">
                        {!! Form::label('keyword', 'キーワード') !!}<br>
                        {!! Form::text('keyword', old('keyword')) !!}
                    </div>
                    <div class="form-category">
                        {!! Form::label('categories_id', 'カテゴリー') !!}<br>
                        {!! Form::select(
                            'categories_id',[
                                'プログラミング',
                                'デザイン', '動画・写真',
                                '起業・経営'
                            ],
                            null,
                            ['placeholder' => '選択してください']
                            )
                        !!}
                    </div>
                    <div class="form-body">
                        {!! Form::label('body', 'レッスン内容') !!}<br>
                        {!! Form::textarea('body', null, ['size' => '100x8']) !!}
                    </div>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection