<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{
    //メッセージ一覧
    public function index($user_id) {
        //ログインユーザが送信したMsgの受信者（receiver_id）でグループ分け
        $messages = Message::where('sender_id', Auth::user()->id)->groupBy('receiver_id');
        // dd($messages);
        return view('messages.index', ['user' => $user_id]);
    }

    //メッセージ詳細
    public function show($id) {
        // $user = User::find($id);
        // $messages = Message::where('sender_id', Auth::user()->id)->where('receiver_id', $id);
        // return view('messages.show', ['user' => $user, 'messages' => $messages]);
    }

    //登録処理
    public function store(Request $request) {
        //バリデーション
        $request->validate(['body' => 'required|string|max:2048']);

        $message = new Message();
        $message->fill($request->all())->save();
        //受信者へメールにて通知機能
        return back()->with('flash_message', '正常にメッセージを送信しました。');
    }

    //編集画面
    public function edit() {

    }

    //更新処理
    public function update() {

    }

    //削除処理
    public function destroy() {

    }
}
