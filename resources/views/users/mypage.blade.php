@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('layouts.sidevar')
        </div>
        <div class="col-md-9">
            <div class="profile">
                <h4>プロフィール</h4>
                画像<br>
                {{ $user->name }}
                <!-- ログインユーザのみ編集ボタン表示 -->
                @if(Auth::user()->id == $user->id)
                    <form method="get" action="{{ route('users.edit', [Auth::user()->id]) }}">
                        {{ csrf_field() }} <!-- 悪意ある投稿から保護する -->
                        <input type="submit" value="編集" class="btn btn-secondary btn-md">
                     </form>
                @endif
            </div>

            <div class="row mt-5">
                <!-- ログインユーザ -->
                @if(Auth::user()->id == $user->id)
                    <div class="col-md-6">
                    <h4>作成レッスン</h4>
                        @foreach ($lessons as $lesson)
                            <a href="{{ action('LessonsController@show', $lesson->id) }}">
                                <div class="card">
                                    <div class="card-body">
                                    {{ $lesson->image }}<br>
                                    {{ $lesson->title }}<br>
                                    開催日：{{ $lesson->date }}<br>
                                    開催時間：{{ $lesson->time }}<br>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <!-- 申込みレッスン -->
                    <div class="col-md-6">
                    <h4>申込みレッスン</h4>
                        @foreach ($order_details as $order_detail)
                            <a href="{{ action('LessonsController@show', $order_detail->lesson->id) }}">
                                <div class="card">
                                    <div class="card-body">
                                        {{ $order_detail->lesson->title }}
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <!-- ログインユーザ以外 -->
                    <div class="col-md-12">
                    <h4>作成レッスン</h4>
                        @foreach ($lessons as $lesson)
                            <a href="{{ action('LessonsController@show', $lesson->id) }}">
                                <div class="card">
                                    <div class="card-body">
                                        {{ $lesson->image }}<br>
                                        {{ $lesson->title }}<br>
                                        開催日：{{ $lesson->date }}<br>
                                        開催時間：{{ $lesson->time }}
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection