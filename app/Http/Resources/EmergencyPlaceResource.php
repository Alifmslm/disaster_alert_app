<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmergencyPlaceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'address' => $this->address,
            'area' => $this->area,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'capacity' => $this->capacity,
            'contact' => $this->contact,
            'status' => $this->status,
            'metadata' => $this->metadata,
            'distance_km' => $this->when(isset($this->distance_from_user_km), fn () => $this->distance_from_user_km),
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
