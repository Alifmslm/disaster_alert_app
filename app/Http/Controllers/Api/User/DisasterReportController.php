<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Concerns\RespondsWithApi;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreDisasterReportRequest;
use App\Http\Resources\DisasterReportResource;
use App\Models\DisasterReport;
use App\Models\ReportAttachment;
use App\Models\User;
use App\Services\DisasterReportService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DisasterReportController extends Controller
{
    use RespondsWithApi;

    public function __construct(private readonly DisasterReportService $reports)
    {
    }

    public function index(Request $request): JsonResponse
    {
        return $this->paginated(
            $this->reports->paginate($request->query()),
            DisasterReportResource::class,
            'Daftar laporan bencana berhasil diambil.'
        );
    }

    public function preview(StoreDisasterReportRequest $request): JsonResponse
    {
        return $this->success(
            $this->reports->preview($request->validated()),
            'Preview laporan berhasil dibuat.'
        );
    }

    public function store(StoreDisasterReportRequest $request): JsonResponse
    {
        $payload = collect($request->validated())->except(['photos', 'photo_captions'])->all();
        $userId = $request->user()?->id ?? User::query()->where('role', 'user')->value('id');

        $report = $this->reports->create($payload, $userId);
        $captions = $request->input('photo_captions', []);

        foreach ($request->file('photos', []) as $index => $photo) {
            $path = $photo->store('reports', 'public');

            ReportAttachment::query()->create([
                'disaster_report_id' => $report->id,
                'file_path' => $path,
                'caption' => $captions[$index] ?? null,
                'mime_type' => $photo->getMimeType(),
                'size' => $photo->getSize(),
            ]);
        }

        return $this->success(
            new DisasterReportResource($this->reports->find($report->id)),
            'Laporan bencana berhasil dikirim.',
            201
        );
    }

    public function show(DisasterReport $report): JsonResponse
    {
        return $this->success(
            new DisasterReportResource($this->reports->find($report->id)),
            'Detail laporan bencana berhasil diambil.'
        );
    }
}
