<?php

namespace App\Http\Controllers\Api\Officer;

use App\Http\Controllers\Concerns\RespondsWithApi;
use App\Http\Controllers\Controller;
use App\Http\Resources\DisasterEventResource;
use App\Http\Resources\DisasterReportResource;
use App\Http\Resources\EmergencyPlaceResource;
use App\Http\Resources\EvacuationRouteResource;
use App\Http\Resources\MitigationNoteResource;
use App\Services\BmkgService;
use App\Services\DashboardService;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    use RespondsWithApi;

    public function __construct(
        private readonly DashboardService $dashboard,
        private readonly BmkgService $bmkg,
    ) {
    }

    public function index(): JsonResponse
    {
        return $this->success([
            'overview' => $this->dashboard->overview(),
            'bmkg_status' => $this->bmkg->status(),
        ], 'Dashboard petugas berhasil diambil.');
    }

    public function statistics(): JsonResponse
    {
        return $this->success($this->dashboard->statistics(), 'Statistik dashboard berhasil diambil.');
    }

    public function map(): JsonResponse
    {
        $map = $this->dashboard->map();

        return $this->success([
            'events' => DisasterEventResource::collection($map['events']),
            'reports' => DisasterReportResource::collection($map['reports']),
            'places' => EmergencyPlaceResource::collection($map['places']),
            'routes' => EvacuationRouteResource::collection($map['routes']),
        ], 'Data peta monitoring berhasil diambil.');
    }

    public function feed(): JsonResponse
    {
        $feed = $this->dashboard->feed();

        return $this->success([
            'latest_reports' => DisasterReportResource::collection($feed['latest_reports']),
            'latest_events' => DisasterEventResource::collection($feed['latest_events']),
            'latest_notes' => MitigationNoteResource::collection($feed['latest_notes']),
        ], 'Feed informasi berhasil diambil.');
    }
}
