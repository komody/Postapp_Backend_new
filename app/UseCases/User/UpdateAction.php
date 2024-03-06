<?php

namespace App\UseCases\User;

use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class UpdateAction
{
    public function __invoke(int $userId, string $name, string $introduction, int $icon_attachment_id)
    {
        $user = User::find($userId);
        $user->update([
            'name'=>$name, 
            'introduction'=>$introduction, 
            'icon_attachment_id'=>$icon_attachment_id
        ]);

        try {
            return $user;

        } catch (ModelNotFoundException $e) {
            // データが見つからなかっただけならロギング不要
            throw $e;
        } catch (\Throwable $e) {
            // 例外が起きたらロールバックを行う
            \DB::rollback();

            // 失敗した原因をログに残す
            \Log::error($e);

            // フロントにエラーを通知
            throw $e;
        }
    }
}