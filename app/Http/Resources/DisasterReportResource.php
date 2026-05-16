<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class DisasterReportResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'disaster_event_id' => $this->disaster_event_id,
            'type' => $this->type,
            'status' => $this->status,
            'location_name' => $this->location_name,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'occurred_at' => $this->occurred_at?->toISOString(),
            'description' => $this->description,
            'reporter_name' => $this->reporter_name,
            'reporter_phone' => $this->reporter_phone,
            'verified_by' => $this->verified_by,
            'verified_at' => $this->verified_at?->toISOString(),
            'reporter' => $this->whenLoaded('user', fn () => [
                'id' => $this->user?->id,
                'name' => $this->user?->name,
                'phone' => $this->user?->phone,
            ]),
            'event' => $this->whenLoaded('disasterEvent', fn () => new DisasterEventResource($this->disasterEvent)),
            'attachments' => $this->whenLoaded('attachments', fn () => $this->attachments->map(fn ($attachment) => [
                'id' => $attachment->id,
                'caption' => $attachment->caption,
                'mime_type' => $attachment->mime_type,
                'size' => $attachment->size,
                'file_path' => $attachment->file_path,
                'url' => Storage::disk('public')->url($attachment->file_path),
            ])->values()),
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
