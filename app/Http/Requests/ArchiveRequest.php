<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArchiveRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'latitude' => ['required', 'decimal:0,6', 'min:-90', 'max:90'],
            'longitude' => ['required', 'decimal:0,6', 'min:-180', 'max:180'],
            // 'start_date' => ['required', 'date_format:Y-m-d'],
            // 'end_date' => ['nullable'],
            // 'daily' => ['required'],
            // 'wind_speed_unit' => ['required'],
        ];
    }

    public function attributes(): array
    {
        return [
            'latitude' => '«Широта»',
            'longitude' => '«Долгота»',
        ];
    }
}
