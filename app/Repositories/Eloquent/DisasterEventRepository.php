<?php

namespace App\Repositories\Eloquent;

use App\Models\DisasterEvent;
use App\Repositories\Contracts\DisasterEventRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class DisasterEventRepository implements DisasterEventRepositoryInterface
{
    public function paginateForIndex(array $filters = []): LengthAwarePaginator
    {
        return $this->queryWithFilters($filters)
            ->withCount('reports')
            ->latest('occurred_at')
            ->latest('id')
            ->paginate(min((int) ($filters['per_page'] ?? 15), 100));
    }

    public function active(array $filters = []): Collection
    {
        return $this->queryWithFilters($filters)
            ->whereIn('status', ['watch', 'alert', 'emergency'])
            ->latest('occurred_at')
            ->limit((int) ($filters['limit'] ?? 10))
            ->get();
    }

    public function findById(int $id): ?object
    {
        return DisasterEvent::query()->withCount('reports')->find($id);
    }

    public function create(array $payload): object
    {
        return DisasterEvent::query()->create($payload);
    }

    private function queryWithFilters(array $filters): Builder
    {
        return DisasterEvent::query()
            ->when($filters['type'] ?? null, fn (Builder $query, string $type) => $query->where('type', $type))
            ->when($filters['status'] ?? null, fn (Builder $query, string $status) => $query->where('status', $status))
            ->when($filters['source'] ?? null, fn (Builder $query, string $source) => $query->where('source', $source))
            ->when($filters['area'] ?? null, fn (Builder $query, string $area) => $query->where('location_name', 'like', "%{$area}%"))
            ->when($filters['search'] ?? null, function (Builder $query, string $search): void {
                $query->where(function (Builder $subQuery) use ($search): void {
                    $subQuery->where('title', 'like', "%{$search}%")
                        ->orWhere('summary', 'like', "%{$search}%")
                        ->orWhere('location_name', 'like', "%{$search}%");
                });
            });
    }
}
