<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreFuelLogRequest extends FormRequest
{
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'odometer' => ['required', 'numeric', 'min:0', 'max:9999999', 'decimal:0,1'],
            'date' => ['required', 'date'],
            'liters' => ['required', 'numeric', 'gt:0'],
            'price_per_liter' => ['required', 'numeric', 'min:0'],
            'is_full_tank' => ['required', 'boolean'],
            'notes' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return[
            'odometer.required' => 'current odometer must be filled',
            'odometer.numeric' => 'odometer must be a number',
            'odometer.min' => 'odometer minimum value must greater than or equal to 0',
            'odometer.max' => 'odometer maximum value must not be greater than 9,9M km',
            'odometer.decimal' => 'max decimal length is 1',

            'date.required' => 'date must be filled',
            'date.date' => 'this field must be filled with date type',

            'liters.required' => 'this field must be filled',
            'liters.numeric' => 'this field must be a number',
            'liters.gt' => 'liters filled must be greater than 0',

            'price_per_liter.required' => 'price must be filled',
            'price_per_liter.numeric' => 'price must be a number',
            'price_per_liter.min' => 'price must be greater than or equal to 0',

            'is_full_tank.required' => 'this field must be filled',
            'is_full_tank.boolean' => 'the checkbox must be filled',
        ];
    }
}
