<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     *
     *  middlewareでauthが設定(アクセスの制限)
     *  public function __construct()
     *  {
     *     $this->middleware('auth');
     *  }
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    //ダッシュボード
    public function index() {
        return view('home/dash');
    }

    //ログアウト画面
    public function logout() {
        return view('home/logout');
    }
}
