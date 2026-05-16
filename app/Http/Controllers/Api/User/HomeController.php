<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Concerns\RespondsWithApi;
use App\Http\Controllers\Controller;
use App\Http\Resources\DisasterEventResource;
use App\Http\Resources\DisasterReportResource;
use App\Models\DisasterReport;
use App\Services\AiRecommendationService;
use App\Services\DisasterAlertService;
use App\Services\EmergencyPlaceService;
use App\Services\EvacuationRouteService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use RespondsWithApi;

    public function __construct(
        private readonly DisasterAlertService $alerts,
        private readonly EvacuationRouteService $routes,
        private readonly EmergencyPlaceService $places,
        private readonly AiRecommendationService $ai,
    ) {
    }

    public function index(Request $request): JsonResponse
    {
        $filters = $request->query();

        return $this->success([
            'alert_banner' => $this->alerts->banner($filters),
            'active_disasters' => DisasterEventResource::collection($this->alerts->activeAlerts($filters)),
            'latest_reports' => DisasterReportResource::collection(
                DisasterReport::query()->with(['user', 'attachments'])->latest('id')->limit(5)->get()
            ),
            'recommendation' => $this->ai->responsive($filters),
        ], 'Data beranda berhasil diambil.');
    }

    public function activeDisasters(Request $request): JsonResponse
    {
        return $this->success(
            DisasterEventResource::collection($this->alerts->activeAlerts($request->query())),
            'Daftar bencana aktif berhasil diambil.'
        );
    }

    public function latestReports(): JsonResponse
    {
        return $this->success(
            DisasterReportResource::collection(
                DisasterReport::query()->with(['user', 'attachments'])->latest('id')->limit(5)->get()
            ),
            'Laporan terbaru berhasil diambil.'
        );
    }

    public function nearbyQuickActions(Request $request): JsonResponse
    {
        $filters = $request->query();

        return $this->success([
            'evacuation_routes' => $this->routes->mapData($filters)->take(3)->values(),
            'emergency_places' => $this->places->mapData($filters)->take(3)->values(),
        ], 'Quick action terdekat berhasil diambil.');
    }
}
