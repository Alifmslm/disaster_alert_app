<?php

namespace App\Services;

use Illuminate\Support\Collection;

class GeofenceService
{
    public function distanceKm(?float $lat1, ?float $lng1, ?float $lat2, ?float $lng2): ?float
    {
        if ($lat1 === null || $lng1 === null || $lat2 === null || $lng2 === null) {
            return null;
        }

        $earthRadiusKm = 6371;
        $dLat = deg2rad($lat2 - $lat1);
        $dLng = deg2rad($lng2 - $lng1);

        $a = sin($dLat / 2) ** 2
            + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLng / 2) ** 2;

        return round($earthRadiusKm * 2 * atan2(sqrt($a), sqrt(1 - $a)), 2);
    }

    public function filterNearby(Collection $items, ?float $latitude, ?float $longitude, ?float $radiusKm = null, string $latKey = 'latitude', string $lngKey = 'longitude'): Collection
    {
        if ($latitude === null || $longitude === null) {
            return $items->values();
        }

        $radiusKm ??= (float) config('services.geofence.default_radius_km', 5);

        return $items
            ->map(function ($item) use ($latitude, $longitude, $latKey, $lngKey) {
                $distance = $this->distanceKm(
                    $latitude,
                    $longitude,
                    $item->{$latKey},
                    $item->{$lngKey},
                );

                $item->distance_from_user_km = $distance;

                return $item;
            })
            ->filter(fn ($item) => $item->distance_from_user_km === null || $item->distance_from_user_km <= $radiusKm)
            ->sortBy('distance_from_user_km')
            ->values();
    }

    public function handle(array $payload = []): array
    {
        return [
            'latitude' => $payload['latitude'] ?? null,
            'longitude' => $payload['longitude'] ?? null,
            'radius_km' => $payload['radius_km'] ?? config('services.geofence.default_radius_km', 5),
            'message' => 'Geofencing aktif. Kirim latitude, longitude, dan radius_km untuk filter data terdekat.',
        ];
    }
}
