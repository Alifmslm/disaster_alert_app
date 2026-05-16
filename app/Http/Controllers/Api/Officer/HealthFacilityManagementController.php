<?php

namespace App\Http\Controllers\Api\Officer;

use App\Http\Controllers\Concerns\RespondsWithApi;
use App\Http\Controllers\Controller;
use App\Http\Requests\Officer\StoreHealthFacilityRequest;
use App\Http\Resources\EmergencyPlaceResource;
use App\Models\EmergencyPlace;
use App\Services\EmergencyPlaceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HealthFacilityManagementController extends Controller
{
    use RespondsWithApi;

    public function __construct(private readonly EmergencyPlaceService $places)
    {
    }

    public function index(Request $request): JsonResponse
    {
        return $this->paginated(
            $this->places->paginate(array_merge($request->query(), ['type' => 'health_facility'])),
            EmergencyPlaceResource::class,
            'Daftar fasilitas kesehatan berhasil diambil.'
        );
    }

    public function store(StoreHealthFacilityRequest $request): JsonResponse
    {
        $payload = array_merge($request->validated(), ['type' => 'health_facility']);

        return $this->success(
            new EmergencyPlaceResource($this->places->create($payload)),
            'Fasilitas kesehatan berhasil dibuat.',
            201
        );
    }

    public function show(EmergencyPlace $facility): JsonResponse
    {
        return $this->success(
            new EmergencyPlaceResource($this->places->find($facility->id)),
            'Detail fasilitas kesehatan berhasil diambil.'
        );
    }

    public function update(StoreHealthFacilityRequest $request, EmergencyPlace $facility): JsonResponse
    {
        $payload = array_merge($request->validated(), ['type' => 'health_facility']);

        return $this->success(
            new EmergencyPlaceResource($this->places->update($facility->id, $payload)),
            'Fasilitas kesehatan berhasil diperbarui.'
        );
    }

    public function destroy(EmergencyPlace $facility): JsonResponse
    {
        $this->places->delete($facility->id);

        return $this->success(null, 'Fasilitas kesehatan berhasil dihapus.');
    }
}
