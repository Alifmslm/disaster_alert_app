<?php

namespace App\Repositories\Eloquent;

use App\Models\DisasterReport;
use App\Repositories\Contracts\DisasterReportRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class DisasterReportRepository implements DisasterReportRepositoryInterface
{
    public function paginateForIndex(array $filters = []): LengthAwarePaginator
    {
        return $this->queryWithFilters($filters)
            ->with(['user', 'disasterEvent', 'attachments'])
            ->latest('id')
            ->paginate(min((int) ($filters['per_page'] ?? 15), 100));
    }

    public function findById(int $id): ?object
    {
        return DisasterReport::query()
            ->with(['user', 'disasterEvent', 'attachments', 'verifier'])
            ->find($id);
    }

    public function createDraft(array $payload): object
    {
        return DisasterReport::query()->create($payload)->load(['user', 'disasterEvent', 'attachments']);
    }

    public function updateDraft(int $id, array $payload): object
    {
        $model = DisasterReport::query()->findOrFail($id);
        $model->fill($payload);
        $model->save();

        return $model->load(['user', 'disasterEvent', 'attachments', 'verifier']);
    }

    public function deleteDraft(int $id): void
    {
        DisasterReport::query()->findOrFail($id)->delete();
    }

    private function queryWithFilters(array $filters): Builder
    {
        return DisasterReport::query()
            ->when($filters['user_id'] ?? null, fn (Builder $query, int|string $userId) => $query->where('user_id', $userId))
            ->when($filters['type'] ?? null, fn (Builder $query, string $type) => $query->where('type', $type))
            ->when($filters['status'] ?? null, fn (Builder $query, string $status) => $query->where('status', $status))
            ->when($filters['area'] ?? null, fn (Builder $query, string $area) => $query->where('location_name', 'like', "%{$area}%"))
            ->when($filters['search'] ?? null, function (Builder $query, string $search): void {
                $query->where(function (Builder $subQuery) use ($search): void {
                    $subQuery->where('description', 'like', "%{$search}%")
                        ->orWhere('location_name', 'like', "%{$search}%")
                        ->orWhere('reporter_name', 'like', "%{$search}%");
                });
            });
    }
}
