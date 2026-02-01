<?php

namespace App\Http\Requests\Auth\Registeration;

use App\DTOs\Auth\Register\RegisterationRequestDTO;
use App\Enums\User\UserRoleEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
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
            'role' => [
                'string',
                'required',
                Rule::enum(UserRoleEnum::class)
            ],
            'password' => [
                'required',
                Password::defaults(),
                'confirmed',
            ],
        ];
    }

    public function messages()
    {
        $arr = [
            sprintf("role.%s", UserRoleEnum::class) => __("Invaild Role"),
            'first_name.regex' => __("First name must contain only letters"),
            'last_name.regex' => __("Last name must contain only letters"),
            'email.unique' => __("Email already exists"),
            'email.email' => __("Invalid email address"),
            'email.email:strict,dns,spoof' => __("Invalid email address"),
            'email.string' => __("Email must be a string"),
            'email.lowercase' => __("Email must be lowercase"),
            'email.max' => __("Email must be less than 255 characters"),
            'password.required' => __("Password is required"),
            'password.confirmed' => __("Password confirmation does not match"),
            'password.min' => __("Password must be at least 8 characters"),
            'password.letters' => __("Password must contain at least one letter"),
            'password.mixedCase' => __("Password must contain at least one uppercase and one lowercase letter"),
            'password.numbers' => __("Password must contain at least one number"),
            'password.symbols' => __("Password must contain at least one symbol"),
            'password.uncompromised' => __("Password must be unique"),
        ];
        return $arr;
    }

    public function dataClass()
    {
        return RegisterationRequestDTO::class;
    }
}
