<?php

namespace App\Http\Controllers\Api\Officer;

use App\Http\Controllers\Concerns\RespondsWithApi;
use App\Http\Controllers\Controller;
use App\Http\Requests\Officer\StoreMitigationNoteRequest;
use App\Http\Resources\MitigationNoteResource;
use App\Models\MitigationNote;
use App\Models\User;
use App\Services\MitigationNoteService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MitigationNoteController extends Controller
{
    use RespondsWithApi;

    public function __construct(private readonly MitigationNoteService $notes)
    {
    }

    public function index(Request $request): JsonResponse
    {
        return $this->paginated(
            $this->notes->paginate($request->query()),
            MitigationNoteResource::class,
            'Daftar catatan penanggulangan berhasil diambil.'
        );
    }

    public function store(StoreMitigationNoteRequest $request): JsonResponse
    {
        $officerId = $request->user()?->id ?? User::query()->where('role', 'officer')->value('id');

        return $this->success(
            new MitigationNoteResource($this->notes->create($request->validated(), $officerId)),
            'Catatan penanggulangan berhasil dibuat.',
            201
        );
    }

    public function show(MitigationNote $note): JsonResponse
    {
        return $this->success(
            new MitigationNoteResource($this->notes->find($note->id)),
            'Detail catatan penanggulangan berhasil diambil.'
        );
    }

    public function update(StoreMitigationNoteRequest $request, MitigationNote $note): JsonResponse
    {
        return $this->success(
            new MitigationNoteResource($this->notes->update($note->id, $request->validated())),
            'Catatan penanggulangan berhasil diperbarui.'
        );
    }

    public function destroy(MitigationNote $note): JsonResponse
    {
        $this->notes->delete($note->id);

        return $this->success(null, 'Catatan penanggulangan berhasil dihapus.');
    }
}
