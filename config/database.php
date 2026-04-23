<?php
// ============================================================
// DATABASE CONFIG (FINAL - CLEAN & MVC READY)
// ============================================================

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'kampung_ketupat');
define('DB_CHARSET', 'utf8mb4');

// =========================
// CONNECT MYSQL
// =========================
$koneksi = new mysqli(DB_HOST, DB_USER, DB_PASS);

if ($koneksi->connect_error) {
    die("Koneksi MySQL gagal: " . $koneksi->connect_error);
}

$koneksi->set_charset(DB_CHARSET);

// =========================
// CREATE DATABASE
// =========================
$koneksi->query("
    CREATE DATABASE IF NOT EXISTS " . DB_NAME . "
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci
");

$koneksi->select_db(DB_NAME);

// =========================
// CREATE TABLES
// =========================
$queries = [

    "CREATE TABLE IF NOT EXISTS admin (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(100) UNIQUE,
        password VARCHAR(255),
        nama_lengkap VARCHAR(150),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )",

    "CREATE TABLE IF NOT EXISTS galeri (
        id INT AUTO_INCREMENT PRIMARY KEY,
        judul VARCHAR(200),
        deskripsi TEXT,
        foto VARCHAR(255),
        kategori ENUM('wisata','kuliner','budaya','fasilitas','umum') DEFAULT 'umum',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )",

    "CREATE TABLE IF NOT EXISTS event (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nama_event VARCHAR(200),
        deskripsi TEXT,
        tanggal_mulai DATE,
        tanggal_selesai DATE,
        lokasi VARCHAR(255),
        foto VARCHAR(255),
        status ENUM('akan_datang','berlangsung','selesai') DEFAULT 'akan_datang',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )",

    "CREATE TABLE IF NOT EXISTS umkm (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nama_umkm VARCHAR(200),
        pemilik VARCHAR(150),
        kategori ENUM('kuliner','kerajinan','souvenir','jasa','lainnya') DEFAULT 'lainnya',
        deskripsi TEXT,
        produk_unggulan VARCHAR(255),
        kontak VARCHAR(100),
        alamat VARCHAR(255),
        foto VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )",

    "CREATE TABLE IF NOT EXISTS kritik_saran (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nama_pengunjung VARCHAR(150),
        email VARCHAR(150),
        jenis ENUM('kritik','saran','pertanyaan','apresiasi') DEFAULT 'saran',
        pesan TEXT,
        sudah_dibaca TINYINT(1) DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )"
];

foreach ($queries as $sql) {
    $koneksi->query($sql);
}

// =========================
// SEED DATA (ADMIN)
// =========================
$cek = $koneksi->query("SELECT COUNT(*) as total FROM admin")->fetch_assoc();

if ($cek['total'] == 0) {
    $password = password_hash('admin123', PASSWORD_DEFAULT);

    $koneksi->query("
        INSERT INTO admin (username, password, nama_lengkap)
        VALUES ('admin', '$password', 'Administrator')
    ");
}

// =========================
// SEED GALERI
// =========================
$cek = $koneksi->query("SELECT COUNT(*) as total FROM galeri")->fetch_assoc();

if ($cek['total'] == 0) {
    $koneksi->query("
        INSERT INTO galeri (judul, foto, kategori) VALUES
        ('Monumen Ketupat', 'https://images.unsplash.com/photo-1533906966484-a9c978a3f090', 'wisata'),
        ('Rumah Warna Warni', 'https://images.unsplash.com/photo-1566552881560-0be862a7c445', 'wisata')
    ");
}

// =========================
// SEED EVENT
// =========================
$cek = $koneksi->query("SELECT COUNT(*) as total FROM event")->fetch_assoc();

if ($cek['total'] == 0) {
    $koneksi->query("
        INSERT INTO event (nama_event, tanggal_mulai, status)
        VALUES
        ('Festival Ketupat', '2026-04-15', 'akan_datang')
    ");
}

// =========================
// SEED UMKM
// =========================
$cek = $koneksi->query("SELECT COUNT(*) as total FROM umkm")->fetch_assoc();

if ($cek['total'] == 0) {
    $koneksi->query("
        INSERT INTO umkm (nama_umkm, kategori)
        VALUES
        ('Warung Ketupat Bu Sari', 'kuliner')
    ");
}
