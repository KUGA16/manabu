<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\RequestLesson;

class OrderDetailsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order_detail = new OrderDetail();
        $order_detail->user_id = Auth::user()->id;
        $order_detail->lesson_id = $request->lesson_id;
        $order_detail->save();

        //生徒側に申込み完了メール通知
        // Auth::user()->notify(new RequestLesson($order_detail));
        //レッスン作成者にメール通知


        return redirect()->route('users.mypage', ['user' => Auth::user()->id])
        ->with('flash_message', '正常に申込みが完了しました。');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
