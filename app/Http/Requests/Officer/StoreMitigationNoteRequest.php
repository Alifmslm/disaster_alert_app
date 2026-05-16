<?php

namespace App\Http\Requests\Officer;

use App\Enums\DisasterType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMitigationNoteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'disaster_type' => ['required', 'string', Rule::in(array_column(DisasterType::cases(), 'value'))],
            'affected_area' => ['required', 'string', 'max:255'],
            'action_date' => ['nullable', 'date'],
            'description' => ['required', 'string'],
            'metadata' => ['nullable', 'array'],
        ];
    }
}
