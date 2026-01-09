<?php

namespace App\Http\Requests\Auth\Registeration;

use App\DTOs\Auth\Register\RegisterationRequestDTO;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Spatie\LaravelData\WithData;

class RegisterRequest extends FormRequest
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
            'first_name' => 'required|regex:/^[a-zA-Z]+$/',
            'last_name' => 'required|regex:/^[a-zA-Z]+$/',
            'email' => 'required|email:strict,dns,spoof|string|lowercase|unique:users,email|max:255',
            'password' => [
                'required',
                Password::defaults(),
                'confirmed',
            ],
        ];
    }

    public function dataClass()
    {
        return RegisterationRequestDTO::class;
    }
}
