<?php

namespace App\Repositories\Eloquent;

use App\Models\MitigationNote;
use App\Repositories\Contracts\MitigationNoteRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class MitigationNoteRepository implements MitigationNoteRepositoryInterface
{
    public function paginateForIndex(array $filters = []): LengthAwarePaginator
    {
        return $this->queryWithFilters($filters)
            ->with('officer')
            ->latest('action_date')
            ->latest('id')
            ->paginate(min((int) ($filters['per_page'] ?? 15), 100));
    }

    public function findById(int $id): ?object
    {
        return MitigationNote::query()->with('officer')->find($id);
    }

    public function createDraft(array $payload): object
    {
        return MitigationNote::query()->create($payload)->load('officer');
    }

    public function updateDraft(int $id, array $payload): object
    {
        $model = MitigationNote::query()->findOrFail($id);
        $model->fill($payload);
        $model->save();

        return $model->load('officer');
    }

    public function deleteDraft(int $id): void
    {
        MitigationNote::query()->findOrFail($id)->delete();
    }

    private function queryWithFilters(array $filters): Builder
    {
        return MitigationNote::query()
            ->when($filters['disaster_type'] ?? ($filters['type'] ?? null), fn (Builder $query, string $type) => $query->where('disaster_type', $type))
            ->when($filters['affected_area'] ?? ($filters['area'] ?? null), fn (Builder $query, string $area) => $query->where('affected_area', 'like', "%{$area}%"))
            ->when($filters['search'] ?? null, function (Builder $query, string $search): void {
                $query->where(function (Builder $subQuery) use ($search): void {
                    $subQuery->where('title', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%")
                        ->orWhere('affected_area', 'like', "%{$search}%");
                });
            });
    }
}
