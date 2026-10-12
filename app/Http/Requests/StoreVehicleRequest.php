<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreVehicleRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'brand' => ['required', 'string', 'max:255'],
            'model' => ['required', 'string', 'max:255'],
            'year' => ['nullable', 'integer', 'min:1900'],
            'license_plate' => ['nullable', 'string', 'max:20'],
            'initial_odometer' => ['required', 'numeric', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'vehicle name is required.',
            'name.max' => 'maximum name length is 255.',

            'brand.required' => 'brand name is required.',
            'brand.max' => 'maximum brand name length is 255.',

            'year.integer' => 'year must be a number.',
            'year.min' => 'year must higher than 1900.',

            'license_plate.max' => 'license plate maximum character is 20.',

            'initial_odometer.required' => 'this field must be filled.',
            'initial_odometer.numeric' => 'this field must be a number.',
            'initial_odometer.min' => 'minimum initial cant be lower than 0.',
        ];
    }
}
