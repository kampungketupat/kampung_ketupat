![Banner](https://capsule-render.vercel.app/api?type=waving&height=220&color=0:0f172a,100:0d9488&text=Kampung%20Ketupat%20Web&fontColor=ffffff&fontSize=42&fontAlignY=38&desc=Public%20Website%20%C2%B7%20Admin%20Panel%20%C2%B7%20PHP%20MVC&descAlignY=60)

# Kampung Ketupat Web

[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-8.0+-4479A1?logo=mysql&logoColor=white)](https://www.mysql.com/)
[![License](https://img.shields.io/badge/license-MIT-green.svg)](https://opensource.org/licenses/MIT)

Project ini adalah website Kampung Ketupat dengan arsitektur PHP MVC sederhana untuk kebutuhan publikasi informasi wisata dan pengelolaan konten admin.

## 📑 Daftar Isi

- [🎯 Ringkasan Proyek](#-ringkasan-proyek)
- [✨ Fitur Utama](#-fitur-utama)
- [🛠️ Stack Teknologi](#️-stack-teknologi)
- [🗂️ Struktur Folder](#️-struktur-folder)
- [🚀 Quick Start](#-quick-start)
- [🧭 Halaman Website](#-halaman-website)
- [🔐 Fitur Keamanan](#-fitur-keamanan)
- [🧪 Testing](#-testing)

## 🎯 Ringkasan Proyek

Website ini menyediakan:
- Halaman publik (beranda, galeri, event, UMKM, kritik saran).
- Dashboard admin untuk CRUD konten.
- Integrasi database MySQL dengan skema siap import.

Fokus project:
- kemudahan pengelolaan konten wisata,
- antarmuka sederhana,
- hardening dasar untuk deployment publik.

## ✨ Fitur Utama

- Landing page dan navigasi publik.
- Halaman `Galeri`:
  - Menampilkan foto publik.
  - Kategori konten galeri.
- Halaman `Event`:
  - Menampilkan daftar event dan informasi detail.
  - Dukungan jadwal serta link informasi tambahan.
- Halaman `UMKM`:
  - Menampilkan data UMKM lokal.
  - Upload gambar dan pengelolaan data dari admin.
- Halaman `Kritik & Saran`:
  - Form masukan pengunjung.
  - Moderasi dan publikasi dari panel admin.
- Panel `Admin`:
  - Login + dashboard statistik.
  - CRUD Galeri, Event, UMKM, Kritik Saran.

## 🛠️ Stack Teknologi

- Language: PHP
- Database: MySQL
- Arsitektur: MVC sederhana (native PHP)
- Frontend: HTML, CSS, JavaScript
- UI Helper:
  - `Bootstrap Icons`
  - `SweetAlert`

## 🗂️ Struktur Folder

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

- [`app/core/`](app/core)
- [`app/controllers/`](app/controllers)
- [`config/database.php`](config/database.php)
- [`database/kampung_ketupat.sql`](database/kampung_ketupat.sql)
- [`kampung_ketupat.sql`](kampung_ketupat.sql)
- [`public/index.php`](public/index.php)
- [`routes/web.php`](routes/web.php)

## 🚀 Quick Start

<details>
  <summary><strong>Click here to expand</strong></summary>

1. Clone repository

```bash
git clone https://github.com/kampungketupat/kampung_ketupat.git
cd kampung_ketupat
```

2. Import database

- Untuk data terbaru: import file `kampung_ketupat.sql` (root).
- Alternatif template: `database/kampung_ketupat.sql`.

3. Jalankan aplikasi (local dev)

```bash
C:\laragon\bin\php\php-8.2.30-nts-Win32-vs16-x64\php.exe -S 127.0.0.1:8088 -t public
```

4. Akses di browser

```text
http://127.0.0.1:8088/
http://127.0.0.1:8088/admin/login
```

</details>

## 🧭 Halaman Website

| Halaman         | Data Utama                                | Fungsi |
| --------------- | ----------------------------------------- | ------ |
| `Beranda`       | Ringkasan konten utama                    | Landing informasi |
| `Galeri`        | Data foto publik + kategori               | Showcase visual |
| `Event`         | Jadwal event, status, jam, link info      | Informasi kegiatan |
| `UMKM`          | Data UMKM lokal                           | Promosi usaha lokal |
| `Kritik Saran`  | Input masukan pengunjung                  | Feedback pengguna |
| `Admin Panel`   | CRUD konten + statistik dashboard         | Manajemen website |

## 🔐 Fitur Keamanan

- CSRF protection pada endpoint POST.
- Session hardening + `session_regenerate_id`.
- Login throttle untuk mitigasi brute-force.
- Validasi upload file (mime, size, image check).
- Route destruktif admin memakai POST.
- Security logging ke `storage/logs`.
- Blok akses file/folder sensitif via `.htaccess`.

## 🧪 Testing

```bash
php -l public/index.php
php -l config/database.php
```

Smoke test endpoint:

```text
/
/admin/login
/admin/dashboard
/galeri
/event
/umkm
/kritik-saran
```

