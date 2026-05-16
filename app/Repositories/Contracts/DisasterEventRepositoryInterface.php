<?php

namespace App\Repositories\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface DisasterEventRepositoryInterface
{
    public function paginateForIndex(array $filters = []): LengthAwarePaginator;

    public function active(array $filters = []): Collection;

    public function findById(int $id): ?object;

    public function create(array $payload): object;
}
