<?php

namespace App\Http\Controllers\Api\Officer;

use App\Http\Controllers\Concerns\RespondsWithApi;
use App\Http\Controllers\Controller;
use App\Http\Requests\Officer\UpdateReportStatusRequest;
use App\Http\Resources\DisasterReportResource;
use App\Models\DisasterReport;
use App\Models\User;
use App\Services\DisasterReportService;
use App\Services\ReportVerificationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReportManagementController extends Controller
{
    use RespondsWithApi;

    public function __construct(
        private readonly DisasterReportService $reports,
        private readonly ReportVerificationService $verification,
    ) {
    }

    public function index(Request $request): JsonResponse
    {
        return $this->paginated(
            $this->reports->paginate($request->query()),
            DisasterReportResource::class,
            'Daftar laporan bencana berhasil diambil.'
        );
    }

    public function show(DisasterReport $report): JsonResponse
    {
        return $this->success(
            new DisasterReportResource($this->reports->find($report->id)),
            'Detail laporan bencana berhasil diambil.'
        );
    }

    public function updateStatus(UpdateReportStatusRequest $request, DisasterReport $report): JsonResponse
    {
        $payload = $request->validated();
        $payload['verified_by'] = $payload['verified_by'] ?? $request->user()?->id ?? User::query()->where('role', 'officer')->value('id');

        return $this->success(
            new DisasterReportResource($this->verification->updateStatus($report->id, $payload)),
            'Status laporan berhasil diperbarui.'
        );
    }
}
