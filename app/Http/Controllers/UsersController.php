<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Lesson;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{

  //会員マイページ
  public function mypage($user_id) {
    $user = User::find($user_id);
    $lessons = Lesson::where('user_id', $user->id)
        ->orderBy('date', 'desc') //開催日が新しい順に並べる
        ->orderBy('time', 'asc') //開催時時間が古い順に並べる
        ->paginate(10); //ページネーション
    $order_details = OrderDetail::where('user_id', $user->id)
        ->orderBy('created_at', 'desc')
        ->paginate(10);
    return view('users.mypage', ['user' => $user, 'lessons' => $lessons, 'order_details' => $order_details]);
  }

  //会員情報編集画面
  public function edit() {
    return view('users.edit', ['user' => Auth::user()]); //ログインユーザの画面のみ表示
  }

  //更新処理
  public function update(Request $request, $user_id) {

    //バリデーション
    $request->validate([
      'name' => 'required|string|max:255', //入力必須、文字列、255文字以内
      'email' => 'required|email:rfc',
    ]);

    $user = User::find($user_id);
    $new_date = $request->all();
    unset($request->all()['_token']);
    $user->fill($new_date)->save();
    return redirect()->route('users.mypage', ['user' => $user->id])
        ->with('flash_message', '正常にプロフィール編集が完了しました。');
  }
}
