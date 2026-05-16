<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'profile_photo_path' => ['nullable', 'string', 'max:255'],
            'alert_filter' => ['nullable', 'string', 'max:255'],
            'sound_enabled' => ['nullable', 'boolean'],
            'push_enabled' => ['nullable', 'boolean'],
            'email_enabled' => ['nullable', 'boolean'],
        ];
    }
}
