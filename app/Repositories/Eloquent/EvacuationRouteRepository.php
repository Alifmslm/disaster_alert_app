<?php

namespace App\Repositories\Eloquent;

use App\Models\EvacuationRoute;
use App\Repositories\Contracts\EvacuationRouteRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class EvacuationRouteRepository implements EvacuationRouteRepositoryInterface
{
    public function paginateForIndex(array $filters = []): LengthAwarePaginator
    {
        return $this->queryWithFilters($filters)
            ->latest('id')
            ->paginate(min((int) ($filters['per_page'] ?? 15), 100));
    }

    public function allForMap(array $filters = []): Collection
    {
        return $this->queryWithFilters($filters)
            ->where('status', $filters['status'] ?? 'active')
            ->get();
    }

    public function findById(int $id): ?object
    {
        return EvacuationRoute::query()->find($id);
    }

    public function createDraft(array $payload): object
    {
        return EvacuationRoute::query()->create($payload);
    }

    public function updateDraft(int $id, array $payload): object
    {
        $model = EvacuationRoute::query()->findOrFail($id);
        $model->fill($payload);
        $model->save();

        return $model;
    }

    public function deleteDraft(int $id): void
    {
        EvacuationRoute::query()->findOrFail($id)->delete();
    }

    private function queryWithFilters(array $filters): Builder
    {
        return EvacuationRoute::query()
            ->when($filters['disaster_type'] ?? ($filters['type'] ?? null), fn (Builder $query, string $type) => $query->where('disaster_type', $type))
            ->when($filters['status'] ?? null, fn (Builder $query, string $status) => $query->where('status', $status))
            ->when($filters['area'] ?? null, fn (Builder $query, string $area) => $query->where('area', 'like', "%{$area}%"))
            ->when($filters['search'] ?? null, function (Builder $query, string $search): void {
                $query->where(function (Builder $subQuery) use ($search): void {
                    $subQuery->where('name', 'like', "%{$search}%")
                        ->orWhere('area', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            });
    }
}
