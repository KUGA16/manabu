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
                @else
                    <!-- モーダルボタン -->
                    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#Modal">
                        メッセージを送る
                    </button>
                    <!-- モーダル本体 -->
                    <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="msg" method="post" action="{{ route('messages.store', [Auth::user()->id]) }}" enctype="multipart/form-data">
                                        {{ csrf_field() }} <!-- 悪意ある投稿から保護する -->
                                        <div class="form">
                                            <div class="form-body">
                                                {{ Form::hidden('sender_id', Auth::user()->id) }} <!-- 送信者ID（ログインユーザ） -->
                                                {{ Form::hidden('receiver_id', $user->id) }} <!-- 受信者ID -->
                                                {{ Form::textarea('body', old('body'), ['size' => '60x10']) }} <!-- メッセージ内容 -->
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                                    <button type="submit" form="msg" class="btn btn-primary">送信</button>
                                </div>
                            </div>
                        </div>
                    </div>
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