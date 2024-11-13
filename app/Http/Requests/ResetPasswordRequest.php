<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use function PHPUnit\Framework\isTrue;

class ResetPasswordRequest extends FormRequest
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
            'password' => 'required',
            'password_confirmation' => 'required|same:password'
        ];
    }

    public function messages(): array
    {
        return [
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password_confirmation.same' => 'Mật khẩu xác nhận không khớp',
            'password_confirmation.required' => 'Vui lòng xác nhận mật khẩu',
        ];
    }
}
