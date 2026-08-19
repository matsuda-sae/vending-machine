<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// トップページ（/）にアクセスしたら商品一覧へ転送
Route::get('/', function () {
    return redirect()->route('products.index');
});

// 商品一覧画面の表示・検索
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// 新規登録画面の表示
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');

// 新規登録処理（フォーム送信先）
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
// 商品詳細画面の表示
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
// 商品編集画面の表示
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');

// 商品更新処理（フォーム送信先）
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');

// 商品削除処理
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');