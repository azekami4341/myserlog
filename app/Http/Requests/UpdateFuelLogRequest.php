<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateFuelLogRequest extends StoreFuelLogRequest
{
    public function rules(): array
    {
        // 1. Ambil semua aturan (rules) dari StoreFuelLogRequest
        $rules = parent::rules();

        // 2. Hapus aturan 'vehicle_id' karena form Edit tidak mengirimkan data ini
        unset($rules['vehicle_id']);

        // 3. Kembalikan aturan yang sudah disesuaikan
        return $rules;
    }
}