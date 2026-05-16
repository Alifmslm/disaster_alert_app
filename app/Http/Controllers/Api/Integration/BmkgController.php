<?php

namespace App\Http\Controllers\Api\Integration;

use App\Http\Controllers\Concerns\RespondsWithApi;
use App\Http\Controllers\Controller;
use App\Services\BmkgService;
use Illuminate\Http\JsonResponse;

class BmkgController extends Controller
{
    use RespondsWithApi;

    public function __construct(private readonly BmkgService $bmkg)
    {
    }

    public function status(): JsonResponse
    {
        return $this->success($this->bmkg->status(), 'Status integrasi BMKG berhasil diambil.');
    }

    public function latest(): JsonResponse
    {
        return $this->success($this->bmkg->latest(), 'Data terbaru BMKG berhasil diproses.');
    }

    public function sync(): JsonResponse
    {
        return $this->success($this->bmkg->sync(), 'Sinkronisasi BMKG selesai diproses.');
    }
}
