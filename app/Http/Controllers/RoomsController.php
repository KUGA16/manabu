<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Room;
use App\Models\RoomUser;
use App\Models\Message;
use Facade\Ignition\DumpRecorder\DumpHandler;
use Illuminate\Support\Facades\Auth;

class RoomsController extends Controller
{
    //メッセージ&ルーム登録処理
    public function store(Request $requests) {
        //バリデーション
        $requests->validate(['body' => 'required|string|max:2048']);

        //Room作成
        $room = Room::create();
        $values = array_merge($requests->all(),array('room_id'=>$room->id)); //$request配列内にroom_idを挿入

        //Message作成
        $message = new Message();
        $message->fill($values)->save();

        //RoomUser作成（送信ユーザ）
        $room_user = new RoomUser();
        $room_user->fill($values)->save();

        //RoomUser作成（受信ユーザ）
        $receiver_id = $values['receiver_id']; //受信ユーザのIDを取得しておく
        unset($values['receiver_id']); //配列内のreceiver_idを削除
        unset($values['user_id']); //配列内のログインユーザのuser_idを削除
        $new_values = array_merge($values,array('user_id'=>$receiver_id)); //新しいuser_idとして、$request配列内に受信ユーザのidを挿入
        //上記もっと綺麗な方法があるのか後日リファクタリング（receuver_idの値をuser_idの値に変更したい）
        $room_user = new RoomUser();
        $room_user->fill($new_values)->save();

        //受信者へメールにて通知機能
        //
        return back()->with('flash_message', '正常にメッセージを送信しました。');
    }

    //メッセージルーム一覧
    public function index($user_id) {
        return view('rooms.index', ['user_id' => $user_id]);
    }

    //メッセージルーム詳細
    public function show() {
    }

}
