<?php

namespace App\Http\Requests\Officer;

use App\Enums\ReportStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateReportStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => ['required', 'string', Rule::in(array_column(ReportStatus::cases(), 'value'))],
            'note' => ['nullable', 'string'],
            'verified_by' => ['nullable', 'integer', 'exists:users,id'],
        ];
    }
}
