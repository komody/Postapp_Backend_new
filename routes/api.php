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



Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });


    Route::get('/users/{userId}',[UserController::class, 'show']);
    Route::put('/users/me',[UserController::class, 'update']);
    Route::delete('/users/{userId}',[UserController::class, 'destroy']);

});

Route::post('/session/register', [SessionController::class, 'register']); // ユーザー登録
Route::post('/session', [SessionController::class, 'login']); // ログイン
Route::delete('/session', [SessionController::class, 'logout']); // ログアウト


