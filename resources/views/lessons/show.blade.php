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
                    <p>開催住所：{{ $lesson->l_address }}{{ $lesson->m_address }}</p>
                    <p>レッスン内容：{{ $lesson->body }}</p>
                    <!-- レッスン作成者か判断 -->
                    @if(Auth::user()->id == $lesson->user_id)
                        <form method="get" action="{{ route('lessons.edit', [$lesson->id]) }}">
                            {{ csrf_field() }}
                            <input type="submit" value="編集する" class="btn btn-secondary btn-lg">
                        </form>
                        <form method="post" action="{{ route('lessons.destroy', [$lesson->id]) }}">
                            {{ csrf_field() }}
                            {{ Form::hidden('_method', 'delete') }}
                            <input type="submit" value="レッスンを削除" class="btn btn-link" onclick='confirm("{{ $lesson->title }}を本当に削除しますか？")'>
                        </form>
                    @else
                        <!-- レッスン未購入か判断 -->
                        @switch($have_lesson)
                            @case(false)
                                <form method="get" action="{{ route('lessons.confirm', [$lesson->id]) }}">
                                    {{ csrf_field() }}
                                    <input type="submit" value="契約する" class="btn btn-secondary btn-lg">
                                </form>
                                @break
                            @case(true)
                                <form method="get" action="">
                                    {{ csrf_field() }}
                                    <input type="submit" value="契約解除する" class="btn btn-secondary btn-lg">
                                </form>
                                @break
                            @default
                        @endswitch
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection