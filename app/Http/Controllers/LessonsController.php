<?php

namespace App\Http\Controllers;

use App\Lesson;
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
        $lesson = new Lesson();
        $lesson->user_id = Auth::user()->id;
        $lesson->title = $request->title;
        $lesson->image = "image";
        $lesson->keyword = $request->keyword;
        $lesson->category_id = 1;
        $lesson->body = $request->body;
        $lesson->l_address = $request->l_address;
        $lesson->m_address = $request->m_address;
        $lesson->date = $request->date;
        $lesson->time = $request->time;
        $lesson->save();
        return redirect()->route('lessons.show', ['lesson' => $lesson->id]);
    }

    //一覧画面
    public function index() {

    }

    //詳細画面
    public function show($id) {
        $lesson = Lesson::findOrFail($id);
        return view('lessons.show', ['lesson' => $lesson]);
    }

    //編集画面
    public function edit() {

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
