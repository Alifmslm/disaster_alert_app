<?php

namespace App\Services;

use App\Repositories\Contracts\EmergencyPlaceRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

class EmergencyPlaceService
{
    public function __construct(
        private readonly EmergencyPlaceRepositoryInterface $places,
        private readonly GeofenceService $geofence,
    ) {
    }

    public function paginate(array $filters = []): LengthAwarePaginator
    {
        return $this->places->paginateForIndex($filters);
    }

    public function mapData(array $filters = []): Collection
    {
        $items = $this->places->allForMap($filters);

        return $this->geofence->filterNearby(
            $items,
            isset($filters['latitude']) ? (float) $filters['latitude'] : null,
            isset($filters['longitude']) ? (float) $filters['longitude'] : null,
            isset($filters['radius_km']) ? (float) $filters['radius_km'] : null,
        );
    }

    public function find(int $id): object
    {
        $place = $this->places->findById($id);

        if (! $place) {
            throw new ModelNotFoundException('Lokasi darurat tidak ditemukan.');
        }

        return $place;
    }

    public function create(array $payload): object
    {
        $payload['status'] = $payload['status'] ?? 'active';

        return $this->places->createDraft($payload);
    }

    public function update(int $id, array $payload): object
    {
        return $this->places->updateDraft($id, $payload);
    }

    public function delete(int $id): void
    {
        $this->places->deleteDraft($id);
    }
}
