<?php

namespace App\Http\Requests;

use App\DTOs\OnboardingDTO;
use App\Enums\Payment\PaymentMethodEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\WithData;

class OnboardingRequest extends FormRequest
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
            'method' => ['required', Rule::enum(PaymentMethodEnum::class)],
        ];
    }

    public function dataClass():string
    {
        return OnboardingDTO::class;
    }
}
