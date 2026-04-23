<?php require_once BASE_PATH . '/app/views/user/layouts/header.php'; ?>

<?php
$galeri_preview = $galeri_preview ?? [];
$event_preview  = $event_preview ?? [];
$umkm_preview   = $umkm_preview ?? [];
?>

<!-- ===== HERO ===== -->
<section class="hero-kk" id="beranda">
    <div class="container position-relative" style="z-index:2;">
        <div class="row">
            <div class="col-lg-8">
                <span class="hero-tag">Jelajahi Kampung Ketupat</span>

                <h1 class="reveal">
                    Kampung Ketupat <br>
                    <span style="color:var(--kk-secondary);">Warna Warni</span><br>
                    Samarinda
                </h1>

                <p class="hero-subtitle reveal reveal-delay-1">
                    Wisata budaya di tepi Sungai Mahakam dengan rumah warna-warni dan suasana kampung yang unik.
                </p>

                <div class="d-flex flex-wrap gap-3 reveal reveal-delay-2">
                    <a href="<?= BASE_URL ?>/wisata" class="btn btn-kk">
                        <i class="bi bi-compass me-2"></i>Jelajahi Sekarang
                    </a>
                    <a href="<?= BASE_URL ?>/lokasi" class="btn btn-kk-secondary">
                        <i class="bi bi-geo-alt me-2"></i>Lihat Lokasi
                    </a>
                </div>

                <div class="hero-badges">

                    <span class="hero-badge">
                        <i class="bi bi-clock"></i> Buka 08.30–17.30 WITA
                    </span>

                    <span class="hero-badge">
                        <i class="bi bi-ticket"></i> Tiket Gratis
                    </span>

                    <span class="hero-badge">
                        <i class="bi bi-wifi"></i> Area WiFi
                    </span>

                    <span class="hero-badge">
                        <i class="bi bi-geo-alt"></i> ±26 Menit dari Pusat Kota
                    </span>

                </div>

            </div>
        </div>
    </div>
</section>

<!-- ===== TENTANG ===== -->
<section class="section-kk tentang-section" id="tentang">
    <div class="container">
        <div class="row align-items-center g-5">

            <!-- KIRI -->
            <div class="col-lg-6">
                <span class="section-label">Tentang Kami</span>

                <h2 class="section-title">
                    Mengenal Kampung Ketupat Warna Warni
                </h2>

                <p class="tentang-text">
                    Kampung Ketupat Warna Warni merupakan ikon wisata di Kota Samarinda
                    yang berada pada tepi <strong>Sungai Mahakam, Samarinda Seberang.</strong>
                    Dikenal dengan rumah-rumah berwarna cerah dan suasana kampung yang
                    fotogenik, kawasan ini menjadi destinasi favorit untuk wisata budaya,
                    kuliner khas ketupat, dan menikmati pemandangan indah Sungai Mahakam.
                </p>

                <p class="tentang-text">
                    Nama <strong>"Ketupat"</strong> diambil dari tradisi masyarakat setempat
                    sebagai pengrajin anyaman ketupat yang telah berlangsung secara
                    turun-temurun. Dikelola oleh
                    <strong>Pokdarwis (Kelompok Sadar Wisata)</strong>
                    bersama Disporapar Kota Samarinda.
                </p>

                <a href="<?= BASE_URL ?>/wisata" class="btn btn-kk">
                    <i class="bi bi-info-circle me-2"></i>Selengkapnya
                </a>
            </div>

            <!-- KANAN -->
            <div class="col-lg-6">
                <div class="row g-3">

                    <div class="col-6">
                        <div class="card-tentang text-center">
                            <div class="stat-number primary">5+</div>
                            <div class="text-muted small">Tahun Berdiri</div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="card-tentang text-center">
                            <div class="stat-number accent">Gratis</div>
                            <div class="text-muted small">Tiket Masuk</div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="card-tentang text-center">
                            <div class="stat-number secondary"><?= count($umkm_preview) ?>+</div>
                            <div class="text-muted small">UMKM Lokal</div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="card-tentang text-center">
                            <div class="stat-number primary">7</div>
                            <div class="text-muted small">Hari/Minggu Buka</div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

<!-- ===== HIGHLIGHTS ===== -->
<section id="highlights" class="highlights-section">
    <div class="container">

        <div class="text-center mb-5">
            <span class="section-label">Daya Tarik</span>

            <h2 class="section-title">Tourism Highlights</h2>

            <p class="section-subtitle">
                Tiga pengalaman utama yang bisa Anda nikmati di Kampung Ketupat Warna Warni
            </p>
        </div>

        <div class="row justify-content-center g-4">

            <div class="col-lg-4 col-md-6">
                <div class="highlight-card">
                    <div class="highlight-icon mx-auto">
                        <i class="bi bi-bank"></i>
                    </div>
                    <h4 class="highlight-title">Wisata Budaya</h4>
                    <p>
                        Saksikan proses menganyam ketupat dari daun nipah yang diwariskan turun-temurun.
                        Tersedia spot foto ikonik dengan latar Jembatan Mahkota II.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="highlight-card">
                    <div class="highlight-icon mx-auto">
                        <i class="bi bi-cup-hot"></i>
                    </div>
                    <h4 class="highlight-title">Kuliner Ketupat Khas</h4>
                    <p>
                        Nikmati Soto Banjar dan Coto Makassar dengan ketupat khas sambil menikmati suasana Sungai Mahakam.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="highlight-card">
                    <div class="highlight-icon mx-auto">
                        <i class="bi bi-sun"></i>
                    </div>
                    <h4 class="highlight-title">Suasana Tepi Mahakam</h4>
                    <p>
                        Rasakan suasana santai di tepi Sungai Mahakam dengan pemandangan indah dan kampung yang fotogenik.
                    </p>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- ===== GALERI ===== -->
<?php if (!empty($galeri_preview)): ?>
    <section class="kk-galeri" id="galeri">
        <div class="container">

            <!-- HEADER -->
            <div class="kk-galeri-header text-center">
                <span class="kk-label">GALERI</span>
                <h2 class="kk-title">Galeri Wisata</h2>
                <p class="kk-subtitle">
                    Sekilas keindahan Kampung Ketupat Warna Warni
                </p>
            </div>

            <!-- GRID -->
            <div class="row kk-grid">

                <?php foreach ($galeri_preview as $foto): ?>
                    <?php
                    $src = str_starts_with($foto['foto'], 'http')
                        ? $foto['foto']
                        : BASE_URL . '/assets/uploads/galeri/' . $foto['foto'];
                    ?>

                    <div class="col-md-6 col-lg-4">
                        <div class="gallery-item">

                            <img
                                src="<?= htmlspecialchars($src) ?>"
                                alt="<?= htmlspecialchars($foto['judul']) ?>">

                            <div class="gallery-overlay">
                                <span class="gallery-caption"><?= htmlspecialchars($foto['judul']) ?></span>
                            </div>

                        </div>
                    </div>

                <?php endforeach; ?>

            </div>

            <!-- BUTTON -->
            <div class="text-center mt-5">
                <a href="<?= BASE_URL ?>/galeri" class="kk-btn-outline">
                    <i class="bi bi-images me-2"></i>Lihat Semua Foto
                </a>
            </div>

        </div>
    </section>
<?php endif; ?>

<!-- ===== EVENT ===== -->
<?php if (!empty($event_preview)): ?>
    <section class="kk-event-section">
        <div class="container">

            <div class="text-center mb-5">
                <span class="section-label">Agenda</span>

                <h2 class="section-title">Event Mendatang</h2>
                <p class="section-subtitle">
                    Berbagai kegiatan menarik yang akan berlangsung di Kampung Ketupat
                </p>
            </div>

            <!-- LIST -->
            <div class="row g-4">

                <?php foreach ($event_preview as $ev): ?>
                    <div class="col-lg-4 col-md-6 d-flex">

                        <div class="kk-event-card w-100 d-flex">

                            <div class="kk-event-body w-100">

                                <!-- DATE -->
                                <div class="event-date-box">
                                    <div class="day"><?= date('d', strtotime($ev['tanggal_mulai'])) ?></div>
                                    <div class="month"><?= date('M', strtotime($ev['tanggal_mulai'])) ?></div>
                                </div>

                                <!-- CONTENT -->
                                <div class="event-content">

                                    <!-- STATUS -->
                                    <?php
                                    $statusText = 'Selesai';
                                    $statusClass = 'kk-status-selesai';

                                    if ($ev['status'] === 'berlangsung') {
                                        $statusText = 'Berlangsung';
                                        $statusClass = 'kk-status-berlangsung';
                                    } elseif ($ev['status'] === 'akan_datang') {
                                        $statusText = 'Akan Datang';
                                        $statusClass = 'kk-status-akan';
                                    }
                                    ?>

                                    <span class="kk-status <?= $statusClass ?>">
                                        <?= $statusText ?>
                                    </span>

                                    <!-- TITLE -->
                                    <h5 class="event-title mt-2 fw-semibold"><?= htmlspecialchars($ev['nama_event']) ?></h5>

                                    <!-- DESC -->
                                    <p>
                                        <?= htmlspecialchars(substr($ev['deskripsi'], 0, 90)) ?>...
                                    </p>

                                    <!-- META -->
                                    <div class="kk-meta">
                                        <div><i class="bi bi-calendar"></i> <?= date('d M Y', strtotime($ev['tanggal_mulai'])) ?></div>

                                        <?php if (!empty($ev['jam_mulai'])): ?>
                                            <div>
                                                <i class="bi bi-clock"></i>
                                                <?= date('H:i', strtotime($ev['jam_mulai'])) ?>
                                                <?php if (!empty($ev['jam_selesai'])): ?>
                                                    - <?= date('H:i', strtotime($ev['jam_selesai'])) ?>
                                                <?php endif; ?> WITA
                                            </div>
                                        <?php endif; ?>

                                        <div><i class="bi bi-geo-alt"></i> <?= htmlspecialchars($ev['lokasi']) ?></div>
                                    </div>

                                    <!-- LINK -->
                                    <?php if (!empty($ev['link_info'])): ?>
                                        <a href="<?= htmlspecialchars($ev['link_info']) ?>" target="_blank" class="kk-event-link">
                                            <i class="bi bi-instagram"></i> Lihat Info
                                        </a>
                                    <?php endif; ?>

                                </div>

                            </div>

                        </div>

                    </div>
                <?php endforeach; ?>

            </div>

            <!-- BUTTON -->
            <div class="text-center mt-5">
                <a href="<?= BASE_URL ?>/event" class="kk-event-btn">
                    <i class="bi bi-calendar-event me-2"></i>Lihat Semua Event
                </a>
            </div>

        </div>
    </section>
<?php endif; ?>

<!-- ===== UMKM ===== -->
<!-- ===== UMKM PREVIEW ===== -->
<?php if (!empty($umkm_preview)): ?>
    <section class="section-kk">
        <div class="container">

            <div class="text-center mb-5 reveal">
                <span class="section-label">UMKM Lokal</span>
                <h2 class="section-title">Usaha Masyarakat Kampung Ketupat</h2>
                <p class="section-subtitle">
                    Dukung ekonomi lokal melalui produk UMKM warga
                </p>
            </div>

            <div class="row g-4">
                <?php foreach ($umkm_preview as $u): ?>
                    <div class="col-sm-6 col-lg-3 reveal">

                        <div class="card-kk umkm-card h-100">

                            <?php
                            $usrc = $u['foto']
                                ? BASE_URL . '/assets/uploads/umkm/' . $u['foto']
                                : 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=400&q=60';
                            ?>

                            <div class="umkm-img">
                                <img
                                    src="<?= htmlspecialchars($usrc) ?>"
                                    alt="<?= htmlspecialchars($u['nama_umkm']) ?>"
                                    loading="lazy" />
                            </div>

                            <div class="card-body">

                                <span class="umkm-badge">
                                    <?= htmlspecialchars($u['kategori']) ?>
                                </span>

                                <h6 class="umkm-title">
                                    <?= htmlspecialchars($u['nama_umkm']) ?>
                                </h6>

                                <div class="umkm-meta">
                                    <span class="umkm-owner">
                                        <i class="bi bi-people me-1"></i>
                                        <?= htmlspecialchars($u['pemilik']) ?>
                                    </span>
                                </div>

                            </div>

                        </div>

                    </div>
                <?php endforeach; ?>
            </div>

            <!-- BUTTON -->
            <div class="text-center mt-4 reveal">
                <a href="<?= BASE_URL ?>/umkm" class="btn btn-kk-outline">
                    <i class="bi bi-shop me-2"></i>Lihat Semua UMKM
                </a>
            </div>

        </div>
    </section>
<?php endif; ?>

<!-- ===== CTA BANNER ===== -->
<section class="cta-kk">
    <div class="container text-center">

        <h2 class="cta-title">Ingin Berkunjung?</h2>

        <p class="cta-subtitle">
            Temukan lokasi kami dan rencanakan kunjungan Anda ke Kampung Ketupat Warna Warni Samarinda.
        </p>

        <div class="cta-buttons">
            <a href="<?= BASE_URL ?>/lokasi" class="btn btn-cta-primary">
                <i class="bi bi-geo-alt me-2"></i>Lihat Lokasi & Peta
            </a>

            <a href="<?= BASE_URL ?>/kritik-saran" class="btn btn-cta-outline">
                <i class="bi bi-chat-heart me-2"></i>Berikan Saran
            </a>
        </div>

    </div>
</section>
<?php require_once BASE_PATH . '/app/views/user/layouts/footer.php'; ?>