<?php
// header admin
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title><?= $judul_halaman ?? 'Admin' ?> — Kampung Ketupat</title>

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />

    <!-- CUSTOM -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/admin.css" />
</head>

<body class="admin-page">

    <!-- SIDEBAR -->
    <nav class="sidebar-admin">
        <div class="sidebar-brand">
            Kampung Ketupat<br>
            <small style="font-family:'Poppins';font-size:.75rem;opacity:.7;">Panel Admin</small>
        </div>

        <ul class="sidebar-nav nav flex-column">

            <!-- DASHBOARD -->
            <li class="nav-item">
                <a class="nav-link <?= ($menu_aktif ?? '') === 'dashboard' ? 'active' : '' ?>"
                    href="/admin/dashboard">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- SECTION -->
            <li class="nav-item mt-3">
                <small class="sidebar-label">Kelola Konten</small>
            </li>

            <!-- MENU -->
            <li class="nav-item">
                <a class="nav-link <?= ($menu_aktif ?? '') === 'galeri' ? 'active' : '' ?>"
                    href="/admin/galeri">
                    <i class="bi bi-images"></i>
                    <span>Galeri Wisata</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= ($menu_aktif ?? '') === 'event' ? 'active' : '' ?>"
                    href="/admin/event">
                    <i class="bi bi-calendar-event"></i>
                    <span>Event / Kalender</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= ($menu_aktif ?? '') === 'umkm' ? 'active' : '' ?>"
                    href="/admin/umkm">
                    <i class="bi bi-shop"></i>
                    <span>UMKM Lokal</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= ($menu_aktif ?? '') === 'kritik' ? 'active' : '' ?>"
                    href="/admin/kritik-saran">
                    <i class="bi bi-chat-heart"></i>
                    <span>Kritik & Saran</span>
                </a>
            </li>

            <!-- DIVIDER -->
            <hr class="sidebar-divider">

            <!-- WEBSITE -->
            <li class="nav-item">
                <a class="nav-link" href="/" target="_blank">
                    <i class="bi bi-globe"></i>
                    <span>Lihat Website</span>
                </a>
            </li>

            <!-- LOGOUT -->
            <li class="nav-item">
                <button type="button" onclick="logout()" class="nav-link text-danger">
                    <i class="bi bi-box-arrow-left"></i>
                    <span>Logout</span>
                </button>
            </li>

        </ul>
    </nav>

    <!-- MAIN -->
    <div class="admin-main">
        <div class="admin-container">

            <!-- TOPBAR -->
            <div class="d-flex justify-content-between align-items-center mb-4">

                <!-- TITLE -->
                <h5 class="fw-bold mb-0">
                    <?= $judul_halaman ?? 'Dashboard' ?>
                </h5>

                <!-- USER -->
                <div class="text-muted small d-flex align-items-center gap-2">
                    <i class="bi bi-person-circle fs-5"></i>
                    <span>
                        <?= htmlspecialchars($_SESSION['admin']['nama'] ?? 'Admin') ?>
                    </span>
                </div>

            </div>