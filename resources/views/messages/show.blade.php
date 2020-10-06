@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('layouts.sidevar')
        </div>
        <div class="col-md-9">
            <h3>{{ $user->name }}さんとのメッセージ</h3>

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
                              <form method="post" action="{{ route('messages.store', [$user->id]) }}" enctype="multipart/form-data">
                                  @csrf <!-- 悪意ある投稿から保護する -->
                                  <div class="form">
                                      <div class="form-title">
                                          {{ Form::textarea('body', old('body')) }}
                                      </div>
                                  </div>
                              </form>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                              <button type="button" class="btn btn-primary">送信</button>
                          </div>
                    </div>
                </div>
            </div>

            <div class="messages">
                @foreach($messages as $message)
                  {{ $message->body }}
                @endforeach
            </div>


        </div>
    </div>
</div>
@endsection