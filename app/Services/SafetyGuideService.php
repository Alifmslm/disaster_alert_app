<?php

namespace App\Services;

use App\Repositories\Contracts\SafetyGuideRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SafetyGuideService
{
    public function __construct(private readonly SafetyGuideRepositoryInterface $guides)
    {
    }

    public function paginate(array $filters = []): LengthAwarePaginator
    {
        return $this->guides->paginateForIndex($filters);
    }

    public function find(int $id): object
    {
        $guide = $this->guides->findById($id);

        if (! $guide) {
            throw new ModelNotFoundException('Panduan aman tidak ditemukan.');
        }

        return $guide;
    }
}
