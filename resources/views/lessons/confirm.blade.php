@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
     <h3>契約確認画面</h3>
     <div class="card">
        <div class="card-body">
            <p>タイトル：{{ $lesson->title }}</p>
            <p>開催日：{{ $lesson->date }}</p>
            <p>開催時間：{{ $lesson->time }}</p>
            <p>開催住所：{{ $lesson->l_address }}{{ $lesson->m_address }}</p>
            <p>レッスン内容：{{ $lesson->body }}</p>

            <form method="post" action="{{ route('order_details.store', [Auth::user()->id]) }}">
                @csrf <!-- 悪意ある投稿から保護する -->
                {{Form::hidden('lesson_id', $lesson->id)}}
                <input type="submit" value="契約を確定する" class="btn btn-secondary btn-lg">
            </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection