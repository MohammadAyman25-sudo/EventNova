<?php

namespace App\Http\Requests;

use App\DTOs\Event\UpdateEventDTO;
use App\Enums\Event\EventRefundPolicyEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\WithData;

class UpdateEventRequest extends FormRequest
{
    use WithData;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'venue_name' => 'required|string',
            'online_link' => 'required_without:venue_address|url',
            'capacity'=>'required|integer|min:5',
            'banner_image' => 'required|image|mimes:jpg,png,jpeg,webp',
            'refund_policy' => [
                'required',
                'integer',
                Rule::enum(EventRefundPolicyEnum::class)
            ],
            'refund_days_before' => 'nullable|integer',
            'refund_percentage' => 'required|integer|min:0|max:100',
            'allow_refund_after_start' => 'required|boolean',
        ];
    }

    public function dataClass():string
    {
        return UpdateEventDTO::class;
    }
}
