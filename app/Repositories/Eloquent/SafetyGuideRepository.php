<?php

namespace App\Repositories\Eloquent;

use App\Models\SafetyGuide;
use App\Repositories\Contracts\SafetyGuideRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class SafetyGuideRepository implements SafetyGuideRepositoryInterface
{
    public function paginateForIndex(array $filters = []): LengthAwarePaginator
    {
        return SafetyGuide::query()
            ->where('is_published', true)
            ->when($filters['category'] ?? null, fn (Builder $query, string $category) => $query->where('category', $category))
            ->when($filters['disaster_type'] ?? ($filters['type'] ?? null), fn (Builder $query, string $type) => $query->where('disaster_type', $type))
            ->when($filters['search'] ?? null, function (Builder $query, string $search): void {
                $query->where(function (Builder $subQuery) use ($search): void {
                    $subQuery->where('title', 'like', "%{$search}%")
                        ->orWhere('content', 'like', "%{$search}%");
                });
            })
            ->latest('id')
            ->paginate(min((int) ($filters['per_page'] ?? 15), 100));
    }

    public function findById(int $id): ?object
    {
        return SafetyGuide::query()->where('is_published', true)->find($id);
    }
}
