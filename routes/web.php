<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

// Home
Route::get('/', 'HomeController@index')->name('/');
Route::get('logout', 'HomeController@logout')->name('logout');

// Users
Route::get('users/{user}', 'UsersController@mypage')->name('users.mypage');
Route::resource('users', 'UsersController', ['only' => ['edit', 'update']]);

// Lessons
Route::resource('lessons', 'LessonsController');
Route::get('lessons/{lesson}/confirm', 'LessonsController@confirm')->name('lessons.confirm');

//OrderDetails
Route::group(['prefix' => 'users/{user}'], function() {
  Route::resource('order_details', 'OrderDetailsController', ['only' => ['store', 'destroy']]);
});