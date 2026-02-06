<?php

namespace App\Http\Requests;

use App\DTOs\InterestsDTO;
use App\Enums\Notification\NotificationTypesEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\WithData;

class InterestsRequest extends FormRequest
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
            'interests' => 'required|array|min:3',
            'interests.*'=> 'string|exists:categories,id',
            'notifcation_preferences' => 'nullable|array',
            'notifcation_preferences.*' => ['nullable', 'numeric', Rule::enum(NotificationTypesEnum::class)]
        ];
    }

    public function messages()
    {
        return [
            'interests.required' => __("Please select at least 3 interest categories."),
            'interests.min' => __("Please select at least 3 interest categories."),
        ];
    }

    public function dataClass()
    {
        return InterestsDTO::class;
    }
}
