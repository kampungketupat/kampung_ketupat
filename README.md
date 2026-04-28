![Banner](https://capsule-render.vercel.app/api?type=waving&height=220&color=0:0f172a,100:0d9488&text=Kampung%20Ketupat%20Web&fontColor=ffffff&fontSize=42&fontAlignY=38&desc=PHP%20MVC%20-%20Admin%20Panel%20-%20Public%20Website&descAlignY=60)

# Kampung Ketupat Web

[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-8.0+-4479A1?logo=mysql&logoColor=white)](https://www.mysql.com/)
[![License](https://img.shields.io/badge/license-MIT-green.svg)](https://opensource.org/licenses/MIT)

Project ini adalah website Kampung Ketupat dengan arsitektur PHP MVC sederhana, terdiri dari:
- halaman publik (beranda, galeri, event, UMKM, kritik saran),
- panel admin untuk pengelolaan konten,
- skema database MySQL siap import.

## Daftar Isi

- [Ringkasan Proyek](#ringkasan-proyek)
- [Fitur Utama](#fitur-utama)
- [Stack Teknologi](#stack-teknologi)
- [Struktur Folder](#struktur-folder)
- [Quick Start](#quick-start)
- [Halaman Utama](#halaman-utama)
- [Keamanan](#keamanan)
- [Testing](#testing)
- [Catatan Pengembangan](#catatan-pengembangan)

## Ringkasan Proyek

Aplikasi ini dibangun untuk kebutuhan website profil dan manajemen konten Kampung Ketupat Warna Warni.
Fokus utamanya adalah:
- tampilan informasi wisata untuk pengunjung,
- dashboard admin untuk CRUD data,
- pengelolaan kritik dan saran dari user.

## Fitur Utama

- Public pages:
  - Beranda
  - Galeri
  - Event
  - UMKM
  - Kritik dan Saran
- Admin pages:
  - Login admin
  - Dashboard statistik
  - Kelola Galeri
  - Kelola Event
  - Kelola UMKM
  - Kelola Kritik Saran
- Upload gambar untuk konten admin.
- Proteksi CSRF pada request POST.
- Login throttle dasar untuk mengurangi brute-force.

## Stack Teknologi

- Backend: PHP (native MVC)
- Database: MySQL / MariaDB
- Frontend: HTML, CSS, JavaScript
- UI helper: Bootstrap Icons + SweetAlert
- Web server: Apache (Laragon / shared hosting)

## Struktur Folder

<details>
  <summary><strong>Click here to expand</strong></summary>

```text
kampung_ketupat/
|- app/
|  |- controllers/
|  |- core/
|  |- models/
|  `- views/
|- config/
|- database/
|- public/
|- routes/
|- storage/
|- .htaccess
|- kampung_ketupat.sql
`- README.md
```

</details>

Folder yang bisa diklik:
- [`app/`](app)
- [`config/database.php`](config/database.php)
- [`database/kampung_ketupat.sql`](database/kampung_ketupat.sql)
- [`kampung_ketupat.sql`](kampung_ketupat.sql)
- [`public/index.php`](public/index.php)
- [`routes/web.php`](routes/web.php)

## Quick Start

<details>
  <summary><strong>Click here to expand</strong></summary>

1. Clone repository

```bash
git clone https://github.com/kampungketupat/kampung_ketupat.git
cd kampung_ketupat
```

2. Import database

- Opsi 1 (disarankan, data terbaru): import `kampung_ketupat.sql` (root)
- Opsi 2 (template): import `database/kampung_ketupat.sql`

3. Jalankan lokal (Laragon PHP built-in)

```bash
C:\laragon\bin\php\php-8.2.30-nts-Win32-vs16-x64\php.exe -S 127.0.0.1:8088 -t public
```

4. Buka browser

- Public: `http://127.0.0.1:8088/`
- Admin login: `http://127.0.0.1:8088/admin/login`

</details>

## Halaman Utama

| Halaman        | Fungsi Utama                          |
| -------------- | ------------------------------------- |
| Beranda        | Ringkasan konten utama                |
| Galeri         | Menampilkan foto publik               |
| Event          | Menampilkan daftar event              |
| UMKM           | Menampilkan data UMKM                 |
| Kritik Saran   | Form masukan user                     |
| Admin Dashboard| Statistik dan pintasan manajemen      |

## Keamanan

Hardening yang sudah diterapkan:
- CSRF token untuk aksi POST.
- Session hardening + `session_regenerate_id` setelah login.
- Login throttle berbasis IP/username.
- Upload file validation (mime, image check, size limit).
- Route destruktif admin menggunakan POST.
- Logging keamanan ke `storage/logs`.
- Blok akses langsung file sensitif via `.htaccess`.

Catatan production:
- Gunakan kredensial database hosting (bukan default lokal).
- Gunakan password admin kuat sebelum publish.
- Pastikan `APP_ENV=production` saat deploy.

## Testing

Uji syntax PHP:

```bash
php -l public/index.php
php -l config/database.php
```

Uji endpoint utama:
- `/`
- `/admin/login`
- `/admin/dashboard` (setelah login)
- `/galeri`
- `/event`
- `/umkm`
- `/kritik-saran`

## Catatan Pengembangan

- Root SQL (`kampung_ketupat.sql`) adalah dump data terbaru.
- SQL root sudah disiapkan agar aman re-import (`DROP TABLE IF EXISTS`).
- Project aktif dikembangkan di branch kerja sebelum push ke `main`.
