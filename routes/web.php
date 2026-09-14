<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 認証機能のルート（ログイン・新規会員登録・ログアウトなど）
Auth::routes();

// ログインしていない場合はログイン画面（/login）へリダイレクト
Route::get('/', function () {
    return redirect()->route('login');
});

// ログイン済みのユーザーのみアクセス可能
Route::group(['middleware' => 'auth'], function () {
    Route::resource('products', ProductController::class);
});