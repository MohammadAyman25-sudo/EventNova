<?php

namespace App\Http\Requests\Auth\Password;

use App\DTOs\Auth\Password\ResetPasswordRequestDTO;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class PasswordResetRequest extends FormRequest
{
    use WithData;
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
            'token' => 'required|string',
            'email' => 'required|email:strict,dns,spoof|string|lowercase|max:255',
            'password' => [
                'required',
                'confirmed',
                'string',
                Password::defaults(),
            ],
        ];
    }

    public function dataClass()
    {
        return ResetPasswordRequestDTO::class;
    }
}
