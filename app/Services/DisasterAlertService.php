<?php

namespace App\Services;

use App\Models\DisasterEvent;
use App\Repositories\Contracts\DisasterEventRepositoryInterface;
use Illuminate\Support\Collection;

class DisasterAlertService
{
    public function __construct(private readonly DisasterEventRepositoryInterface $events)
    {
    }

    public function activeAlerts(array $filters = []): Collection
    {
        return $this->events->active($filters);
    }

    public function banner(array $filters = []): array
    {
        $event = $this->activeAlerts($filters)->first();

        if ($event instanceof DisasterEvent) {
            return [
                'visible' => true,
                'level' => $event->status,
                'title' => $event->title,
                'message' => $event->summary ?? 'Ada informasi bencana aktif di sekitar Anda.',
                'event_id' => $event->id,
            ];
        }

        return [
            'visible' => false,
            'level' => 'safe',
            'title' => 'Aman',
            'message' => 'Belum ada peringatan aktif.',
            'event_id' => null,
        ];
    }

    public function handle(array $payload = []): array
    {
        return [
            'banner' => $this->banner($payload),
            'active_events' => $this->activeAlerts($payload)->values(),
        ];
    }
}
