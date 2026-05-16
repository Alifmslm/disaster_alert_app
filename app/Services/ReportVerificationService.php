<?php

namespace App\Services;

use App\Enums\ReportStatus;
use App\Repositories\Contracts\DisasterReportRepositoryInterface;
use Illuminate\Support\Carbon;
use InvalidArgumentException;

class ReportVerificationService
{
    public function __construct(private readonly DisasterReportRepositoryInterface $reports)
    {
    }

    public function updateStatus(int $reportId, array $payload): object
    {
        $status = $payload['status'];

        if (! in_array($status, array_column(ReportStatus::cases(), 'value'), true)) {
            throw new InvalidArgumentException('Status laporan tidak valid.');
        }

        $data = ['status' => $status];

        if (in_array($status, [ReportStatus::Verified->value, ReportStatus::InProgress->value, ReportStatus::Handled->value], true)) {
            $data['verified_at'] = Carbon::now();
            $data['verified_by'] = $payload['verified_by'] ?? null;
        }

        return $this->reports->updateDraft($reportId, $data);
    }

    public function handle(array $payload = []): array
    {
        if (! isset($payload['report_id'])) {
            return ['message' => 'report_id wajib dikirim untuk verifikasi laporan.'];
        }

        return [
            'report' => $this->updateStatus((int) $payload['report_id'], $payload),
        ];
    }
}
