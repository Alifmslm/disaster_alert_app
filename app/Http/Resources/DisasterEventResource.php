<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DisasterEventResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'status' => $this->status,
            'source' => $this->source,
            'title' => $this->title,
            'summary' => $this->summary,
            'location_name' => $this->location_name,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'occurred_at' => $this->occurred_at?->toISOString(),
            'resolved_at' => $this->resolved_at?->toISOString(),
            'metadata' => $this->metadata,
            'reports_count' => $this->whenCounted('reports'),
            'created_at' => $this->created_at?->toISOString(),
        ];
    }
}
