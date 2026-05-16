<?php

namespace App\Http\Requests\Officer;

use App\Enums\DisasterType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEvacuationRouteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'disaster_type' => ['required', 'string', Rule::in(array_column(DisasterType::cases(), 'value'))],
            'status' => ['nullable', 'string', Rule::in(['active', 'inactive', 'blocked', 'maintenance'])],
            'area' => ['required', 'string', 'max:255'],
            'start_latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'start_longitude' => ['nullable', 'numeric', 'between:-180,180'],
            'end_latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'end_longitude' => ['nullable', 'numeric', 'between:-180,180'],
            'distance_km' => ['nullable', 'numeric', 'min:0'],
            'description' => ['nullable', 'string'],
        ];
    }
}
