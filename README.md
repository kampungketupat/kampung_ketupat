![Banner](https://capsule-render.vercel.app/api?type=waving&height=260&color=0:0f172a,50:065f46,100:0d9488&text=Kampung%20Ketupat%20Web&fontColor=ffffff&fontSize=46&fontAlignY=38&desc=Website%20Wisata%20%C2%B7%20Admin%20Panel%20%C2%B7%20PHP%20MVC%20%C2%B7%20MySQL&descAlignY=58&animation=fadeIn)

[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-8.0+-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Bootstrap Icons](https://img.shields.io/badge/Bootstrap_Icons-1.x-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)](https://icons.getbootstrap.com/)
[![SweetAlert2](https://img.shields.io/badge/SweetAlert2-latest-FF6B6B?style=for-the-badge)](https://sweetalert2.github.io/)
[![License](https://img.shields.io/badge/License-MIT-22c55e?style=for-the-badge)](https://opensource.org/licenses/MIT)
[![Status](https://img.shields.io/badge/Status-Live-0d9488?style=for-the-badge)](https://kampung-ketupat.infinityfree.me/)

---

### 🌐 Live Demo & Sumber Daya Proyek

| Sumber Daya | Tautan |
|---|---|
| 🌍 **Website Live** | [kampung-ketupat.infinityfree.me](https://kampung-ketupat.infinityfree.me/) |
| 📊 **Slide Presentasi (PPT)** | [Lihat di Canva](https://canva.link/54cr2ep7p6ouwdr) |
| 📄 **Laporan Proyek** | [Google Drive – Laporan](https://drive.google.com/drive/folders/1NnE_3vCfHOyXmjiId5lK8Y-TGkFcHNcU?usp=sharing) |
| 🎙️ **Drive Wawancara** | [Google Drive – Wawancara](https://drive.google.com/drive/folders/1nMXrLRJ-9rJV7JU9HYuCDG_3R1cVz6eg?usp=sharing) |
| 🗺️ **Flowchart (Draw.io)** | [Lihat Diagram Alur](https://drive.google.com/file/d/1xvJ7Z_Qhu0zfzCXTjoyFLHQ2VosqakOO/view?usp=drive_link) |

---

## 📑 Daftar Isi

- [🎯 Ringkasan Proyek](#-ringkasan-proyek)
- [✨ Fitur Utama](#-fitur-utama)
- [🛠️ Stack Teknologi](#️-stack-teknologi)
- [🗂️ Struktur Folder](#️-struktur-folder)
- [🗃️ Skema Database](#️-skema-database)
- [🔀 Daftar Route](#-daftar-route)
- [🧩 Arsitektur MVC](#-arsitektur-mvc)
- [🚀 Quick Start](#-quick-start)
- [🧭 Halaman Website](#-halaman-website)
- [🔐 Fitur Keamanan](#-fitur-keamanan)
- [📁 Asset & Frontend](#-asset--frontend)
- [⚙️ Konfigurasi Environment](#️-konfigurasi-environment)
- [🧪 Testing & Smoke Test](#-testing--smoke-test)
- [📌 Catatan Deployment](#-catatan-deployment)
- [📊 Sumber Daya Proyek](#-sumber-daya-proyek)
- [👥 Tim & Kontribusi](#-tim--kontribusi)

---

## 🎯 Ringkasan Proyek

**Kampung Ketupat Web** adalah sistem website wisata berbasis **PHP MVC native** yang dirancang untuk mempublikasikan informasi pariwisata, kegiatan lokal, UMKM, serta menyediakan kanal feedback (kritik & saran) bagi pengunjung. Proyek ini dikembangkan sebagai bagian dari program pengembangan digital kampung wisata lokal.

Website ini menyediakan dua lapisan utama:

- **Halaman Publik** — Dapat diakses siapa saja; menampilkan beranda, galeri foto, event, UMKM, lokasi, kontak, dan form kritik & saran.
- **Panel Admin** — Hanya bisa diakses setelah login; memiliki dashboard statistik dan kemampuan CRUD penuh untuk semua konten.

> **Tujuan Utama:** Membantu Kampung Ketupat dalam memiliki kehadiran digital yang representatif, mudah dikelola, dan aman — tanpa ketergantungan pada framework besar seperti Laravel atau CodeIgniter.

**Fokus pengembangan:**

- **Kemudahan pengelolaan konten wisata** — Admin non-teknis pun bisa mengelola konten.
- **Antarmuka bersih dan responsif** — Nyaman di perangkat mobile maupun desktop.
- **Hardening keamanan dasar** — Siap deploy ke hosting publik dengan perlindungan terhadap serangan umum.
- **Zero dependency berat** — Tidak memerlukan Composer, Node.js, atau framework eksternal.

---

## ✨ Fitur Utama

### 🌐 Halaman Publik

**🏠 Beranda (`/`)**

- Landing page dengan ringkasan konten utama: galeri terbaru, event mendatang, dan UMKM unggulan.
- Hero section informatif untuk menyambut pengunjung.

**🖼️ Galeri (`/galeri`)**

- Menampilkan koleksi foto publik kampung wisata.
- Foto dikelompokkan berdasarkan **kategori**: `wisata`, `kuliner`, `budaya`, `fasilitas`, `umum`.
- Hanya foto dengan status `is_publish = 1` yang ditampilkan ke publik.

**📅 Event (`/event`)**

- Menampilkan daftar kegiatan/event kampung lengkap dengan nama event, deskripsi, tanggal mulai & selesai, jam mulai & jam selesai, lokasi penyelenggaraan, status (`Akan Datang` / `Berlangsung` / `Selesai`), dan link informasi tambahan (opsional).

**🏪 UMKM (`/umkm`)**

- Direktori usaha mikro, kecil, dan menengah lokal.
- Setiap entri memiliki: nama usaha, nama pemilik, kategori, deskripsi, produk unggulan, kontak, dan alamat.
- Kategori tersedia: `kuliner`, `kerajinan`, `souvenir`, `jasa`, `lainnya`.
- Foto produk/usaha dapat diunggah dari panel admin.

**📍 Lokasi (`/lokasi`)**

- Halaman informasi lokasi dan peta kampung.

**📞 Kontak (`/kontak`)**

- Halaman informasi kontak pengelola kampung.

**💬 Kritik & Saran (`/kritik-saran`)**

- Form masukan pengunjung dengan field: nama pengunjung, alamat email, jenis pesan (`kritik` / `saran` / `pertanyaan` / `apresiasi`), dan isi pesan.
- Semua kiriman berstatus `pending` hingga dimoderasi admin.
- Admin dapat mengatur periode tampil publik melalui `tampil_mulai` dan `tampil_selesai`.

---

### 🔒 Panel Admin

**🔑 Autentikasi (`/admin/login`)**

- Login dengan username dan password (di-hash dengan `PASSWORD_DEFAULT` / bcrypt).
- Proteksi brute-force via **Login Throttle** (mencatat percobaan per IP & username).
- Logout menggunakan POST request (terlindungi CSRF).
- Session hardening dan regenerasi ID sesi setelah login berhasil.

**📊 Dashboard (`/admin/dashboard`)**

- Ringkasan statistik konten: jumlah foto galeri (total & terpublikasi), jumlah event (per status), jumlah UMKM, serta jumlah kritik & saran (pending, diterima, publik).

**🖼️ Manajemen Galeri (`/admin/galeri`)**

- **Tambah** foto baru — judul, deskripsi, kategori, dan upload file gambar.
- **Edit** data galeri yang sudah ada.
- **Hapus** foto — via POST request, terlindungi CSRF.
- **Toggle Publish** — aktifkan/nonaktifkan visibilitas foto satu per satu.
- **Publish All** — publikasikan semua foto sekaligus.

**📅 Manajemen Event (`/admin/event`)**

- **Tambah** event baru — nama, deskripsi, tanggal, jam, lokasi, status, link info, dan foto.
- **Edit** informasi event.
- **Hapus** event.
- Status event dikelola sebagai ENUM: `akan_datang`, `berlangsung`, `selesai`.

**🏪 Manajemen UMKM (`/admin/umkm`)**

- **Tambah** data UMKM baru dengan upload foto.
- **Edit** dan **Hapus** data UMKM.

**💬 Manajemen Kritik & Saran (`/admin/kritik-saran`)**

- Tampilkan daftar pesan berstatus `pending` atau `diterima`.
- **Terima** — ubah status ke `diterima`.
- **Kembalikan** — kembalikan ke status `pending`.
- **Tampilkan** — publikasikan pesan ke halaman publik (`publik`).
- **Sembunyikan** — tarik kembali dari tampilan publik.
- **Arsip** (`/admin/kritik-saran/arsip`) — riwayat pesan yang sudah diarsipkan.

---

## 🛠️ Stack Teknologi

| Kategori | Teknologi |
|---|---|
| **Backend Language** | PHP 8.2+ (native, tanpa framework) |
| **Database** | MySQL 8.0+ / MariaDB |
| **Arsitektur** | MVC (Model-View-Controller) custom, dibangun dari nol |
| **Frontend** | HTML5, CSS3 (custom), JavaScript Vanilla |
| **UI Icons** | [Bootstrap Icons](https://icons.getbootstrap.com/) |
| **Alert / Dialog** | [SweetAlert2](https://sweetalert2.github.io/) |
| **Web Server** | Apache (dengan `.htaccess` rewrite rules) |
| **File Upload** | Native PHP `$_FILES` dengan validasi MIME & ukuran |
| **Session** | PHP Session native dengan hardening |
| **Security** | CSRF token, Login Throttle, Security Logger |

---

## 🗂️ Struktur Folder

<details>
<summary><strong>📂 Klik untuk memperluas struktur folder lengkap</strong></summary>

```
kampung_ketupat/
|
+-- app/
|   |
|   +-- controllers/
|   |   +-- AdminController.php           -> Dashboard admin
|   |   +-- AdminEventController.php      -> CRUD event (admin)
|   |   +-- AdminGaleriController.php     -> CRUD galeri + toggle publish
|   |   +-- AdminKritikController.php     -> Moderasi kritik & saran
|   |   +-- AdminUMKMController.php       -> CRUD UMKM (admin)
|   |   +-- AuthController.php            -> Login & logout
|   |   +-- BerandaController.php         -> Halaman beranda
|   |   +-- EventController.php           -> Halaman event publik
|   |   +-- GaleriController.php          -> Halaman galeri publik
|   |   +-- KontakController.php          -> Halaman kontak
|   |   +-- KritikSaranController.php     -> Form & tampilan kritik saran publik
|   |   +-- LokasiController.php          -> Halaman lokasi
|   |   +-- UMKMController.php            -> Halaman UMKM publik
|   |   +-- WisataController.php          -> Halaman wisata
|   |
|   +-- core/
|   |   +-- Controller.php                -> Base controller (view loader)
|   |   +-- Csrf.php                      -> CSRF token generator & validator
|   |   +-- ErrorHandler.php              -> Global error & exception handler
|   |   +-- LoginThrottle.php             -> Rate limiter login (anti brute-force)
|   |   +-- Model.php                     -> Base model (koneksi DB)
|   |   +-- Router.php                    -> HTTP router (GET/POST dispatch)
|   |   +-- SecurityLogger.php            -> Pencatat kejadian keamanan
|   |
|   +-- helpers/
|   |   +-- upload.php                    -> Helper validasi & upload file gambar
|   |
|   +-- models/
|   |   +-- AdminModel.php                -> Query tabel admin
|   |   +-- EventModel.php                -> Query tabel event
|   |   +-- GaleriModel.php               -> Query tabel galeri
|   |   +-- KritikSaranModel.php          -> Query tabel kritik_saran
|   |   +-- UMKMModel.php                 -> Query tabel umkm
|   |
|   +-- views/
|       +-- admin/
|       |   +-- layouts/
|       |   |   +-- header.php
|       |   |   +-- footer.php
|       |   |   +-- main.php
|       |   +-- dashboard.php
|       |   +-- event/           (index.php, create.php, edit.php)
|       |   +-- galeri/          (index.php, create.php, edit.php)
|       |   +-- kritik_saran/    (index.php)
|       |   +-- umkm/            (index.php, create.php, edit.php)
|       |
|       +-- auth/
|       |   +-- login.php                 -> Halaman login admin
|       |
|       +-- user/
|           +-- layouts/
|           |   +-- header.php
|           |   +-- footer.php
|           +-- beranda/      (index.php)
|           +-- event/        (index.php)
|           +-- galeri/       (index.php)
|           +-- kontak/       (index.php)
|           +-- kritik_saran/ (index.php)
|           +-- errors/
|               +-- 404.php              -> Halaman 404 Not Found
|               +-- 500.php              -> Halaman 500 Server Error
|
+-- config/
|   +-- database.php                  -> Konfigurasi koneksi DB + auto-init schema
|
+-- database/
|   +-- kampung_ketupat.sql           -> Template skema SQL (tanpa data)
|
+-- public/
|   +-- index.php                     -> Front controller (entry point)
|   +-- .htaccess                     -> Rewrite rules & blokir akses sensitif
|   +-- assets/
|       +-- css/
|       |   +-- style.css                 -> Stylesheet halaman publik (~60 KB)
|       |   +-- admin.css                 -> Stylesheet panel admin (~42 KB)
|       +-- js/
|       |   +-- app.js                    -> Logic utama frontend (~30 KB)
|       |   +-- main.js                   -> Inisialisasi & event listener
|       |   +-- swal-helper.js            -> Helper SweetAlert2
|       +-- images/
|       |   +-- hero-ketupat.png          -> Gambar hero section beranda
|       +-- uploads/
|           +-- event/                    -> Upload foto event
|           +-- galeri/                   -> Upload foto galeri
|           +-- umkm/                     -> Upload foto UMKM
|
+-- routes/
|   +-- web.php                       -> Definisi semua route aplikasi
|
+-- storage/
|   +-- logs/                         -> File log keamanan
|
+-- .htaccess                         -> Redirect ke public/ & blokir akses root
+-- .gitignore
+-- index.php                         -> Redirect helper ke public/
+-- kampung_ketupat.sql               -> File SQL terbaru (dengan data aktual)
```

</details>

---

## 🗃️ Skema Database

Database `kampung_ketupat` terdiri dari **6 tabel** utama.

### Tabel `admin`

Menyimpan akun administrator yang dapat login ke panel admin.

```sql
CREATE TABLE admin (
    id            INT AUTO_INCREMENT PRIMARY KEY,
    username      VARCHAR(100) UNIQUE,
    password      VARCHAR(255),
    nama_lengkap  VARCHAR(150),
    created_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### Tabel `galeri`

Menyimpan data foto/gambar yang ditampilkan di halaman galeri publik.

```sql
CREATE TABLE galeri (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    judul       VARCHAR(200),
    deskripsi   TEXT,
    foto        VARCHAR(255),
    kategori    ENUM('wisata','kuliner','budaya','fasilitas','umum') DEFAULT 'umum',
    is_publish  TINYINT(1) NOT NULL DEFAULT 1,
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### Tabel `event`

Menyimpan informasi kegiatan/event kampung.

```sql
CREATE TABLE event (
    id              INT AUTO_INCREMENT PRIMARY KEY,
    nama_event      VARCHAR(200),
    deskripsi       TEXT,
    tanggal_mulai   DATE,
    tanggal_selesai DATE,
    lokasi          VARCHAR(255),
    foto            VARCHAR(255),
    status          ENUM('akan_datang','berlangsung','selesai') DEFAULT 'akan_datang',
    link_info       VARCHAR(255) NULL,
    jam_mulai       TIME NULL,
    jam_selesai     TIME NULL,
    created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### Tabel `umkm`

Menyimpan data usaha mikro kecil dan menengah lokal.

```sql
CREATE TABLE umkm (
    id               INT AUTO_INCREMENT PRIMARY KEY,
    nama_umkm        VARCHAR(200),
    pemilik          VARCHAR(150),
    kategori         ENUM('kuliner','kerajinan','souvenir','jasa','lainnya') DEFAULT 'lainnya',
    deskripsi        TEXT,
    produk_unggulan  VARCHAR(255),
    kontak           VARCHAR(100),
    alamat           VARCHAR(255),
    foto             VARCHAR(255),
    created_at       TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### Tabel `kritik_saran`

Menyimpan pesan masukan dari pengunjung beserta status moderasi.

```sql
CREATE TABLE kritik_saran (
    id               INT AUTO_INCREMENT PRIMARY KEY,
    nama_pengunjung  VARCHAR(150),
    email            VARCHAR(150),
    jenis            ENUM('kritik','saran','pertanyaan','apresiasi') DEFAULT 'saran',
    pesan            TEXT,
    sudah_dibaca     TINYINT(1) DEFAULT 0,
    status           ENUM('pending','diterima','publik') DEFAULT 'pending',
    tampil_mulai     DATE NULL,
    tampil_selesai   DATE NULL,
    created_at       TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### Tabel `auth_login_attempts`

Melacak percobaan login per IP untuk mekanisme throttle anti brute-force.

```sql
CREATE TABLE auth_login_attempts (
    id                INT AUTO_INCREMENT PRIMARY KEY,
    ip_address        VARCHAR(45) NOT NULL,
    username          VARCHAR(100) NOT NULL,
    attempts          INT NOT NULL DEFAULT 0,
    first_attempt_at  DATETIME NOT NULL,
    last_attempt_at   DATETIME NOT NULL,
    blocked_until     DATETIME NULL,
    UNIQUE KEY uniq_auth_attempt (ip_address, username),
    INDEX idx_blocked_until (blocked_until)
);
```

> **Auto Cleanup:** Data percobaan login lebih dari 2 hari otomatis dihapus setiap kali `config/database.php` dijalankan dalam mode `DB_AUTO_INIT=true`.

---

## 🔀 Daftar Route

Semua route didefinisikan di `routes/web.php` dan diproses oleh `Router.php`.

### Route Publik

| Method | Path | Controller@Method | Keterangan |
|---|---|---|---|
| GET | `/` | `BerandaController@index` | Halaman beranda |
| GET | `/wisata` | `WisataController@index` | Halaman wisata |
| GET | `/event` | `EventController@index` | Daftar event |
| GET | `/galeri` | `GaleriController@index` | Galeri foto |
| GET | `/umkm` | `UMKMController@index` | Direktori UMKM |
| GET | `/lokasi` | `LokasiController@index` | Informasi lokasi |
| GET | `/kontak` | `KontakController@index` | Halaman kontak |
| GET | `/kritik-saran` | `KritikSaranController@index` | Form kritik & saran |
| POST | `/kritik-saran` | `KritikSaranController@index` | Kirim pesan |

### Route Autentikasi Admin

| Method | Path | Controller@Method | Keterangan |
|---|---|---|---|
| GET | `/admin/login` | `AuthController@login` | Form login |
| POST | `/admin/login/proses` | `AuthController@proses` | Proses login |
| POST | `/admin/logout` | `AuthController@logout` | Logout (CSRF-protected) |

### Route Admin — Dashboard & Galeri

| Method | Path | Controller@Method | Keterangan |
|---|---|---|---|
| GET | `/admin/dashboard` | `AdminController@dashboard` | Dashboard statistik |
| GET | `/admin/galeri` | `AdminGaleriController@index` | Daftar galeri |
| GET | `/admin/galeri/create` | `AdminGaleriController@create` | Form tambah foto |
| POST | `/admin/galeri/store` | `AdminGaleriController@store` | Simpan foto baru |
| GET | `/admin/galeri/edit` | `AdminGaleriController@edit` | Form edit foto |
| POST | `/admin/galeri/update` | `AdminGaleriController@update` | Simpan perubahan |
| POST | `/admin/galeri/delete` | `AdminGaleriController@delete` | Hapus foto |
| POST | `/admin/galeri/togglePublish` | `AdminGaleriController@togglePublish` | Toggle publish satu foto |
| POST | `/admin/galeri/publishAll` | `AdminGaleriController@publishAll` | Publish semua foto |

### Route Admin — Event

| Method | Path | Controller@Method | Keterangan |
|---|---|---|---|
| GET | `/admin/event` | `AdminEventController@index` | Daftar event |
| GET | `/admin/event/create` | `AdminEventController@create` | Form tambah event |
| POST | `/admin/event/store` | `AdminEventController@store` | Simpan event baru |
| GET | `/admin/event/edit` | `AdminEventController@edit` | Form edit event |
| POST | `/admin/event/update` | `AdminEventController@update` | Simpan perubahan event |
| POST | `/admin/event/delete` | `AdminEventController@delete` | Hapus event |

### Route Admin — UMKM

| Method | Path | Controller@Method | Keterangan |
|---|---|---|---|
| GET | `/admin/umkm` | `AdminUMKMController@index` | Daftar UMKM |
| GET | `/admin/umkm/create` | `AdminUMKMController@create` | Form tambah UMKM |
| POST | `/admin/umkm/store` | `AdminUMKMController@store` | Simpan UMKM baru |
| GET | `/admin/umkm/edit` | `AdminUMKMController@edit` | Form edit UMKM |
| POST | `/admin/umkm/update` | `AdminUMKMController@update` | Simpan perubahan UMKM |
| POST | `/admin/umkm/delete` | `AdminUMKMController@delete` | Hapus UMKM |

### Route Admin — Kritik & Saran

| Method | Path | Controller@Method | Keterangan |
|---|---|---|---|
| GET | `/admin/kritik-saran` | `AdminKritikController@index` | Daftar pesan masuk |
| GET | `/admin/kritik-saran/arsip` | `AdminKritikController@arsip` | Arsip pesan |
| POST | `/admin/kritik-saran/terima` | `AdminKritikController@terima` | Terima pesan |
| POST | `/admin/kritik-saran/kembalikan` | `AdminKritikController@kembalikan` | Kembalikan ke pending |
| POST | `/admin/kritik-saran/tampilkan` | `AdminKritikController@tampilkan` | Tampilkan ke publik |
| POST | `/admin/kritik-saran/sembunyikan` | `AdminKritikController@sembunyikan` | Sembunyikan dari publik |

---

## 🧩 Arsitektur MVC

Aplikasi mengimplementasikan pola **Model-View-Controller** secara native dengan PHP tanpa framework pihak ketiga.

```
HTTP Request
     |
     v
public/index.php              <- Front Controller (entry point tunggal)
     |
     v
app/core/Router.php           <- Parsing URL & dispatch ke controller
     |
     +---> app/controllers/[NamaController].php
     |           |
     |           +---> app/models/[NamaModel].php   <- Query ke MySQL
     |           |           |
     |           |           v
     |           |     config/database.php           <- Koneksi mysqli
     |           |
     |           +---> app/views/[path/view].php     <- Render HTML
     |
     +---> app/core/ErrorHandler.php                 <- Tangani 404 / 500
```

### Komponen Core

| File | Peran |
|---|---|
| `Router.php` | Mencocokkan URL + HTTP method ke `Controller@method`, menangani 404 |
| `Controller.php` | Base class controller; helper untuk memuat view |
| `Model.php` | Base class model; akses ke koneksi database global |
| `Csrf.php` | Generate token CSRF (`random_bytes` 32-byte), validasi token pada POST |
| `LoginThrottle.php` | Mencatat percobaan login per IP/username, memblokir jika melebihi batas |
| `ErrorHandler.php` | Mendaftarkan `set_error_handler` & `set_exception_handler` global |
| `SecurityLogger.php` | Menulis log kejadian keamanan ke `storage/logs/` |

---

## 🚀 Quick Start

<details>
<summary><strong>⚙️ Klik untuk instruksi instalasi lengkap</strong></summary>

### Prasyarat

- PHP 8.2 atau lebih baru
- MySQL 8.0+ atau MariaDB
- Apache dengan `mod_rewrite` aktif (atau PHP built-in server untuk development)

### 1. Clone Repository

```bash
git clone https://github.com/kampungketupat/kampung_ketupat.git
cd kampung_ketupat
```

### 2. Konfigurasi Environment

Atur environment variable berikut via `.env`, cPanel, atau konfigurasi server:

```env
APP_ENV=local

DB_HOST=localhost
DB_USER=root
DB_PASS=
DB_NAME=kampung_ketupat
DB_CHARSET=utf8mb4

DB_AUTO_INIT=true
DB_AUTO_SEED=true
```

> Untuk **production**, ubah `APP_ENV=production` dan set `DB_AUTO_INIT=false`, `DB_AUTO_SEED=false`.

### 3. Import Database

**Opsi A — Data aktual (direkomendasikan):**

```bash
mysql -u root -p kampung_ketupat < kampung_ketupat.sql
```

**Opsi B — Template skema kosong:**

```bash
mysql -u root -p kampung_ketupat < database/kampung_ketupat.sql
```

**Opsi C — Auto-init (development saja):**

Biarkan `DB_AUTO_INIT=true` dan `DB_AUTO_SEED=true`. Skema dan data awal dibuat otomatis saat pertama kali aplikasi diakses.

### 4. Jalankan Aplikasi

```bash
php -S 127.0.0.1:8088 -t public
```

Atau arahkan document root Laragon / XAMPP ke folder `public/`.

### 5. Akses di Browser

```
Halaman publik   : http://127.0.0.1:8088/
Panel admin      : http://127.0.0.1:8088/admin/login

Kredensial default (setelah auto-seed):
  Username : admin
  Password : admin123
```

> Segera **ganti password default** setelah pertama kali login!

### 6. Permission Folder Upload

```bash
chmod -R 755 public/assets/uploads/
```

</details>

---

## 🧭 Halaman Website

| Halaman | URL | Data Utama | Fungsi |
|---|---|---|---|
| **Beranda** | `/` | Galeri, event, UMKM terbaru | Landing page utama |
| **Wisata** | `/wisata` | Informasi objek wisata | Pengenalan wisata kampung |
| **Galeri** | `/galeri` | Foto publik per kategori | Showcase visual kampung |
| **Event** | `/event` | Jadwal, status, jam, lokasi | Informasi kegiatan & acara |
| **UMKM** | `/umkm` | Usaha lokal, kontak, produk | Promosi UMKM warga |
| **Lokasi** | `/lokasi` | Peta & info lokasi | Panduan menuju kampung |
| **Kontak** | `/kontak` | Info kontak pengelola | Komunikasi dengan pengelola |
| **Kritik & Saran** | `/kritik-saran` | Form & daftar pesan publik | Feedback pengunjung |
| **Admin Login** | `/admin/login` | Form autentikasi | Pintu masuk panel admin |
| **Admin Dashboard** | `/admin/dashboard` | Statistik konten | Overview data website |
| **Admin Galeri** | `/admin/galeri` | CRUD foto + toggle publish | Kelola konten galeri |
| **Admin Event** | `/admin/event` | CRUD event + status | Kelola jadwal kegiatan |
| **Admin UMKM** | `/admin/umkm` | CRUD data UMKM | Kelola profil UMKM |
| **Admin Kritik Saran** | `/admin/kritik-saran` | Moderasi pesan | Kelola feedback pengunjung |

---

## 🔐 Fitur Keamanan

### CSRF Protection

Setiap form POST mengandung token CSRF tersembunyi yang digenerate oleh `app/core/Csrf.php` menggunakan `random_bytes()` 32-byte dienkode hex. Token divalidasi sebelum memproses request; request tanpa token valid ditolak.

### Session Hardening

`session_regenerate_id(true)` dipanggil setelah login berhasil untuk mencegah **session fixation attack**. Session dikonfigurasi dengan atribut keamanan tambahan.

### Login Throttle (Anti Brute-Force)

Dikelola oleh `app/core/LoginThrottle.php` bersama tabel `auth_login_attempts`. Percobaan login dicatat per kombinasi **IP address + username**. Setelah melewati batas percobaan, akun/IP diblokir sementara via kolom `blocked_until`. Data percobaan lebih dari 2 hari otomatis dibersihkan.

### Validasi Upload File

Helper `app/helpers/upload.php` memvalidasi MIME type, ukuran file, dan isi file untuk memastikan hanya gambar valid yang diterima. Nama file di-rename menggunakan timestamp + random string untuk mencegah path traversal.

### Route Destruktif Hanya via POST

Semua operasi hapus dan ubah status didefinisikan sebagai route POST — bukan GET. Ini mencegah serangan CSRF berbasis `<img src>` atau link manipulation.

### Security Logging

`app/core/SecurityLogger.php` mencatat kejadian penting ke `storage/logs/` — termasuk controller/class/method yang tidak ditemukan (potensi route fuzzing). Log tersimpan di luar `public/` sehingga tidak dapat diakses langsung via browser.

### Blokir Akses File Sensitif via `.htaccess`

File `.htaccess` mengkonfigurasi front controller pattern dan memblokir akses langsung ke folder `app/`, `config/`, `routes/`, `storage/`, dan `database/`, serta file `.env` dan `.gitignore`.

---

## 📁 Asset & Frontend

### CSS

| File | Ukuran | Fungsi |
|---|---|---|
| `public/assets/css/style.css` | ~60 KB | Stylesheet halaman publik — layout, tipografi, komponen |
| `public/assets/css/admin.css` | ~42 KB | Stylesheet panel admin — sidebar, tabel, form, card |

### JavaScript

| File | Ukuran | Fungsi |
|---|---|---|
| `public/assets/js/app.js` | ~30 KB | Logic utama frontend (navigasi, galeri, interaksi UI) |
| `public/assets/js/main.js` | ~3.8 KB | Inisialisasi global, event listener umum |
| `public/assets/js/swal-helper.js` | ~5 KB | Wrapper helper SweetAlert2 (konfirmasi hapus, notifikasi) |

### Library Eksternal (CDN)

- **Bootstrap Icons** — Ikon UI untuk navigasi, tombol, dan indikator status.
- **SweetAlert2** — Dialog konfirmasi & notifikasi yang lebih ramah pengguna dibanding `alert()` bawaan browser.

---

## ⚙️ Konfigurasi Environment

Aplikasi membaca konfigurasi dari **environment variable** melalui fungsi `cfg_env()` di `config/database.php`.

| Variable | Default | Keterangan |
|---|---|---|
| `APP_ENV` | `local` | Environment aktif (`local` atau `production`) |
| `DB_HOST` | `localhost` | Host database MySQL |
| `DB_USER` | `root` | Username database |
| `DB_PASS` | _(kosong)_ | Password database |
| `DB_NAME` | `kampung_ketupat` | Nama database |
| `DB_CHARSET` | `utf8mb4` | Charset koneksi database |
| `DB_AUTO_INIT` | `true` (jika `local`) | Auto-create tabel jika belum ada |
| `DB_AUTO_SEED` | `true` (jika non-production) | Auto-insert data awal (admin default, dll.) |

> `DB_AUTO_INIT` juga menjalankan `ensureColumn()` yang otomatis menambahkan kolom baru jika belum ada — berguna untuk migrasi skema sederhana tanpa alat migrasi terpisah.

---

## 🧪 Testing & Smoke Test

### Syntax Check (PHP Linting)

```bash
# Periksa sintaks file utama
php -l public/index.php
php -l config/database.php

# Periksa semua file controller
find app/controllers -name "*.php" -exec php -l {} \;

# Periksa semua file core
find app/core -name "*.php" -exec php -l {} \;
```

### Smoke Test Endpoint

```
# Halaman Publik
GET  /                    -> 200 OK, tampil beranda
GET  /galeri              -> 200 OK, daftar foto galeri
GET  /event               -> 200 OK, daftar event
GET  /umkm                -> 200 OK, direktori UMKM
GET  /kritik-saran        -> 200 OK, form kritik & saran
GET  /lokasi              -> 200 OK, halaman lokasi
GET  /kontak              -> 200 OK, halaman kontak

# Admin
GET  /admin/login         -> 200 OK, form login tampil
POST /admin/login/proses  -> redirect ke dashboard jika kredensial valid
GET  /admin/dashboard     -> 302 redirect ke login jika belum login
GET  /admin/galeri        -> 302 redirect ke login jika belum login

# Error Handling
GET  /halaman-tidak-ada   -> 404 Not Found, tampil error page kustom
```

---

## 📌 Catatan Deployment

### Hosting Shared (cPanel / InfinityFree)

1. Upload seluruh folder ke direktori `public_html` atau subdirektori yang diinginkan.
2. Pastikan `public/` menjadi **document root**, atau salin isi `public/` ke `public_html/` dan sesuaikan path di `public/index.php`.
3. Import SQL melalui phpMyAdmin menggunakan file `kampung_ketupat.sql`.
4. Set environment variable melalui cPanel atau sesuaikan nilai default di `config/database.php`.
5. Pastikan `mod_rewrite` aktif — biasanya sudah aktif di cPanel.
6. Berikan permission `755` pada folder `public/assets/uploads/` dan seluruh subdirektorinya.

### VPS / Server Dedicated (Nginx)

```nginx
server {
    listen 80;
    server_name kampung-ketupat.com;
    root /var/www/kampung_ketupat/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include fastcgi_params;
        fastcgi_pass unix:/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }
}
```

### Checklist Produksi

- [ ] Ubah `APP_ENV=production`
- [ ] Nonaktifkan `DB_AUTO_INIT` dan `DB_AUTO_SEED`
- [ ] Ganti password admin default
- [ ] Pastikan folder `storage/logs/` writable namun tidak dapat diakses publik
- [ ] Aktifkan HTTPS (SSL/TLS)
- [ ] Verifikasi blokir akses langsung ke file di luar `public/`

---

## 📊 Sumber Daya Proyek

### 🌍 Website Live

<img width="1919" height="1078" alt="Image" src="https://github.com/user-attachments/assets/dd0b5889-e21a-4fde-abed-afee17c75eaa" />

Aplikasi telah di-deploy dan dapat diakses publik di:

**[https://kampung-ketupat.infinityfree.me/](https://kampung-ketupat.infinityfree.me/)**

### 📊 Slide Presentasi (PPT / Canva)

<img width="1920" height="1080" alt="Image" src="https://github.com/user-attachments/assets/ef72d296-a07f-4052-968d-b9ef78b220bb" />

Slide deck untuk presentasi proyek — berisi overview, arsitektur, fitur utama, screenshot demo, dan rencana pengembangan:

**[https://canva.link/54cr2ep7p6ouwdr](https://canva.link/54cr2ep7p6ouwdr)**

### 📄 Laporan Proyek

Dokumen laporan lengkap — latar belakang, analisis kebutuhan, perancangan sistem, implementasi, pengujian, dan kesimpulan:

**[Google Drive – Laporan](https://drive.google.com/drive/folders/1NnE_3vCfHOyXmjiId5lK8Y-TGkFcHNcU?usp=sharing)**

### 🎙️ Dokumentasi Wawancara

Rekaman dan transkrip wawancara dengan stakeholder/pengelola kampung sebagai dasar analisis kebutuhan pengguna:

**[Google Drive – Wawancara](https://drive.google.com/drive/folders/1nMXrLRJ-9rJV7JU9HYuCDG_3R1cVz6eg?usp=sharing)**

### 🗺️ Flowchart Sistem (Draw.io)

Diagram alur sistem mencakup user flow, admin flow, alur autentikasi, dan arsitektur MVC:

**[Lihat Flowchart di Google Drive](https://drive.google.com/file/d/1xvJ7Z_Qhu0zfzCXTjoyFLHQ2VosqakOO/view?usp=drive_link)**

---

## Anggota Tim — Sidang Berapi🔥

| Nama | NIM | Role |
|---|---|---|
| Sayid Rafi A'thaya | 2409116036 | Project Manager 💡 |
| Mochammad Rezky Ramadhan | 2409116029 | Backend / Supabase ⚙️ |
| Adella Putri | 2409116006 | Frontend / UI 🎨 |
| Dhita Olivia Ramadhayanti Kusuma | 2409116040 | Documentation / Report 🧾 |

---

<div align="center">

![Footer](https://capsule-render.vercel.app/api?type=waving&height=120&color=0:0d9488,100:0f172a&section=footer)

**Kampung Ketupat Web** &nbsp;·&nbsp; Dibangun dengan ❤️ menggunakan PHP Native MVC

[![Live](https://img.shields.io/badge/Website_Live-kampung--ketupat.infinityfree.me-0d9488?style=flat-square)](https://kampung-ketupat.infinityfree.me/)
[![PPT](https://img.shields.io/badge/Slide_Presentasi-Canva-7952B3?style=flat-square)](https://canva.link/54cr2ep7p6ouwdr)
[![License](https://img.shields.io/badge/License-MIT-22c55e?style=flat-square)](https://opensource.org/licenses/MIT)

</div>
