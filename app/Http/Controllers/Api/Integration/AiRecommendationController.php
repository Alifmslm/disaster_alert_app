<?php

namespace App\Http\Controllers\Api\Integration;

use App\Http\Controllers\Concerns\RespondsWithApi;
use App\Http\Controllers\Controller;
use App\Services\AiRecommendationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AiRecommendationController extends Controller
{
    use RespondsWithApi;

    public function __construct(private readonly AiRecommendationService $ai)
    {
    }

    public function responsive(Request $request): JsonResponse
    {
        return $this->success(
            $this->ai->responsive($request->all()),
            'Rekomendasi responsif berhasil dibuat.'
        );
    }

    public function preventive(Request $request): JsonResponse
    {
        return $this->success(
            $this->ai->preventive($request->all()),
            'Rekomendasi preventif berhasil dibuat.'
        );
    }
}
