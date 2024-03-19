<?php

namespace App\UseCases\Attachment;

use App\Models\Attachment;
use Illuminate\Http\Request;
use App\Http\Resources\AttachmentResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;



class CreateAction
{
    public function __invoke(Request $request)
    {
        $userId = Auth::id();
           
        $file = $request->file('url');
        $type = $file->extension();
        $path = $file->storePublicly('public/upload');    
        $url = Storage::url($path);

        $attachment = new Attachment([
            'type' => $type,
            'url' => $url,
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