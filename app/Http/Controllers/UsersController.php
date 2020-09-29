<?php

namespace App\Http\Controllers;

use App\User;
use App\Lesson;
use App\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{

  public function mypage($id) {
    $user = User::find($id);
    $lessons = Lesson::where('user_id', $user->id)
        ->orderBy('date', 'desc') //開催日が新しい順に並べる
        ->orderBy('time', 'asc') //開催時時間が古い順に並べる
        ->paginate(10); //ページネーション
    $order_details = OrderDetail::where('user_id', $user->id)
        ->orderBy('created_at', 'desc')
        ->paginate(10);
    return view('users.mypage', ['user' => $user, 'lessons' => $lessons, 'order_details' => $order_details]);
  }

  public function edit($id) {
    return view('users.edit', ['user' => Auth::user()]);
  }

  public function update(Request $request, $id) {

    //バリデーション
    $request->validate([
      'name' => 'required|string|max:255', //入力必須、文字列、255文字以内
      'email' => 'required|email:rfc',
    ]);

    $user = User::find($id);
    $new_date = $request->all();
    unset($request->all()['_token']);
    $user->fill($new_date)->save();
    return redirect()->route('users.mypage', ['user' => $user->id])
        ->with('flash_message', '正常にプロフィール編集が完了しました。');
  }
}
