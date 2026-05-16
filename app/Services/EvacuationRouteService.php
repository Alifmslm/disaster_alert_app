<?php

namespace App\Services;

use App\Repositories\Contracts\EvacuationRouteRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

class EvacuationRouteService
{
    public function __construct(
        private readonly EvacuationRouteRepositoryInterface $routes,
        private readonly GeofenceService $geofence,
    ) {
    }

    public function paginate(array $filters = []): LengthAwarePaginator
    {
        return $this->routes->paginateForIndex($filters);
    }

    public function mapData(array $filters = []): Collection
    {
        $items = $this->routes->allForMap($filters);

        return $this->geofence->filterNearby(
            $items,
            isset($filters['latitude']) ? (float) $filters['latitude'] : null,
            isset($filters['longitude']) ? (float) $filters['longitude'] : null,
            isset($filters['radius_km']) ? (float) $filters['radius_km'] : null,
            'start_latitude',
            'start_longitude',
        );
    }

    public function find(int $id): object
    {
        $route = $this->routes->findById($id);

        if (! $route) {
            throw new ModelNotFoundException('Jalur evakuasi tidak ditemukan.');
        }

        return $route;
    }

    public function create(array $payload): object
    {
        $payload['status'] = $payload['status'] ?? 'active';

        return $this->routes->createDraft($payload);
    }

    public function update(int $id, array $payload): object
    {
        return $this->routes->updateDraft($id, $payload);
    }

    public function delete(int $id): void
    {
        $this->routes->deleteDraft($id);
    }
}
