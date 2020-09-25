@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-3">
        @include('layouts.sidevar')
    </div>
    <div class="col-md-9">
     <h3>レッスン詳細</h3>
     <div class="card">
        <div class="card-body">
            <p>タイトル：{{ $lesson->title }}</p>
            <p>キーワード：{{ $lesson->keyword }}</p>
            <p>カテゴリー：{{ $lesson->category_id }}</p>
            <p>開催日：{{ $lesson->date }}</p>
            <p>開催時間：{{ $lesson->time }}</p>
            <p>開催住所：{{ $lesson->l_address }}</p>
            <p>レッスン内容：{{ $lesson->body }}</p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection