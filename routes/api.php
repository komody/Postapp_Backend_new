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
    Route::put('/users/me',[UserController::class, 'update']);
    Route::delete('/users/{userId}',[UserController::class, 'destroy']);
    Route::get('/posts', [PostController::class, 'index']); // つぶやき投稿一覧
    Route::post('/posts', [PostController::class, 'create']); // つぶやき投稿

    Route::put('/posts/{postId}', [PostController::class, 'update']); // つぶやき更新

    Route::post('/users/{userId}/follow', [UserController::class, 'follow']); // フォロー
    Route::post('/users/{userId}/unfollow', [UserController::class, 'unfollow']); // フォロー解除
});

// ここはsanctumのミドルウェアグループから外さないと認証エラーになる
Route::post('/session/register', [SessionController::class, 'register']); // ユーザー登録
Route::post('/session', [SessionController::class, 'login']); // ログイン
Route::delete('/session', [SessionController::class, 'logout']); // ログアウト