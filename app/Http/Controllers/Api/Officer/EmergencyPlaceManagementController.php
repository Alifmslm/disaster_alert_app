<?php

namespace App\Http\Controllers\Api\Officer;

use App\Http\Controllers\Concerns\RespondsWithApi;
use App\Http\Controllers\Controller;
use App\Http\Requests\Officer\StoreEmergencyPlaceRequest;
use App\Http\Resources\EmergencyPlaceResource;
use App\Models\EmergencyPlace;
use App\Services\EmergencyPlaceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmergencyPlaceManagementController extends Controller
{
    use RespondsWithApi;

    public function __construct(private readonly EmergencyPlaceService $places)
    {
    }

    public function index(Request $request): JsonResponse
    {
        return $this->paginated(
            $this->places->paginate($request->query()),
            EmergencyPlaceResource::class,
            'Daftar shelter dan posko berhasil diambil.'
        );
    }

    public function store(StoreEmergencyPlaceRequest $request): JsonResponse
    {
        return $this->success(
            new EmergencyPlaceResource($this->places->create($request->validated())),
            'Shelter atau posko berhasil dibuat.',
            201
        );
    }

    public function show(EmergencyPlace $place): JsonResponse
    {
        return $this->success(
            new EmergencyPlaceResource($this->places->find($place->id)),
            'Detail shelter atau posko berhasil diambil.'
        );
    }

    public function update(StoreEmergencyPlaceRequest $request, EmergencyPlace $place): JsonResponse
    {
        return $this->success(
            new EmergencyPlaceResource($this->places->update($place->id, $request->validated())),
            'Shelter atau posko berhasil diperbarui.'
        );
    }

    public function destroy(EmergencyPlace $place): JsonResponse
    {
        $this->places->delete($place->id);

        return $this->success(null, 'Shelter atau posko berhasil dihapus.');
    }
}
