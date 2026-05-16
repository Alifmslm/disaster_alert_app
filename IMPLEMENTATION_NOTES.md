# Implementation Notes

Backend ini dibuat dari skeleton `disaster_alert_app` yang diunggah.

## Yang diubah

- Mengganti response placeholder API menjadi implementasi nyata.
- Menambahkan `RespondsWithApi` untuk format response konsisten.
- Melengkapi relasi dan casts pada model.
- Melengkapi API Resource agar field response rapi dan aman.
- Memperketat Form Request validation.
- Menambahkan repository untuk disaster event, safety guide, dan mitigation note.
- Melengkapi service layer:
  - `DisasterReportService`
  - `EvacuationRouteService`
  - `EmergencyPlaceService`
  - `MitigationNoteService`
  - `SafetyGuideService`
  - `DashboardService`
  - `GeofenceService`
  - `AiRecommendationService`
  - `BmkgService`
  - `DisasterAlertService`
  - `ReportVerificationService`
- Mengimplementasikan controller API untuk user, petugas, dan integration.
- Mengisi seeder demo agar database langsung punya data awal.
- Menyertakan `database/database.sqlite` demo.
- Memperbarui `README.md` dan `SETUP.md`.

## Verifikasi yang berhasil di environment ini

```bash
php -l
php artisan route:list --path=api/v1
```

Hasil route list: 59 route API terbaca.

## Verifikasi yang belum bisa dijalankan di environment ini

```bash
php artisan migrate:fresh --seed
php artisan test
```

Penyebab: PHP di environment ini tidak memiliki ekstensi `pdo_sqlite`, `mbstring`, `xml`, `dom`, dan `xmlwriter`.

Di lokal, aktifkan ekstensi tersebut dulu, lalu jalankan:

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
php artisan storage:link
php artisan serve
```
