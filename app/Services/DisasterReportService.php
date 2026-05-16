<?php

namespace App\Services;

use App\Enums\ReportStatus;
use App\Repositories\Contracts\DisasterReportRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DisasterReportService
{
    public function __construct(private readonly DisasterReportRepositoryInterface $reports)
    {
    }

    public function paginate(array $filters = []): LengthAwarePaginator
    {
        return $this->reports->paginateForIndex($filters);
    }

    public function preview(array $payload): array
    {
        return [
            'type' => $payload['type'] ?? null,
            'location_name' => $payload['location_name'] ?? null,
            'occurred_at' => $payload['occurred_at'] ?? null,
            'description' => $payload['description'] ?? null,
            'coordinate' => [
                'latitude' => $payload['latitude'] ?? null,
                'longitude' => $payload['longitude'] ?? null,
            ],
            'initial_status' => ReportStatus::Submitted->value,
            'ready_to_submit' => filled($payload['type'] ?? null) && filled($payload['description'] ?? null),
        ];
    }

    public function create(array $payload, ?int $userId = null): object
    {
        $payload['user_id'] = $userId ?? ($payload['user_id'] ?? null);
        $payload['status'] = $payload['status'] ?? ReportStatus::Submitted->value;

        return $this->reports->createDraft($payload);
    }

    public function find(int $id): object
    {
        $report = $this->reports->findById($id);

        if (! $report) {
            throw new ModelNotFoundException('Laporan bencana tidak ditemukan.');
        }

        return $report;
    }
}
