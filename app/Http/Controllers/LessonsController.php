<?php

namespace App\Http\Controllers;

use App\Lesson;
use Carbon\Carbon;
use App\OrderDetail;
use App\Enums\CategoryId;
use App\Enums\Laddress;
use CreateUsersTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonsController extends Controller
{
    //作成画面
    public function create() {
        $categorys = CategoryId::toSelectArray();
        $l_addresses = Laddress::toSelectArray();
        return view('lessons.create', ['categorys' => $categorys, 'l_addresses' => $l_addresses]);
    }

    //登録処理
    public function store(Request $request) {
        $request->validate([
            'title'       => 'required|string|max:255', //入力必須、文字列、255文字以内
            'category_id' => 'required',
            'image'       => 'file|image', //アップロードに成功している、画像ファイル
            'body'        => 'required|string|max:2048',
            'keyword'     => 'max:255',
            'l_address'   => 'required',
            'm_address'   => 'required',
            'date'        => 'required|date|after:today', //今日より後の日付のみ可
            'time'        => 'required',
        ]);

            $lesson = new Lesson();
            $lesson->user_id = Auth::user()->id;

            //下記fillでまとめらる？
            $lesson->title = $request->title;
            //ファイル存在&問題なくアップロードしているか確認
            $lessonImg = $request->image;
            if($lessonImg->isValid()) {
                $filePath = $lessonImg->store('public');
                $lesson->image = str_replace('public/', '', $filePath);
            }
            $lesson->keyword = $request->keyword;
            $lesson->category_id = $request->category_id;
            $lesson->body = $request->body;
            $lesson->l_address = $request->l_address;
            $lesson->m_address = $request->m_address;
            $lesson->date = $request->date;
            $lesson->time = $request->time;
            //テーブルを保存
            $lesson->save();
            //flag_edit関数を呼び出し
            $this->teacher_flag_update(Auth::user());
            return redirect()->route('lessons.show', ['lesson' => $lesson->id])
            ->with('flash_message', '正常に投稿が完了しました。');
    }

    //一覧画面
    public function index() {
         //今日以降＆現在の時間より後のレッスン取得
        $lessons = Lesson::whereDate('date', '>=', Carbon::today())
        ->get();
        return view('lessons.index', ['lessons' => $lessons]);
    }

    //詳細画面
    public function show($id) {
        $lesson = Lesson::find($id);
        //$lessonを契約済か判断（order_details内にレコードがあればture:契約済、なければfalse:未契約）
        $have_lesson = OrderDetail::where('user_id', Auth::user()->id)->where('lesson_id', $lesson->id)->exists();
        return view('lessons.show', ['lesson' => $lesson, 'have_lesson' => $have_lesson]);
    }

    //編集画面
    public function edit($id) {
        $lesson = Lesson::find($id);
        return view('lessons.edit', ['lesson' => $lesson]);
    }

    //更新処理
    public function update(Request $request, $id) {
        //バリデーション
        $request->validate([
            'title'       => 'required|string|max:255', //入力必須、文字列、255文字以内
            'category_id' => 'required',
            // 'image'    => 'file|image', //アップロードに成功している、画像ファイル
            'body'        => 'required|string|max:2048',
            'keyword'     => 'max:255',
            'l_address'   => 'required',
            'm_address'   => 'required',
            'date'        => 'required|date|after:today', //今日より後の日付のみ可
            'time'        => 'required',
        ]);

        $lesson = Lesson::find($id);
        $new_date = $request->all();
        unset($request->all()['_token']); //トークン削除
        $lesson->fill($new_date)->save();
        return redirect()->route('lessons.show', ['lesson' => $id])
        ->with('flash_message', '正常にレッスンの編集が完了しました。');
    }

    //契約確認画面
    public function confirm($id) {
        $lesson = Lesson::find($id);
        return view('lessons.confirm', ['lesson' => $lesson]);
    }

    //削除処理
    public function destroy($id) {
        $lesson = Lesson::find($id);
        //このlessonに申込み者がいる場合（期限内）は削除できない
        $lesson->delete();
        //teacher_flag_destroy関数呼び出し
        $this->teacher_flag_update(Auth::user());

        return redirect()->route('users.mypage', ['user' => Auth::user()])
        ->with('flash_message', '正常にレッスンの削除が完了しました。');
    }

    //teacher_flag更新処理
    private function teacher_flag_update($user) {
        //レコードの存在を確認（戻り値はbool）
       $have_lesson = Lesson::where('user_id', $user->id)->exists();
       //Lessonに1つでもレコードがあればflagは1、なければ0
       switch($have_lesson) {
           case true:
            $user->teacher_flag = 1;
           break;
           case false:
            $user->teacher_flag = 0;
           break;
       }
       $user->fill(['teacher_flag'])->save();
       return;
    }
}
