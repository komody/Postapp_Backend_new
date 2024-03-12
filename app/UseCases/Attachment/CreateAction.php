<?php

namespace App\UseCases\Attachment;

use App\Models\Attachment;
use App\Http\Resources\AttachmentResource;


class CreateAction
{
    public function __invoke(Request $request)
    {
        $userId = Auth::id();

        $file = $request->file('file');

        $url = $request->file->storeAs('public/upload', Auth::id() . '.jpg');
        $preview_url = $request->file->storeAs('public/preview', Auth::id() . '.jpg');

        
        // ランダムな文字列でurlを生成するパターン
        $url = $request->file->storeAs('public/upload', Auth::id() . 'Str::random(40)');
        $preview_url = $request->file->storeAs('public/preview', Auth::id() . 'Str::random(40)');
        // $file_hash_id = hash("sha256", uniqid(rand(), true));

        $attachment = new Attachment([
            'type' => 'type',
            'url' => 'url',
            'preview_url' => 'preview_url',
            'description' => $request->input('description'),
        ]);

        $attachment->save();

        try {
            return $attachment;
        
        } catch (\Throwable $e) {
            \DB::rollback();
            // それ以外のエラーは想定外なのでログに残す
            \Log::error($e);
            
            // フロントに異常を通知するため例外はそのまま投げる
            throw $e;
        }
    }
}