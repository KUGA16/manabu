<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{

  public function edit($id)
  {
    $auth = Auth::user();

    return view('user.edit', ['auth' => $auth]);
  }

}
