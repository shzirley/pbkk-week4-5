# PBKK Week 4 - AngelaOS

Mini-website akademik Angela Vania Sugiyono (NRP 5025241226) untuk tugas PBKK Pertemuan 4. Proyek ini menerapkan Blade layout inheritance, reusable Blade components, Tailwind CSS melalui NPM dan Vite, data dari controller, form tervalidasi, serta challenge query parameter.

## Fitur wajib Pertemuan 4

- Satu master layout `resources/views/layouts/app.blade.php` dengan title dinamis, navigasi, content container, dan footer ITS.
- Tiga halaman utama dikendalikan `PageController`:
  - `/` atau `/beranda` - beranda personal.
  - `/profil-mahasiswa` - profil akademik.
  - `/ide-agent` - visualisasi Agentic AI untuk ethical DAST dan form pengumpulan ide.
- Dua reusable component:
  - `<x-info-card>` menggunakan props, slot, dan merged attributes.
  - `<x-status-banner>` menggunakan props, default slot, named slot, dan merged attributes.
- Tailwind CSS dibangun secara lokal melalui Vite tanpa CDN frontend.
- `POST /ide-agent` menggunakan CSRF, server-side validation, old input, dan flash status. Data belum dipersistenkan karena database belum menjadi cakupan Pertemuan 4.
- Challenge:
  - `/ide-agent?mode=dark` mengaktifkan dynamic dark classes.
  - `/beranda?user=Andi` menampilkan sapaan dinamis yang tetap di-escape oleh Blade.

Fitur AngelaOS sebelumnya seperti project portfolio, achievements, resume, calculator, interactive theme, dan responsive dock tetap tersedia.

## Menjalankan aplikasi

Persyaratan:

- PHP 8.2+
- Composer
- Node.js 20+

```powershell
composer install
npm ci
Copy-Item .env.example .env
php artisan key:generate
npm run build
php artisan serve --host=127.0.0.1 --port=8012
```

Untuk pengembangan dengan Hot Module Replacement, jalankan `npm run dev` pada terminal terpisah.

## Validasi

```powershell
npm run build
php artisan test
php artisan route:list --except-vendor
php vendor/bin/pint --test app config routes tests bootstrap/app.php bootstrap/providers.php public/index.php
node --check resources/js/angela.js
```

Browser QA opsional:

```powershell
node tests/browser-check.cjs
```

## Struktur penting

- `app/Http/Controllers/PageController.php` - tiga halaman wajib dan validasi form ide.
- `resources/views/layouts/app.blade.php` - master layout.
- `resources/views/components/` - komponen info card dan status banner.
- `resources/views/idea-agent.blade.php` - ide Agentic AI, workflow, safety boundary, dan form.
- `resources/css/app.css` - entry CSS Vite/Tailwind dan gaya komponen.
- `resources/js/app.js` - entry JavaScript Vite.
- `tests/Feature/Pertemuan4Test.php` - coverage persyaratan Pertemuan 4.

## Catatan etika

Konsep DAST hanya ditujukan untuk sistem milik sendiri atau target yang memiliki izin eksplisit. Target demonstrasi yang disarankan adalah lab lokal seperti OWASP Juice Shop atau DVWA.
