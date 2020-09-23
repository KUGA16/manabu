<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lesson;

class LessonsController extends Controller
{
    //作成画面
    public function create() {
        $lesson = new Lesson();
        return view('lessons/create');
    }

    //登録処理
    public function store() {

    }

    //一覧画面
    public function index() {

    }

    //編集画面
    public function edit() {

    }

    //更新処理
    public function update() {

    }

    //契約確認画面
    public function confirm() {

    }

    //削除処理
    public function destroy() {

    }
}
