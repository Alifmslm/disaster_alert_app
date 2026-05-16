<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Throwable;

class BmkgService
{
    public function status(): array
    {
        return [
            'base_url' => config('services.bmkg.base_url'),
            'configured' => filled(config('services.bmkg.base_url')),
            'api_key_configured' => filled(config('services.bmkg.api_key')),
            'mode' => 'public-endpoint-with-fallback',
        ];
    }

    public function latest(): array
    {
        try {
            $baseUrl = rtrim((string) config('services.bmkg.base_url'), '/');
            $response = Http::timeout(5)->acceptJson()->get($baseUrl.'/DataMKG/TEWS/autogempa.json');

            if ($response->successful()) {
                return [
                    'source' => 'bmkg',
                    'raw' => $response->json(),
                ];
            }

            return $this->fallback('BMKG mengembalikan status HTTP '.$response->status().'.');
        } catch (Throwable $exception) {
            return $this->fallback($exception->getMessage());
        }
    }

    public function sync(): array
    {
        $latest = $this->latest();

        return [
            'synced' => isset($latest['raw']),
            'message' => isset($latest['raw'])
                ? 'Data BMKG berhasil diambil. Mapping ke disaster_events bisa diproses dari payload raw.'
                : 'Sinkronisasi memakai fallback karena data BMKG tidak tersedia.',
            'data' => $latest,
        ];
    }

    public function handle(array $payload = []): array
    {
        return match ($payload['action'] ?? 'latest') {
            'status' => $this->status(),
            'sync' => $this->sync(),
            default => $this->latest(),
        };
    }

    private function fallback(string $reason): array
    {
        return [
            'source' => 'fallback',
            'reason' => $reason,
            'data' => [
                'title' => 'Data BMKG belum tersedia',
                'summary' => 'Endpoint tetap aktif. Periksa koneksi internet atau konfigurasi BMKG_BASE_URL.',
            ],
        ];
    }
}
