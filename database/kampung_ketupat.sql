-- ============================================================
-- DATABASE: kampung_ketupat
-- Website Kampung Ketupat Warna Warni Samarinda
-- Import via phpMyAdmin: Database > Import > pilih file ini
-- ============================================================

CREATE DATABASE IF NOT EXISTS kampung_ketupat 
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE kampung_ketupat;

-- ============================================================
-- TABEL: admin
-- ============================================================
DROP TABLE IF EXISTS admin;
CREATE TABLE admin (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    nama_lengkap VARCHAR(150) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Password: admin123
INSERT INTO admin (username, password, nama_lengkap) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrator Kampung Ketupat');

-- ============================================================
-- TABEL: galeri
-- ============================================================
DROP TABLE IF EXISTS galeri;
CREATE TABLE galeri (
    id INT PRIMARY KEY AUTO_INCREMENT,
    judul VARCHAR(200) NOT NULL,
    deskripsi TEXT,
    foto VARCHAR(255) NOT NULL,
    kategori ENUM('wisata','kuliner','budaya','fasilitas','umum') DEFAULT 'umum',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO galeri (judul, deskripsi, foto, kategori) VALUES
('Monumen Ketupat Raksasa', 'Ikon utama Kampung Ketupat Warna Warni yang menjadi spot foto favorit pengunjung.', 'https://images.unsplash.com/photo-1533906966484-a9c978a3f090?w=800&q=80', 'wisata'),
('Rumah Warna-Warni', 'Rumah-rumah warga yang dicat warna cerah menjadi daya tarik visual utama kampung ini.', 'https://images.unsplash.com/photo-1566552881560-0be862a7c445?w=800&q=80', 'wisata'),
('Pemandangan Sungai Mahakam', 'Suasana tepi Sungai Mahakam yang indah dengan latar Jembatan Mahkota II.', 'https://images.unsplash.com/photo-1565060169187-9b5f6382b7d7?w=800&q=80', 'wisata'),
('Proses Pembuatan Ketupat', 'Warga menganyam kulit ketupat dari daun nipah secara turun-temurun.', 'https://images.unsplash.com/photo-1502602898657-3e91760cbb34?w=800&q=80', 'budaya'),
('Kuliner Khas Lokal', 'Soto Banjar yang disajikan bersama ketupat produksi lokal.', 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=800&q=80', 'kuliner'),
('Area Santai Tepi Sungai', 'Fasilitas area santai dan taman bermain di tepi Sungai Mahakam.', 'https://images.unsplash.com/photo-1545239351-1141bd82e8a6?w=800&q=80', 'fasilitas');

-- ============================================================
-- TABEL: event
-- ============================================================
DROP TABLE IF EXISTS event;
CREATE TABLE event (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nama_event VARCHAR(200) NOT NULL,
    deskripsi TEXT,
    tanggal_mulai DATE NOT NULL,
    tanggal_selesai DATE,
    lokasi VARCHAR(255) DEFAULT 'Kampung Ketupat Warna Warni, Samarinda',
    foto VARCHAR(255),
    status ENUM('akan_datang','berlangsung','selesai') DEFAULT 'akan_datang',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO event (nama_event, deskripsi, tanggal_mulai, tanggal_selesai, lokasi, status) VALUES
('Festival Budaya Ketupat 2026', 'Festival tahunan menampilkan tradisi pembuatan ketupat, lomba kuliner, dan pertunjukan seni budaya Kalimantan Timur.', '2026-04-15', '2026-04-17', 'Area Utama Kampung Ketupat Warna Warni', 'akan_datang'),
('Workshop Menganyam Ketupat', 'Workshop pembuatan ketupat dari daun nipah bersama pengrajin lokal, terbuka untuk umum.', '2026-03-20', '2026-03-20', 'Rumah Pengrajin Kampung Ketupat', 'berlangsung'),
('Wisata Edukasi Pelajar', 'Paket wisata edukasi khusus pelajar SD-SMA: belajar budaya, kuliner, dan sejarah Kampung Ketupat.', '2026-04-01', '2026-06-30', 'Kampung Ketupat Warna Warni', 'akan_datang');

-- ============================================================
-- TABEL: umkm
-- ============================================================
DROP TABLE IF EXISTS umkm;
CREATE TABLE umkm (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nama_umkm VARCHAR(200) NOT NULL,
    pemilik VARCHAR(150),
    kategori ENUM('kuliner','kerajinan','souvenir','jasa','lainnya') DEFAULT 'lainnya',
    deskripsi TEXT,
    produk_unggulan VARCHAR(255),
    kontak VARCHAR(100),
    alamat VARCHAR(255),
    foto VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO umkm (nama_umkm, pemilik, kategori, deskripsi, produk_unggulan, kontak, alamat) VALUES
('Warung Ketupat Bu Sari', 'Ibu Sari', 'kuliner', 'Warung makan khas dengan menu Soto Banjar dan Coto Makassar bersama ketupat produksi sendiri.', 'Soto Banjar + Ketupat, Coto Makassar', '0812-xxxx-xxxx', 'Jl. Mangkupalas No. 5, Kampung Ketupat'),
('Kerajinan Ketupat Pak Haji', 'Pak Haji Umar', 'kerajinan', 'Pengrajin ketupat anyaman daun nipah generasi ketiga. Melayani pemesanan massal untuk acara dan hajatan.', 'Anyaman Ketupat Daun Nipah, Ketupat Hias', '0813-xxxx-xxxx', 'Jl. Mangkupalas No. 12, Kampung Ketupat'),
('Kios Souvenir Warna Warni', 'Ibu Rahma', 'souvenir', 'Toko souvenir khas Kampung Ketupat menjual miniatur ketupat, kaos, dan kerajinan tangan khas Kalimantan Timur.', 'Miniatur Ketupat, Kaos Wisata, Gantungan Kunci', '0815-xxxx-xxxx', 'Area Parkir Kampung Ketupat'),
('Homestay Tepi Mahakam', 'Bapak Rusdi', 'jasa', 'Fasilitas homestay dengan pemandangan langsung Sungai Mahakam, cocok untuk wisatawan yang ingin menginap.', 'Kamar dengan View Sungai Mahakam', '0817-xxxx-xxxx', 'Jl. Mangkupalas No. 8, Kampung Ketupat');

-- ============================================================
-- TABEL: kritik_saran
-- ============================================================
DROP TABLE IF EXISTS kritik_saran;
CREATE TABLE kritik_saran (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nama_pengunjung VARCHAR(150) NOT NULL,
    email VARCHAR(150),
    jenis ENUM('kritik','saran','pertanyaan','apresiasi') DEFAULT 'saran',
    pesan TEXT NOT NULL,
    sudah_dibaca TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO kritik_saran (nama_pengunjung, email, jenis, pesan, sudah_dibaca) VALUES
('Ahmad Fauzi', 'ahmad@email.com', 'apresiasi', 'Kampung Ketupat sangat indah dan terawat! Pengalaman belajar membuat ketupat sangat berkesan untuk keluarga kami.', 1),
('Dewi Rahayu', 'dewi@email.com', 'saran', 'Semoga bisa ditambah papan penunjuk arah yang lebih jelas dari jalan utama agar wisatawan mudah menemukan lokasi.', 0),
('Budi Santoso', '', 'kritik', 'Tempat parkir kurang luas saat akhir pekan, semoga bisa diperluas lagi.', 0);
