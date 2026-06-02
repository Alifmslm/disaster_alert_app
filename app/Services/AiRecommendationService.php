<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AiRecommendationService
{
    public function responsive(array $context = []): array
    {
        $type = $context['type'] ?? $context['disaster_type'] ?? 'other';
        $location = $context['location_name'] ?? 'lokasi tidak diketahui';
        
        $prompt = "Berikan 3 rekomendasi tindakan tanggap darurat (responsif) yang singkat dan jelas untuk masyarakat yang sedang menghadapi bencana {$type} di {$location}. Jawab HANYA dalam bentuk array JSON string (tanpa backtick atau teks lain). Contoh: [\"Tindakan 1\", \"Tindakan 2\", \"Tindakan 3\"]";

        $recommendations = $this->fetchFromLlm($prompt, $type, 'responsive');

        return [
            'type' => $type,
            'mode' => 'responsive',
            'recommendations' => $recommendations,
            'source' => config('services.ai_recommendation.driver', 'placeholder'),
        ];
    }

    public function preventive(array $context = []): array
    {
        $type = $context['type'] ?? $context['disaster_type'] ?? 'other';
        $location = $context['location_name'] ?? 'lokasi sekitar';

        $prompt = "Berikan 3 rekomendasi tindakan pencegahan (preventif) yang singkat dan jelas untuk masyarakat guna mengantisipasi bencana {$type} di kawasan {$location}. Jawab HANYA dalam bentuk array JSON string (tanpa backtick atau teks lain). Contoh: [\"Tindakan 1\", \"Tindakan 2\", \"Tindakan 3\"]";

        $recommendations = $this->fetchFromLlm($prompt, $type, 'preventive');

        return [
            'type' => $type,
            'mode' => 'preventive',
            'recommendations' => $recommendations,
            'source' => config('services.ai_recommendation.driver', 'placeholder'),
        ];
    }

    public function handle(array $payload = []): array
    {
        $mode = $payload['mode'] ?? 'responsive';

        return $mode === 'preventive'
            ? $this->preventive($payload)
            : $this->responsive($payload);
    }

    private function fetchFromLlm(string $prompt, string $type, string $mode): array
    {
        // Cache hasil rekomendasi berdasarkan tipe bencana dan mode (preventif/responsif)
        // untuk menghemat token API dan mencegah blocking
        $cacheKey = "ai_recommendation_{$mode}_{$type}";

        return Cache::remember($cacheKey, now()->addHours(24), function () use ($prompt, $type, $mode) {
            $driver = config('services.ai_recommendation.driver', 'placeholder');
            $apiKey = config('services.ai_recommendation.api_key');
            $baseUrl = config('services.ai_recommendation.base_url', 'https://api.openai.com/v1');

            if ($driver === 'placeholder' || empty($apiKey)) {
                return $this->getFallbackRecommendations($type, $mode);
            }

            try {
                $response = Http::withToken($apiKey)
                    ->timeout(10)
                    ->post(rtrim($baseUrl, '/') . '/chat/completions', [
                        'model' => 'gpt-3.5-turbo', // Model default
                        'messages' => [
                            ['role' => 'system', 'content' => 'Anda adalah asisten ahli mitigasi bencana BMKG/BAZARNAS yang memberikan panduan evakuasi dan pencegahan bencana dalam bahasa Indonesia.'],
                            ['role' => 'user', 'content' => $prompt],
                        ],
                        'temperature' => 0.3, // Lebih deterministik
                    ]);

                if ($response->successful()) {
                    $content = $response->json('choices.0.message.content');
                    // Hapus format backtick JSON jika LLM masih menambahkannya
                    $content = str_replace(['```json', '```'], '', $content);
                    $decoded = json_decode(trim($content), true);

                    if (is_array($decoded) && count($decoded) > 0) {
                        return $decoded;
                    }
                }
                
                Log::warning('LLM API response failed or invalid JSON format', ['response' => $response->body()]);
            } catch (\Exception $e) {
                Log::error("LLM API request error: " . $e->getMessage());
            }

            // Fallback ke rekomendasi statis jika API LLM gagal atau timeout
            return $this->getFallbackRecommendations($type, $mode);
        });
    }

    private function getFallbackRecommendations(string $type, string $mode): array
    {
        if ($mode === 'preventive') {
            $recommendations = [
                'flood' => ['Bersihkan drainase.', 'Siapkan tas darurat.', 'Pantau ketinggian air dan info BMKG.'],
                'earthquake' => ['Amankan lemari dan barang berat.', 'Kenali titik kumpul.', 'Latih prosedur drop, cover, hold on.'],
                'landslide' => ['Periksa retakan tanah.', 'Hindari pembangunan di lereng curam.', 'Tanam vegetasi penguat lereng.'],
                'fire' => ['Periksa instalasi listrik.', 'Simpan APAR di lokasi mudah dijangkau.', 'Jangan membakar sampah dekat permukiman.'],
                'tsunami' => ['Hafalkan jalur evakuasi.', 'Kenali rambu zona rawan.', 'Ikuti simulasi evakuasi berkala.'],
                'volcano' => ['Siapkan masker dan kacamata.', 'Pantau status gunung api.', 'Pahami zona KRB.'],
                'other' => ['Simpan kontak darurat.', 'Siapkan logistik 72 jam.', 'Ikuti informasi resmi pemerintah.'],
            ];
        } else {
            $recommendations = [
                'flood' => ['Matikan aliran listrik.', 'Pindah ke tempat lebih tinggi.', 'Ikuti jalur evakuasi resmi.'],
                'earthquake' => ['Lindungi kepala.', 'Keluar dari bangunan setelah guncangan berhenti.', 'Jauhi kaca, tiang, dan bangunan retak.'],
                'landslide' => ['Jauhi lereng dan aliran sungai.', 'Evakuasi ke titik kumpul aman.', 'Laporkan retakan tanah baru ke petugas.'],
                'fire' => ['Jauhi sumber api dan asap.', 'Gunakan kain basah untuk menutup hidung.', 'Hubungi posko atau pemadam setempat.'],
                'tsunami' => ['Segera menuju tempat tinggi.', 'Jauhi pantai dan muara.', 'Ikuti sirene/peringatan resmi.'],
                'volcano' => ['Gunakan masker.', 'Jauhi zona bahaya.', 'Ikuti instruksi evakuasi dari petugas.'],
                'other' => ['Tetap tenang.', 'Cari informasi resmi.', 'Laporkan kondisi darurat dengan lokasi yang jelas.'],
            ];
        }

        return $recommendations[$type] ?? $recommendations['other'];
    }
}
