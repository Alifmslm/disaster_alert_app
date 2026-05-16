<?php

namespace App\Services;

use App\Models\DisasterEvent;
use App\Models\DisasterReport;
use App\Models\EmergencyPlace;
use App\Models\EvacuationRoute;
use App\Models\MitigationNote;

class DashboardService
{
    public function statistics(): array
    {
        return [
            'total_reports' => DisasterReport::query()->count(),
            'submitted_reports' => DisasterReport::query()->where('status', 'submitted')->count(),
            'verified_reports' => DisasterReport::query()->where('status', 'verified')->count(),
            'handled_reports' => DisasterReport::query()->where('status', 'handled')->count(),
            'active_events' => DisasterEvent::query()->whereIn('status', ['watch', 'alert', 'emergency'])->count(),
            'evacuation_routes' => EvacuationRoute::query()->where('status', 'active')->count(),
            'emergency_places' => EmergencyPlace::query()->where('status', 'active')->count(),
            'mitigation_notes' => MitigationNote::query()->count(),
        ];
    }

    public function map(): array
    {
        return [
            'events' => DisasterEvent::query()->whereIn('status', ['watch', 'alert', 'emergency'])->latest('id')->get(),
            'reports' => DisasterReport::query()->whereNotNull('latitude')->whereNotNull('longitude')->latest('id')->limit(50)->get(),
            'places' => EmergencyPlace::query()->where('status', 'active')->get(),
            'routes' => EvacuationRoute::query()->where('status', 'active')->get(),
        ];
    }

    public function feed(): array
    {
        return [
            'latest_reports' => DisasterReport::query()->with('user')->latest('id')->limit(10)->get(),
            'latest_events' => DisasterEvent::query()->latest('id')->limit(10)->get(),
            'latest_notes' => MitigationNote::query()->with('officer')->latest('id')->limit(10)->get(),
        ];
    }

    public function overview(): array
    {
        return [
            'statistics' => $this->statistics(),
            'feed' => $this->feed(),
        ];
    }
}
