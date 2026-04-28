<?php
// ============================================================
// DATABASE CONFIG (PRODUCTION-SAFE + SHARED HOSTING READY)
// ============================================================

if (!function_exists('cfg_env')) {
    function cfg_env(string $key, string $default = ''): string
    {
        $value = getenv($key);
        if ($value === false) {
            return $default;
        }
        return trim((string)$value);
    }
}

if (!function_exists('cfg_env_bool')) {
    function cfg_env_bool(string $key, bool $default = false): bool
    {
        $value = getenv($key);
        if ($value === false) {
            return $default;
        }

        $value = strtolower(trim((string)$value));
        return in_array($value, ['1', 'true', 'yes', 'on'], true);
    }
}

$appEnv = cfg_env('APP_ENV', 'local');
$isProduction = strtolower($appEnv) === 'production';

define('DB_HOST', cfg_env('DB_HOST', 'localhost'));
define('DB_USER', cfg_env('DB_USER', 'root'));
define('DB_PASS', cfg_env('DB_PASS', ''));
define('DB_NAME', cfg_env('DB_NAME', 'kampung_ketupat'));
define('DB_CHARSET', cfg_env('DB_CHARSET', 'utf8mb4'));

// In production/shared-hosting, this should stay OFF by default.
// Default auto-init only for local root-based setups.
$autoInit = cfg_env_bool('DB_AUTO_INIT', !$isProduction && DB_USER === 'root');
$autoSeed = cfg_env_bool('DB_AUTO_SEED', !$isProduction);

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$koneksi = null;
try {
    $koneksi = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
} catch (mysqli_sql_exception $e) {
    // 1049 = Unknown database
    if ($autoInit && (int)$e->getCode() === 1049) {
        $koneksi = new mysqli(DB_HOST, DB_USER, DB_PASS);
        $koneksi->query(
            "CREATE DATABASE IF NOT EXISTS `" . DB_NAME . "` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci"
        );
        $koneksi->select_db(DB_NAME);
    } else {
        throw $e;
    }
}

$koneksi->set_charset(DB_CHARSET);

if ($autoInit) {
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
            is_publish TINYINT(1) NOT NULL DEFAULT 1,
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
            link_info VARCHAR(255) NULL,
            jam_mulai TIME NULL,
            jam_selesai TIME NULL,
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
            status ENUM('pending','diterima','publik') DEFAULT 'pending',
            tampil_mulai DATE NULL,
            tampil_selesai DATE NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )",

        "CREATE TABLE IF NOT EXISTS auth_login_attempts (
            id INT AUTO_INCREMENT PRIMARY KEY,
            ip_address VARCHAR(45) NOT NULL,
            username VARCHAR(100) NOT NULL,
            attempts INT NOT NULL DEFAULT 0,
            first_attempt_at DATETIME NOT NULL,
            last_attempt_at DATETIME NOT NULL,
            blocked_until DATETIME NULL,
            UNIQUE KEY uniq_auth_attempt (ip_address, username),
            INDEX idx_blocked_until (blocked_until)
        )"
    ];

    foreach ($queries as $sql) {
        $koneksi->query($sql);
    }

    $koneksi->query(
        "DELETE FROM auth_login_attempts
         WHERE last_attempt_at < DATE_SUB(NOW(), INTERVAL 2 DAY)"
    );

    // Migrasi ringan agar tetap kompatibel dengan DB lama
    ensureColumn($koneksi, 'galeri', 'is_publish', "TINYINT(1) NOT NULL DEFAULT 1");
    ensureColumn($koneksi, 'event', 'link_info', "VARCHAR(255) NULL");
    ensureColumn($koneksi, 'event', 'jam_mulai', "TIME NULL");
    ensureColumn($koneksi, 'event', 'jam_selesai', "TIME NULL");
    ensureColumn($koneksi, 'kritik_saran', 'status', "ENUM('pending','diterima','publik') NOT NULL DEFAULT 'pending'");
    ensureColumn($koneksi, 'kritik_saran', 'tampil_mulai', "DATE NULL");
    ensureColumn($koneksi, 'kritik_saran', 'tampil_selesai', "DATE NULL");
}

if ($autoSeed) {
    // Seed admin
    $cek = $koneksi->query("SELECT COUNT(*) as total FROM admin")->fetch_assoc();
    if ((int)($cek['total'] ?? 0) === 0) {
        $password = password_hash('admin123', PASSWORD_DEFAULT);
        $stmt = $koneksi->prepare(
            "INSERT INTO admin (username, password, nama_lengkap) VALUES (?, ?, ?)"
        );
        $username = 'admin';
        $namaLengkap = 'Administrator';
        $stmt->bind_param('sss', $username, $password, $namaLengkap);
        $stmt->execute();
        $stmt->close();
    }

    // Seed galeri
    $cek = $koneksi->query("SELECT COUNT(*) as total FROM galeri")->fetch_assoc();
    if ((int)($cek['total'] ?? 0) === 0) {
        $koneksi->query(
            "INSERT INTO galeri (judul, foto, kategori, is_publish) VALUES
            ('Monumen Ketupat', 'https://images.unsplash.com/photo-1533906966484-a9c978a3f090', 'wisata', 1),
            ('Rumah Warna Warni', 'https://images.unsplash.com/photo-1566552881560-0be862a7c445', 'wisata', 1)"
        );
    }

    // Seed event
    $cek = $koneksi->query("SELECT COUNT(*) as total FROM event")->fetch_assoc();
    if ((int)($cek['total'] ?? 0) === 0) {
        $koneksi->query(
            "INSERT INTO event (nama_event, tanggal_mulai, status)
            VALUES ('Festival Ketupat', '2026-04-15', 'akan_datang')"
        );
    }

    // Seed UMKM
    $cek = $koneksi->query("SELECT COUNT(*) as total FROM umkm")->fetch_assoc();
    if ((int)($cek['total'] ?? 0) === 0) {
        $koneksi->query(
            "INSERT INTO umkm (nama_umkm, kategori)
            VALUES ('Warung Ketupat Bu Sari', 'kuliner')"
        );
    }
}

function ensureColumn(mysqli $db, string $table, string $column, string $definition): void
{
    $tableEsc = $db->real_escape_string($table);
    $columnEsc = $db->real_escape_string($column);

    $result = $db->query("SHOW COLUMNS FROM `{$tableEsc}` LIKE '{$columnEsc}'");
    $exists = $result && $result->num_rows > 0;

    if (!$exists) {
        $db->query("ALTER TABLE `{$tableEsc}` ADD COLUMN `{$columnEsc}` {$definition}");
    }
}
