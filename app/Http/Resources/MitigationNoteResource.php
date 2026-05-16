<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MitigationNoteResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'officer_id' => $this->officer_id,
            'title' => $this->title,
            'disaster_type' => $this->disaster_type,
            'affected_area' => $this->affected_area,
            'action_date' => $this->action_date?->toDateString(),
            'description' => $this->description,
            'metadata' => $this->metadata,
            'officer' => $this->whenLoaded('officer', fn () => [
                'id' => $this->officer?->id,
                'name' => $this->officer?->name,
                'agency' => $this->officer?->agency,
            ]),
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
