<?php

namespace App\Http\Requests;

use App\DTOs\UserRoleDTO;
use App\Enums\User\UserRoleEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\WithData;

class UserRoleRequest extends FormRequest
{

    use WithData;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return session()->has('pending_social_user');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'role' => [
                'string',
                'required',
                Rule::enum(UserRoleEnum::class)
            ]
        ];
    }

    public function messages()
    {
        $arr = [
            sprintf("role.%s", UserRoleEnum::class) => __("Invaild Role"),
        ];
        return $arr;
    }

    public function dataClass() 
    {
        return UserRoleDTO::class;
    }
}
