<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'name' => 'required|string',
            'password' => 'required|min:8',
            'introduction' => 'required|string',
            'icon_attachment_id' => 'required|integer',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'お名前は入力必須です。',
            'password.required' => 'パスワードは入力必須です。',
            'password.min' => 'パスワードは少なくとも8文字以上である必要があります。',
            'introduction.required' => '自己紹介文は入力必須です。',
            'icon_attachment_id.required' => 'アイコン画像は必須です。',
        ];
    }
}