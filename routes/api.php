<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SessionController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/user/{userId}',[UserController::class, 'show']);
// Route::get('/user/{userId}', 'App\Http\Controllers\UserController@show');
Route::put('/user/{userId}',[UserController::class, 'user']);

Route::post('/session', [SessionController::class, 'create']); // ログイン
Route::delete('/session', [SessionController::class, 'destroy']); // ログアウト

Route::post('/user', [UserController::class, 'create']); // ログイン

// 参考記事
// 【Laravel】SanctumでAPIトークン認証の使い方とSPA認証との比較
// https://qiita.com/104dev/items/0787a81f7dda892ce86a