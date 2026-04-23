<?php
$halaman_aktif = $halaman_aktif ?? '';
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $judul_halaman ?? 'Kampung Ketupat Warna Warni Samarinda' ?></title>
    <meta name="description" content="Destinasi wisata budaya dan kuliner di tepi Sungai Mahakam, Samarinda, Kalimantan Timur." />

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />

    <!-- CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css?v=<?= time() ?>" />

    <!-- Vue -->
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
</head>

<body>

    <!-- ===== NAVBAR ===== -->
    <nav class="navbar navbar-expand-lg navbar-kk fixed-top" id="mainNavbar">
        <div class="container">

            <!-- LOGO -->
            <a class="navbar-brand d-flex align-items-center gap-2" href="<?= BASE_URL ?>">
                <span class="logo-text">Kampung <span class="text-accent">Ketupat</span></span>
            </a>

            <!-- TOGGLE -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- MENU -->
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">

                    <li class="nav-item">
                        <a class="nav-link <?= $halaman_aktif === 'beranda' ? 'active' : '' ?>" href="<?= BASE_URL ?>/">Beranda</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?= $halaman_aktif === 'wisata' ? 'active' : '' ?>" href="<?= BASE_URL ?>/wisata">Detail Wisata</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?= $halaman_aktif === 'galeri' ? 'active' : '' ?>" href="<?= BASE_URL ?>/galeri">Galeri</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?= $halaman_aktif === 'event' ? 'active' : '' ?>" href="<?= BASE_URL ?>/event">Event</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?= $halaman_aktif === 'umkm' ? 'active' : '' ?>" href="<?= BASE_URL ?>/umkm">UMKM</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?= $halaman_aktif === 'lokasi' ? 'active' : '' ?>" href="<?= BASE_URL ?>/lokasi">Lokasi</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?= $halaman_aktif === 'kontak' ? 'active' : '' ?>" href="<?= BASE_URL ?>/kontak">Kontak</a>
                    </li>

                    <li class="nav-item ms-lg-2">
                        <a class="btn btn-kk-outline btn-sm" href="<?= BASE_URL ?>/kritik-saran">
                            <i class="bi bi-chat-heart me-1"></i>Kritik & Saran
                        </a>
                    </li>

                </ul>
            </div>

        </div>
    </nav>
    <!-- ===== END NAVBAR ===== -->