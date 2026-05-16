<?php

namespace App\Services;

class AiRecommendationService
{
    public function responsive(array $context = []): array
    {
        $type = $context['type'] ?? $context['disaster_type'] ?? 'other';

        $recommendations = [
            'flood' => ['Matikan aliran listrik.', 'Pindah ke tempat lebih tinggi.', 'Ikuti jalur evakuasi resmi.'],
            'earthquake' => ['Lindungi kepala.', 'Keluar dari bangunan setelah guncangan berhenti.', 'Jauhi kaca, tiang, dan bangunan retak.'],
            'landslide' => ['Jauhi lereng dan aliran sungai.', 'Evakuasi ke titik kumpul aman.', 'Laporkan retakan tanah baru ke petugas.'],
            'fire' => ['Jauhi sumber api dan asap.', 'Gunakan kain basah untuk menutup hidung.', 'Hubungi posko atau pemadam setempat.'],
            'tsunami' => ['Segera menuju tempat tinggi.', 'Jauhi pantai dan muara.', 'Ikuti sirene/peringatan resmi.'],
            'volcano' => ['Gunakan masker.', 'Jauhi zona bahaya.', 'Ikuti instruksi evakuasi dari petugas.'],
            'other' => ['Tetap tenang.', 'Cari informasi resmi.', 'Laporkan kondisi darurat dengan lokasi yang jelas.'],
        ];

        return [
            'type' => $type,
            'mode' => 'responsive',
            'recommendations' => $recommendations[$type] ?? $recommendations['other'],
            'source' => config('services.ai_recommendation.driver', 'placeholder'),
        ];
    }

    public function preventive(array $context = []): array
    {
        $type = $context['type'] ?? $context['disaster_type'] ?? 'other';

        $recommendations = [
            'flood' => ['Bersihkan drainase.', 'Siapkan tas darurat.', 'Pantau ketinggian air dan info BMKG.'],
            'earthquake' => ['Amankan lemari dan barang berat.', 'Kenali titik kumpul.', 'Latih prosedur drop, cover, hold on.'],
            'landslide' => ['Periksa retakan tanah.', 'Hindari pembangunan di lereng curam.', 'Tanam vegetasi penguat lereng.'],
            'fire' => ['Periksa instalasi listrik.', 'Simpan APAR di lokasi mudah dijangkau.', 'Jangan membakar sampah dekat permukiman.'],
            'tsunami' => ['Hafalkan jalur evakuasi.', 'Kenali rambu zona rawan.', 'Ikuti simulasi evakuasi berkala.'],
            'volcano' => ['Siapkan masker dan kacamata.', 'Pantau status gunung api.', 'Pahami zona KRB.'],
            'other' => ['Simpan kontak darurat.', 'Siapkan logistik 72 jam.', 'Ikuti informasi resmi pemerintah.'],
        ];

        return [
            'type' => $type,
            'mode' => 'preventive',
            'recommendations' => $recommendations[$type] ?? $recommendations['other'],
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
}
