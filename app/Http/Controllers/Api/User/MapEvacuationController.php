<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Concerns\RespondsWithApi;
use App\Http\Controllers\Controller;
use App\Http\Resources\EmergencyPlaceResource;
use App\Http\Resources\EvacuationRouteResource;
use App\Services\EmergencyPlaceService;
use App\Services\EvacuationRouteService;
use App\Services\GeofenceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MapEvacuationController extends Controller
{
    use RespondsWithApi;

    public function __construct(
        private readonly EvacuationRouteService $routes,
        private readonly EmergencyPlaceService $places,
        private readonly GeofenceService $geofence,
    ) {
    }

    public function index(Request $request): JsonResponse
    {
        $filters = $request->query();

        return $this->success([
            'routes' => EvacuationRouteResource::collection($this->routes->mapData($filters)),
            'shelters' => EmergencyPlaceResource::collection($this->places->mapData(array_merge($filters, [
                'type' => ['shelter', 'emergency_post'],
            ]))),
            'health_facilities' => EmergencyPlaceResource::collection($this->places->mapData(array_merge($filters, [
                'type' => ['health_facility', 'health_post'],
            ]))),
            'geofence' => $this->geofence->handle($filters),
        ], 'Data peta evakuasi berhasil diambil.');
    }

    public function routes(Request $request): JsonResponse
    {
        return $this->success(
            EvacuationRouteResource::collection($this->routes->mapData($request->query())),
            'Jalur evakuasi berhasil diambil.'
        );
    }

    public function shelters(Request $request): JsonResponse
    {
        return $this->success(
            EmergencyPlaceResource::collection($this->places->mapData(array_merge($request->query(), [
                'type' => ['shelter', 'emergency_post'],
            ]))),
            'Shelter dan posko berhasil diambil.'
        );
    }

    public function healthFacilities(Request $request): JsonResponse
    {
        return $this->success(
            EmergencyPlaceResource::collection($this->places->mapData(array_merge($request->query(), [
                'type' => ['health_facility', 'health_post'],
            ]))),
            'Fasilitas kesehatan berhasil diambil.'
        );
    }

    public function radius(Request $request): JsonResponse
    {
        return $this->success(
            $this->geofence->handle($request->query()),
            'Konfigurasi radius pantauan berhasil diambil.'
        );
    }
}
