-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 27, 2026 at 01:39 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kampung_ketupat`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(150) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `nama_lengkap`, `created_at`) VALUES
(1, 'admin', '$2y$10$enPT3uAg59US.rfo.MpefebNcODDiNQtuvKgV2aUK4H68PQO59PMK', 'Administrator Kampung Ketupat', '2026-04-03 08:01:35');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
CREATE TABLE `event` (
  `id` int NOT NULL,
  `nama_event` varchar(200) NOT NULL,
  `deskripsi` text,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `lokasi` varchar(255) DEFAULT 'Kampung Ketupat Warna Warni, Samarinda',
  `foto` varchar(255) DEFAULT NULL,
  `status` enum('akan_datang','berlangsung','selesai') DEFAULT 'akan_datang',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  `link_info` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `nama_event`, `deskripsi`, `tanggal_mulai`, `tanggal_selesai`, `lokasi`, `foto`, `status`, `created_at`, `jam_mulai`, `jam_selesai`, `link_info`) VALUES
(1, 'Ramadhan Food Festival Kampung Ketupat', 'Festival kuliner selama bulan Ramadhan yang menyediakan makanan berbuka puasa khas lokal.', '2026-03-15', '2026-03-30', 'Sepanjang Jalan Wisata Kampung Ketupat, Samarinda', '1777254589_216dc67b7dbb.webp', 'selesai', '2026-04-03 08:01:35', '20:00:00', '08:00:00', 'https://www.facebook.com/kampungketupatsmr/?locale=id_ID'),
(3, 'Festival Kuliner Ketupat Nusantara', 'Festival kuliner yang menghadirkan berbagai olahan ketupat khas Samarinda dan daerah lain, dikelola oleh UMKM lokal Kampung Ketupat.', '2026-04-25', '2026-04-30', 'Area Dermaga Kampung Ketupat, Samarinda', '1777253837_e5bf0ebba493.jpeg', 'berlangsung', '2026-04-03 08:01:35', '21:00:00', '09:00:00', 'https://www.instagram.com/kampungketupatsmd_/'),
(11, 'Jelajah Rasa Kampung Ketupat', 'Program wisata kuliner harian bagi pengunjung untuk menikmati hidangan khas sambil berkeliling kampung.', '2026-04-20', '2026-05-05', 'Sepanjang Jalan Kampung Ketupat, Samarinda', '1777254120_2a574724ddd9.png', 'berlangsung', '2026-04-11 08:35:34', '22:00:00', '06:00:00', 'https://www.instagram.com/p/DKhThJFTBU6/?img_index=1'),
(12, 'Festival Ketupat Samarinda 2026', 'Event tahunan terbesar berupa tradisi makan ketupat bersama, pertunjukan budaya, dan kegiatan religi masyarakat.', '2026-05-10', '2026-05-10', 'Lapangan Utama Kampung Ketupat, Samarinda', '1777254339_3c179e45a3b1.webp', 'akan_datang', '2026-04-15 12:50:32', '20:00:00', '14:00:00', 'https://www.instagram.com/p/Cmqc0RgBQIP/');

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

DROP TABLE IF EXISTS `galeri`;
CREATE TABLE `galeri` (
  `id` int NOT NULL,
  `judul` varchar(200) NOT NULL,
  `deskripsi` text,
  `foto` varchar(255) NOT NULL,
  `kategori` enum('wisata','kuliner','budaya','fasilitas','umum') DEFAULT 'umum',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `is_publish` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `galeri`
--

INSERT INTO `galeri` (`id`, `judul`, `deskripsi`, `foto`, `kategori`, `created_at`, `is_publish`) VALUES
(2, 'Rumah Warna-Warni Warga', 'Rumah warga yang dicat warna cerah menjadi daya tarik utama kampung.', 'kk_69d22e54bb73c5.22697946.webp', 'wisata', '2026-04-03 08:01:35', 1),
(3, 'Pemandangan Sungai Mahakam', 'Suasana tepi Sungai Mahakam dengan latar Jembatan Mahkota II.', 'kk_69d22e5f14ce74.79606835.jpg', 'wisata', '2026-04-03 08:01:35', 1),
(4, 'Proses Pembuatan Ketupat', 'Warga menganyam ketupat dari daun nipah secara turun-temurun.', 'kk_69d22e6cd2a506.60833475.jpg', 'budaya', '2026-04-03 08:01:35', 1),
(5, 'Kuliner Khas Lokal', 'Kegiatan UMKM lokal dalam menjual makanan khas kepada pengunjung.', '1777262056_69eedde8727eb.jpg', 'kuliner', '2026-04-03 08:01:35', 1),
(10, 'Monumen Ketupat Raksasa', 'Monumen ketupat berukuran besar yang menjadi ikon Kampung Ketupat.', '1777262127_69eede2f67570.jpg', 'umum', '2026-04-15 12:40:07', 1),
(14, 'Cafe di Pinggiran Sungai Mahakam', 'Cafe dengan suasana santai di tepi Sungai Mahakam, cocok untuk bersantai sambil menikmati pemandangan.', '1776928617_69e9c76910115.jpg', 'kuliner', '2026-04-23 07:16:57', 0),
(15, 'Panorama Kampung Ketupat Warna-Warni', 'Pemandangan keseluruhan Kampung Ketupat dengan rumah-rumah warna-warni yang menjadi daya tarik utama wisata.', '1776930749_69e9cfbd783a7.jpg', 'umum', '2026-04-23 07:52:29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kritik_saran`
--

DROP TABLE IF EXISTS `kritik_saran`;
CREATE TABLE `kritik_saran` (
  `id` int NOT NULL,
  `nama_pengunjung` varchar(150) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `jenis` enum('kritik','saran','pertanyaan','apresiasi') DEFAULT 'saran',
  `pesan` text NOT NULL,
  `sudah_dibaca` tinyint(1) DEFAULT '0',
  `status` enum('pending','diterima','publik') NOT NULL DEFAULT 'pending',
  `tampil_mulai` date DEFAULT NULL,
  `tampil_selesai` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kritik_saran`
--

INSERT INTO `kritik_saran` (`id`, `nama_pengunjung`, `email`, `jenis`, `pesan`, `sudah_dibaca`, `status`, `tampil_mulai`, `tampil_selesai`, `created_at`) VALUES
(2, 'Dewi Rahayu', 'dewi@email.com', 'saran', 'Semoga bisa ditambah papan penunjuk arah yang lebih jelas dari jalan utama.', 1, 'diterima', NULL, NULL, '2026-04-03 08:01:35'),
(3, 'Budi Santoso', '', 'kritik', 'Tempat parkir kurang luas saat akhir pekan, semoga bisa diperluas lagi.', 1, 'diterima', NULL, NULL, '2026-04-03 08:01:35'),
(5, 'sddfsasdf', '', 'saran', 'afdsafdsfds', 1, 'pending', NULL, NULL, '2026-04-15 13:42:46'),
(8, 'adele', 'ad3llaputri99@gmail.com', 'saran', 'uda keren sih gacor', 1, 'pending', NULL, NULL, '2026-04-21 10:17:34'),
(9, 'delle', 'delle@gmail.com', 'pertanyaan', 'kok keren bgt web nya kak', 1, 'diterima', NULL, NULL, '2026-04-22 09:27:19'),
(10, 'Adel', 'ad3llaputri99@gmail.com', 'pertanyaan', 'Kenapa kok bagus banget web nya kak?', 1, 'pending', NULL, NULL, '2026-04-26 11:05:31'),
(11, 'Adel', 'ad3llaputri99@gmail.com', 'apresiasi', 'KEREN BGT WOWWWWWW', 1, 'diterima', NULL, NULL, '2026-04-26 12:49:17'),
(12, 'Dani', 'danib@gmail.com', 'saran', 'okesssssoiiiih', 1, 'diterima', NULL, NULL, '2026-04-26 15:04:39'),
(13, 'Siti Nurhaliza', 'siti.nur@email.com', 'saran', 'Secara keseluruhan kebersihan sudah terjaga dengan baik. Akan lebih optimal jika penambahan tempat sampah di beberapa area ramai pengunjung bisa dipertimbangkan.', 1, 'publik', '2026-04-27', '2026-05-04', '2026-04-27 02:31:42'),
(14, 'Adella Putri', 'adellaputri@gmail.com', 'apresiasi', 'Saya sangat terkesan dengan suasana Kampung Ketupat yang bersih, rapi, dan penuh warna. Konsep wisata yang diangkat sangat unik dan menarik, terutama kuliner khasnya yang autentik. Semoga terus berkembang dan semakin dikenal luas.', 1, 'publik', '2026-04-27', '2026-05-04', '2026-04-27 02:33:15'),
(15, 'Rizky Ramadhan', 'rizky.r@email.com', 'pertanyaan', 'Apakah Kampung Ketupat memiliki jam operasional tertentu setiap harinya? Dan apakah ada waktu terbaik untuk berkunjung agar bisa menikmati semua fasilitas dengan maksimal?', 1, 'publik', '2026-04-27', '2026-05-04', '2026-04-27 02:33:52'),
(16, 'Dhita', 'dhita@gmail.com', 'kritik', 'Secara keseluruhan tempat ini sudah sangat baik. Saat pengunjung sedang ramai, mungkin pengelolaan alur pengunjung bisa lebih diatur agar tetap nyaman dan tidak terlalu padat di beberapa titik.', 1, 'publik', '2026-04-27', '2026-05-04', '2026-04-27 02:35:15'),
(17, 'Sayid Rafi', 'sayid@gmail.com', 'apresiasi', 'Spot foto di Kampung Ketupat sangat menarik dan instagramable. Warna-warni kampungnya membuat hasil foto jadi lebih estetik dan cocok untuk dibagikan di media sosial.', 1, 'publik', '2026-04-27', '2026-05-04', '2026-04-27 02:36:54'),
(18, 'Kim Mingyu', 'mingyugtg@gmail.com', 'saran', 'Kuliner di Kampung Ketupat sangat enak dan beragam. Saya sangat menikmati ketupat dengan berbagai lauk khas yang disajikan. Pengalaman ini benar-benar memberikan kesan tersendiri.', 1, 'publik', '2026-04-27', '2026-05-04', '2026-04-27 02:38:23');

-- --------------------------------------------------------

--
-- Table structure for table `umkm`
--

DROP TABLE IF EXISTS `umkm`;
CREATE TABLE `umkm` (
  `id` int NOT NULL,
  `nama_umkm` varchar(200) NOT NULL,
  `pemilik` varchar(150) DEFAULT NULL,
  `kategori` enum('kuliner','kerajinan','souvenir','jasa','lainnya') DEFAULT 'lainnya',
  `deskripsi` text,
  `produk_unggulan` varchar(255) DEFAULT NULL,
  `kontak` varchar(100) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `umkm`
--

INSERT INTO `umkm` (`id`, `nama_umkm`, `pemilik`, `kategori`, `deskripsi`, `produk_unggulan`, `kontak`, `alamat`, `foto`, `created_at`) VALUES
(2, 'Anyaman Daun Lestari', 'Siti Rahma', 'kerajinan', 'UMKM ini memproduksi kerajinan tangan berbahan daun kelapa seperti anyaman ketupat dan dekorasi tradisional yang sering digunakan untuk acara budaya.', 'Anyaman Ketupat Daun Nipah, Ketupat Hias', '0813-xxxx-xxxx', 'Jl. Kampung Ketupat RT 01, Samarinda', '1777255554_69eec482d29a7.jpg', '2026-04-03 08:01:35'),
(3, 'Kios Souvenir Warna Warni', 'Ibu Rahma', 'souvenir', 'Toko souvenir khas menjual miniatur ketupat, kaos, dan kerajinan tangan khas Kalimantan Timur.            ', 'Miniatur Ketupat, Kaos Wisata', '0815-xxxx-xxxx', 'Area Parkir Kampung Ketupat', 'kk_69d380893f7b16.72380089.jpg', '2026-04-03 08:01:35'),
(4, 'Homestay Tepi Mahakam', 'Bapak Rusdi', 'jasa', 'Fasilitas homestay dengan pemandangan langsung Sungai Mahakam.', 'Kamar dengan View Sungai Mahakam', '0817-xxxx-xxxx', 'Jl. Mangkupalas No. 8', 'kk_69d380d37d5f27.32208251.jpg', '2026-04-03 08:01:35'),
(5, 'Warung Lontong & Ketupat Pak Jaya', 'Jaya Saputra', 'kuliner', 'Menyajikan menu ketupat dengan berbagai pilihan lauk seperti opor ayam dan rendang. Tempat ini terkenal dengan harga terjangkau dan porsi yang mengenyangkan.', 'Ketupat Opor Ayam', '0812-xxxx-xxxx', 'Jl. Wisata Kampung Ketupat RT 03, Samarinda', '1777255388_69eec3dc1fe41.jpg', '2026-04-04 04:53:17'),
(6, 'Dapur Ketupat Mama Rina', 'Rina Wulandari', 'kuliner', 'UMKM ini menyediakan olahan ketupat khas dengan cita rasa tradisional Kalimantan Timur. Dikenal dengan kuah santan yang gurih dan rempah yang kuat, menjadi favorit wisatawan yang berkunjung.', 'Ketupat Sayur Banjar', '0812-xxxx-xxxx', 'Jl. Kampung Ketupat RT 02, Samarinda', '1777255261_69eec35dc4df1.jpg', '2026-04-04 08:53:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kritik_saran`
--
ALTER TABLE `kritik_saran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `umkm`
--
ALTER TABLE `umkm`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `kritik_saran`
--
ALTER TABLE `kritik_saran`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `umkm`
--
ALTER TABLE `umkm`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
