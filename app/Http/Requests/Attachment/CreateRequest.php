<?php

namespace App\Http\Requests\Attachment;

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
            //
            'description' => ['required', 'string', 'max:160'],
        ];
    }

    public function messages(): array
    {
        return [
            'description.max' => '画像の説明は160文字以内で入力してください',
        ];
    }
}
