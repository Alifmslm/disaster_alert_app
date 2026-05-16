# Setup Disaster Alert App

Project ini memakai Laravel 12, SQLite untuk development, Vite, dan Tailwind CSS.

## Requirement

Pastikan perangkat memiliki:

- PHP >= 8.2
- Composer
- Node.js dan NPM
- Ekstensi PHP: `pdo_sqlite`, `mbstring`, `xml`, `dom`, `fileinfo`, `openssl`
- Git

Untuk cek ekstensi:

```bash
php -m
```

## 1. Masuk ke folder project

```bash
cd disaster_alert_app
```

## 2. Install dependency backend

```bash
composer install
```

## 3. Setup environment

Windows:

```bash
copy .env.example .env
```

Linux / MacOS:

```bash
cp .env.example .env
```

## 4. Generate application key

```bash
php artisan key:generate
```

## 5. Setup database SQLite

Buat file database jika belum ada:

Windows PowerShell:

```powershell
New-Item -ItemType File database/database.sqlite -Force
```

Linux / MacOS:

```bash
touch database/database.sqlite
```

Pastikan `.env` memakai:

```env
DB_CONNECTION=sqlite
```

## 6. Jalankan migration dan seeder

```bash
php artisan migrate:fresh --seed
php artisan storage:link
```

`storage:link` diperlukan agar URL foto laporan bisa diakses dari folder `public/storage`.

Seeder akan membuat data demo: user, petugas, bencana aktif, laporan, jalur evakuasi, shelter, fasilitas kesehatan, panduan aman, dan catatan penanggulangan.

Akun demo:

```text
User:
email: user@siaga.test
password: password

Petugas:
email: petugas@siaga.test
password: password
```

## 7. Jalankan backend Laravel

```bash
php artisan serve
```

Backend berjalan di:

```text
http://127.0.0.1:8000
```

API base URL:

```text
http://127.0.0.1:8000/api/v1
```

## 8. Install dependency frontend

```bash
npm install
```

## 9. Jalankan Vite

Buka terminal baru:

```bash
npm run dev
```

## Endpoint cepat untuk pengecekan

```bash
curl http://127.0.0.1:8000/api/v1/user/home
curl "http://127.0.0.1:8000/api/v1/user/peta-evakuasi?latitude=-6.1517&longitude=106.7379&radius_km=5"
curl http://127.0.0.1:8000/api/v1/petugas/dashboard
curl http://127.0.0.1:8000/api/v1/integrations/bmkg/status
```

Contoh membuat laporan:

```bash
curl -X POST http://127.0.0.1:8000/api/v1/user/laporan-bencana \
  -H "Accept: application/json" \
  -F "type=flood" \
  -F "occurred_at=2026-05-17 10:00:00" \
  -F "description=Air naik cepat di jalan utama dan warga mulai evakuasi." \
  -F "location_name=Cengkareng" \
  -F "latitude=-6.1517" \
  -F "longitude=106.7379"
```
