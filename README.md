# Sentinel Public Safety / Disaster Alert App

Backend Laravel 12 untuk aplikasi informasi, pelaporan, dan penanganan bencana. Versi ini sudah tidak lagi berupa skeleton kosong: endpoint API utama sudah diisi dengan service layer, repository layer, resource response, validasi request, relasi model, dan seed data demo.

## Stack

- Laravel `^12.0`
- PHP `^8.2`
- SQLite untuk development lokal
- Eloquent ORM
- MVC + Service Layer + Repository Layer
- Blade + Vite untuk halaman web yang sudah ada

## Fitur backend yang sudah diimplementasikan

### Masyarakat

- Beranda user dengan banner peringatan, bencana aktif, laporan terbaru, dan rekomendasi responsif.
- Peta evakuasi dengan jalur evakuasi, shelter/posko, fasilitas kesehatan, radius, dan hitung jarak geofencing.
- Laporan bencana: index, preview, store, show, validasi input, dan upload maksimal 3 foto.
- Panduan aman: artikel, berita, video, dan rekomendasi preventif.
- Profil: show, update, riwayat laporan, preferensi notifikasi, dan keamanan.

### Petugas

- Dashboard petugas: statistik, peta monitoring, dan feed.
- Kelola laporan bencana dan update status laporan.
- CRUD jalur evakuasi.
- CRUD shelter/posko.
- CRUD fasilitas kesehatan.
- CRUD catatan penanggulangan.
- Profil petugas, notifikasi internal, keamanan, dan bantuan/SOP.

### Integrasi

- Endpoint status/latest/sync BMKG dengan fallback saat jaringan atau endpoint BMKG tidak tersedia.
- Endpoint rekomendasi AI placeholder berbasis rule agar backend tetap bisa berjalan tanpa API key.

## Cara menjalankan

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
php artisan storage:link
php artisan serve
```

Untuk frontend asset:

```bash
npm install
npm run dev
```

Default API base URL:

```text
http://127.0.0.1:8000/api/v1
```

## Database

Default `.env.example` memakai SQLite:

```env
DB_CONNECTION=sqlite
# DB_DATABASE=/absolute/path/to/database/database.sqlite
```

File `database/database.sqlite` sudah disertakan sebagai database demo. Jika ingin reset dari migration dan seeder:

```bash
php artisan migrate:fresh --seed
```

Akun demo:

```text
User:
email: user@siaga.test
password: password

Petugas:
email: petugas@siaga.test
password: password
```

Catatan: authentication UI/API belum dipasang. Endpoint tetap dibuat berjalan dalam mode demo; jika belum ada user login, backend memakai user demo dari database.

## Contoh endpoint penting

```bash
GET  /api/v1/user/home
GET  /api/v1/user/peta-evakuasi?latitude=-6.1517&longitude=106.7379&radius_km=5
POST /api/v1/user/laporan-bencana/preview
POST /api/v1/user/laporan-bencana
GET  /api/v1/user/panduan-aman

GET   /api/v1/petugas/dashboard
GET   /api/v1/petugas/laporan-bencana
PATCH /api/v1/petugas/laporan-bencana/{report}/status
POST  /api/v1/petugas/jalur-evakuasi
POST  /api/v1/petugas/shelter-posko
POST  /api/v1/petugas/fasilitas-kesehatan
POST  /api/v1/petugas/catatan-penanggulangan

GET  /api/v1/integrations/bmkg/status
GET  /api/v1/integrations/bmkg/latest
POST /api/v1/integrations/ai/recommendation/responsive
POST /api/v1/integrations/ai/recommendation/preventive
```

## Format response API

Semua endpoint utama menggunakan format:

```json
{
  "success": true,
  "message": "Pesan hasil proses.",
  "data": {}
}
```

Collection paginated menambahkan:

```json
{
  "meta": {
    "pagination": {
      "current_page": 1,
      "last_page": 1,
      "per_page": 15,
      "total": 3
    }
  }
}
```

## Catatan verifikasi

Route API sudah berhasil dibaca dengan:

```bash
php artisan route:list --path=api/v1
```

Di environment ini, migrasi/test PHP tidak bisa dijalankan penuh karena ekstensi `pdo_sqlite`, `mbstring`, `xml`, dan `dom` tidak tersedia. Di komputer lokal, pastikan ekstensi berikut aktif:

```bash
php -m | grep -E "pdo_sqlite|mbstring|xml|dom"
```
