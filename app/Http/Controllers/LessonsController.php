<?php

namespace App\Http\Controllers;

use App\Lesson;
use App\OrderDetail;
use CreateUsersTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonsController extends Controller
{
    //作成画面
    public function create() {
        return view('lessons.create');
    }

    //登録処理
    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255', //入力必須、文字列、255文字以内
            'category_id' => 'required',
            // 'image' => 'file|image', //アップロードに成功している、画像ファイル
            'body'=>'required|string|max:2048',
            'l_address' => 'required',
            'm_address' => 'required',
            'date' => 'required',
            'time' => 'required',
        ]);

            $lesson = new Lesson();
            $lesson->user_id = Auth::user()->id;

            $lesson->title = $request->title;
            $lesson->image = 'image';
            $lesson->keyword = $request->keyword;
            $lesson->category_id = 1;
            $lesson->body = $request->body;
            $lesson->l_address = $request->l_address;
            $lesson->m_address = $request->m_address;
            $lesson->date = $request->date;
            $lesson->time = $request->time;
            //テーブルを保存
            $lesson->save();
            return redirect()->route('lessons.show', ['lesson' => $lesson->id])
            ->with('flash_message', '正常に投稿が完了しました。');
    }

    //一覧画面
    public function index() {

    }

    //詳細画面
    public function show($id) {
        $lesson = Lesson::findOrFail($id);
        //$lessonを契約済か判断（order_details内にレコードがあればture:契約済、なければfalse:未契約）
        $have_lesson = OrderDetail::where('user_id', Auth::user()->id)->where('lesson_id', $lesson->id)->exists();
        return view('lessons.show', ['lesson' => $lesson, 'have_lesson' => $have_lesson]);
    }

    //編集画面
    public function edit($id) {
        $lesson = Lesson::findOrFail($id);
        return view('lessons.edit', ['lesson' => $lesson]);
    }

    //更新処理
    public function update() {

    }

    //契約確認画面
    public function confirm($id) {
        $lesson = Lesson::findOrFail($id);
        return view('lessons.confirm', ['lesson' => $lesson]);
    }

    //削除処理
    public function destroy() {

    }
}
