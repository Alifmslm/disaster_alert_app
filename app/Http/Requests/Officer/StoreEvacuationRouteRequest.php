<?php

namespace App\Http\Requests\Officer;

use Illuminate\Foundation\Http\FormRequest;

class StoreEvacuationRouteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'             => ['required', 'string', 'max:255'],
            'disaster_type'    => ['required', 'string', 'max:100'],
            'status'           => ['required', 'string', 'in:active,inactive'],
            'area'             => ['nullable', 'string', 'max:255'],
            'start_latitude'   => ['nullable', 'numeric', 'between:-90,90'],
            'start_longitude'  => ['nullable', 'numeric', 'between:-180,180'],
            'end_latitude'     => ['nullable', 'numeric', 'between:-90,90'],
            'end_longitude'    => ['nullable', 'numeric', 'between:-180,180'],
            'distance_km'      => ['nullable', 'numeric', 'min:0'],
            'description'      => ['nullable', 'string'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name'             => 'nama jalur',
            'disaster_type'    => 'tipe bencana',
            'status'           => 'status',
            'area'             => 'wilayah',
            'start_latitude'   => 'latitude titik awal',
            'start_longitude'  => 'longitude titik awal',
            'end_latitude'     => 'latitude titik akhir',
            'end_longitude'    => 'longitude titik akhir',
            'distance_km'      => 'jarak (km)',
            'description'      => 'deskripsi',
        ];
    }
}