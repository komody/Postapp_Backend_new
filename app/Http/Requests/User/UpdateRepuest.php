<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
              'name' => ['nullable', 'string', 'min:4', 'max:16'],
              'email' => ['nullable', 'email'],
              'password' => ['nullable', 'string', 'min:8'],
              'introduction' => ['nullable', 'string', 'max:160'],
              'icon_attachment_id' => ['nullable', 'integer'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.min' => 'ユーザー名は4文字以上で入力してください',
            'title.max' => 'ユーザー名は16文字以内で入力してください',
            'password.email' => '有効なメールアドレスを入力してください',
            'password.min' => 'ユーザー名は8文字以上で入力してください',
            'introduction.max' => '自己紹介は160文字以内で入力してください',
        ];
    }

    //validationでエラーがでた時にjsonで返す。
    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'status' => 400, //jsonの返事の中身のエラー番号
            'errors' => $validator->errors(),
        ],400); //実際に送られるresponse codeが400番　これが無いと、jsonでエラーメッセージは返ってくるけど送れらてくるのは200番のstatusOKとくる。

        //例外を知らせる。
        //throw new 例外クラス名（例外message）
        throw new HttpResponseException($response);
    }
}
