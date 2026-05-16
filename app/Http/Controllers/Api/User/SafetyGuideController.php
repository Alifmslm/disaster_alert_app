<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Concerns\RespondsWithApi;
use App\Http\Controllers\Controller;
use App\Http\Resources\SafetyGuideResource;
use App\Models\SafetyGuide;
use App\Services\AiRecommendationService;
use App\Services\SafetyGuideService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SafetyGuideController extends Controller
{
    use RespondsWithApi;

    public function __construct(
        private readonly SafetyGuideService $guides,
        private readonly AiRecommendationService $ai,
    ) {
    }

    public function index(Request $request): JsonResponse
    {
        return $this->paginated(
            $this->guides->paginate($request->query()),
            SafetyGuideResource::class,
            'Panduan aman berhasil diambil.'
        );
    }

    public function show(SafetyGuide $guide): JsonResponse
    {
        return $this->success(
            new SafetyGuideResource($this->guides->find($guide->id)),
            'Detail panduan aman berhasil diambil.'
        );
    }

    public function videos(Request $request): JsonResponse
    {
        return $this->paginated(
            $this->guides->paginate(array_merge($request->query(), ['category' => 'video'])),
            SafetyGuideResource::class,
            'Video panduan berhasil diambil.'
        );
    }

    public function news(Request $request): JsonResponse
    {
        return $this->success([
            'news' => SafetyGuideResource::collection(
                SafetyGuide::query()->where('is_published', true)->where('category', 'news')->latest('id')->limit(10)->get()
            ),
            'preventive_recommendation' => $this->ai->preventive($request->query()),
        ], 'Berita dan rekomendasi preventif berhasil diambil.');
    }
}
