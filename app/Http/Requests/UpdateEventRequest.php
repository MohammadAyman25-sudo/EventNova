<?php

namespace App\Http\Requests;

use App\Enums\Event\EventRefundPolicyEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('event'));
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'location' => 'nullable|array',
            'venue_name' => 'required|string',
            'venue_address' => 'nullable|required_without:online_link|string',
            'online_link' => 'nullable|required_without:venue_address|url',
            'capacity' => 'required|integer|min:5',
            'banner_image' => ['nullable', 'image', 'mimes:jpg,png,jpeg,webp', 'max:2048'],
            'refund_policy' => [
                'required',
                'integer',
                Rule::enum(EventRefundPolicyEnum::class),
            ],
            'refund_days_before' => 'nullable|integer',
            'refund_percentage' => 'required|integer|min:0|max:100',
            'allow_refund_after_start' => 'required|boolean',
        ];
    }
}
