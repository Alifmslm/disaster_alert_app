<?php

namespace App\Services;

use App\Repositories\Contracts\MitigationNoteRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MitigationNoteService
{
    public function __construct(private readonly MitigationNoteRepositoryInterface $notes)
    {
    }

    public function paginate(array $filters = []): LengthAwarePaginator
    {
        return $this->notes->paginateForIndex($filters);
    }

    public function find(int $id): object
    {
        $note = $this->notes->findById($id);

        if (! $note) {
            throw new ModelNotFoundException('Catatan penanggulangan tidak ditemukan.');
        }

        return $note;
    }

    public function create(array $payload, ?int $officerId = null): object
    {
        $payload['officer_id'] = $officerId ?? ($payload['officer_id'] ?? null);

        return $this->notes->createDraft($payload);
    }

    public function update(int $id, array $payload): object
    {
        return $this->notes->updateDraft($id, $payload);
    }

    public function delete(int $id): void
    {
        $this->notes->deleteDraft($id);
    }
}
