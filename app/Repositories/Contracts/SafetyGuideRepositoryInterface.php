<?php

namespace App\Repositories\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface SafetyGuideRepositoryInterface
{
    public function paginateForIndex(array $filters = []): LengthAwarePaginator;

    public function findById(int $id): ?object;
}
