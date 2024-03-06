<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\PostController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/users/{userId}',[UserController::class, 'show']);
    Route::put('/users/{userId}',[UserController::class, 'user']);

    Route::get('/posts', [PostController::class, 'index']); // つぶやき投稿一覧
    Route::post('/posts', [PostController::class, 'create']); // つぶやき投稿
});

// ここはsanctumのミドルウェアグループから外さないと認証エラーになる
Route::post('/session/register', [SessionController::class, 'register']); // ユーザー登録
Route::post('/session', [SessionController::class, 'login']); // ログイン
Route::delete('/session', [SessionController::class, 'logout']); // ログアウト

// APIリクエストから有効なトークンを取得するには？
// https://zenn.dev/yumemi_inc/articles/be65cfad4fea44