<?php

namespace App\Http\Controllers\Api\Officer;

use App\Http\Controllers\Concerns\RespondsWithApi;
use App\Http\Controllers\Controller;
use App\Http\Requests\Officer\StoreEvacuationRouteRequest;
use App\Http\Resources\EvacuationRouteResource;
use App\Models\EvacuationRoute;
use App\Services\EvacuationRouteService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EvacuationRouteManagementController extends Controller
{
    use RespondsWithApi;

    public function __construct(private readonly EvacuationRouteService $routes)
    {
    }

    public function index(Request $request): JsonResponse
    {
        return $this->paginated(
            $this->routes->paginate($request->query()),
            EvacuationRouteResource::class,
            'Daftar jalur evakuasi berhasil diambil.'
        );
    }

    public function store(StoreEvacuationRouteRequest $request): JsonResponse
    {
        return $this->success(
            new EvacuationRouteResource($this->routes->create($request->validated())),
            'Jalur evakuasi berhasil dibuat.',
            201
        );
    }

    public function show(EvacuationRoute $route): JsonResponse
    {
        return $this->success(
            new EvacuationRouteResource($this->routes->find($route->id)),
            'Detail jalur evakuasi berhasil diambil.'
        );
    }

    public function update(StoreEvacuationRouteRequest $request, EvacuationRoute $route): JsonResponse
    {
        return $this->success(
            new EvacuationRouteResource($this->routes->update($route->id, $request->validated())),
            'Jalur evakuasi berhasil diperbarui.'
        );
    }

    public function destroy(EvacuationRoute $route): JsonResponse
    {
        $this->routes->delete($route->id);

        return $this->success(null, 'Jalur evakuasi berhasil dihapus.');
    }
}
