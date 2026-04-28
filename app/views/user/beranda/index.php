<?php require_once BASE_PATH . '/app/views/user/layouts/header.php'; ?>

<?php
$galeri_preview = $galeri_preview ?? [];
$event_preview  = $event_preview ?? [];
$umkm_preview   = $umkm_preview ?? [];

require_once BASE_PATH . '/app/models/KritikSaranModel.php';
global $koneksi;
$ksModel     = new KritikSaranModel($koneksi);
$pesanPublik = $ksModel->getPublik();
?>

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
                    <a href="<?= BASE_URL ?>/wisata" class="btn btn-kk"><i class="bi bi-compass me-2"></i>Jelajahi Sekarang</a>
                    <a href="<?= BASE_URL ?>/lokasi" class="btn btn-kk-secondary"><i class="bi bi-geo-alt me-2"></i>Lihat Lokasi</a>
                </div>
                <div class="hero-badges">
                    <span class="hero-badge"><i class="bi bi-clock"></i> Buka 08.30–17.30 WITA</span>
                    <span class="hero-badge"><i class="bi bi-ticket"></i> Tiket Gratis</span>
                    <span class="hero-badge"><i class="bi bi-wifi"></i> Area WiFi</span>
                    <span class="hero-badge"><i class="bi bi-geo-alt"></i> ±26 Menit dari Pusat Kota</span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-kk tentang-section" id="tentang">
    <div class="container">
        <div class="row align-items-center g-5">

            <div class="col-lg-6 sr sr-left">
                <span class="section-label">Tentang Kami</span>
                <h2 class="section-title">Mengenal Kampung Ketupat Warna Warni</h2>
                <p class="tentang-text">
                    Kampung Ketupat Warna Warni merupakan ikon wisata di Kota Samarinda
                    yang berada pada tepi <strong>Sungai Mahakam, Samarinda Seberang.</strong>
                    Dikenal dengan rumah-rumah berwarna cerah dan suasana kampung yang fotogenik,
                    kawasan ini menjadi destinasi favorit untuk wisata budaya, kuliner khas ketupat,
                    dan menikmati pemandangan indah Sungai Mahakam.
                </p>
                <p class="tentang-text">
                    Nama <strong>"Ketupat"</strong> diambil dari tradisi masyarakat setempat
                    sebagai pengrajin anyaman ketupat yang telah berlangsung secara turun-temurun.
                    Dikelola oleh <strong>Pokdarwis (Kelompok Sadar Wisata)</strong>
                    bersama Disporapar Kota Samarinda.
                </p>
                <a href="<?= BASE_URL ?>/wisata" class="btn btn-kk">
                    <i class="bi bi-info-circle me-2"></i>Selengkapnya
                </a>
            </div>

            <div class="col-lg-6">
                <div class="row g-3">
                    <div class="col-6 sr sr-up" data-sr-delay="0">
                        <div class="card-tentang text-center">
                            <div class="stat-number primary">5+</div>
                            <div class="text-muted small">Tahun Berdiri</div>
                        </div>
                    </div>
                    <div class="col-6 sr sr-up" data-sr-delay="100">
                        <div class="card-tentang text-center">
                            <div class="stat-number accent">Gratis</div>
                            <div class="text-muted small">Tiket Masuk</div>
                        </div>
                    </div>
                    <div class="col-6 sr sr-up" data-sr-delay="200">
                        <div class="card-tentang text-center">
                            <div class="stat-number secondary"><?= count($umkm_preview) ?>+</div>
                            <div class="text-muted small">UMKM Lokal</div>
                        </div>
                    </div>
                    <div class="col-6 sr sr-up" data-sr-delay="300">
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

<section id="highlights" class="highlights-section">
    <div class="container">
        <div class="text-center mb-5 sr sr-up">
            <span class="section-label">Daya Tarik</span>
            <h2 class="section-title">Tourism Highlights</h2>
            <p class="section-subtitle">Tiga pengalaman utama yang bisa Anda nikmati di Kampung Ketupat Warna Warni</p>
        </div>
        <div class="row justify-content-center g-4">
            <div class="col-lg-4 col-md-6 sr sr-up" data-sr-delay="0">
                <div class="highlight-card">
                    <div class="highlight-icon mx-auto"><i class="bi bi-bank"></i></div>
                    <h4 class="highlight-title">Wisata Budaya</h4>
                    <p>Saksikan proses menganyam ketupat dari daun nipah yang diwariskan turun-temurun. Tersedia spot foto ikonik dengan latar Jembatan Mahkota II.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 sr sr-up" data-sr-delay="120">
                <div class="highlight-card">
                    <div class="highlight-icon mx-auto"><i class="bi bi-cup-hot"></i></div>
                    <h4 class="highlight-title">Kuliner Ketupat Khas</h4>
                    <p>Nikmati Soto Banjar dan Coto Makassar dengan ketupat khas sambil menikmati suasana Sungai Mahakam.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 sr sr-up" data-sr-delay="240">
                <div class="highlight-card">
                    <div class="highlight-icon mx-auto"><i class="bi bi-sun"></i></div>
                    <h4 class="highlight-title">Suasana Tepi Mahakam</h4>
                    <p>Rasakan suasana santai di tepi Sungai Mahakam dengan pemandangan indah dan kampung yang fotogenik.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if (!empty($galeri_preview)): ?>
    <section class="kk-galeri" id="galeri">
        <div class="container">
            <div class="kk-galeri-header text-center sr sr-up">
                <span class="kk-label">GALERI</span>
                <h2 class="kk-title">Galeri Wisata</h2>
                <p class="kk-subtitle">Sekilas keindahan Kampung Ketupat Warna Warni</p>
            </div>
            <div class="row kk-grid">
                <?php foreach ($galeri_preview as $i => $foto): ?>
                    <?php
                    $src = str_starts_with($foto['foto'], 'http')
                        ? $foto['foto']
                        : BASE_URL . '/assets/uploads/galeri/' . $foto['foto'];
                    ?>
                    <div class="col-md-6 col-lg-4 sr sr-up" data-sr-delay="<?= $i * 80 ?>">
                        <div class="gallery-item">
                            <img src="<?= htmlspecialchars($src) ?>" alt="<?= htmlspecialchars($foto['judul']) ?>">
                            <div class="gallery-overlay">
                                <span class="gallery-caption"><?= htmlspecialchars($foto['judul']) ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="text-center mt-5 sr sr-up">
                <a href="<?= BASE_URL ?>/galeri" class="kk-btn-outline">
                    <i class="bi bi-images me-2"></i>Lihat Semua Foto
                </a>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if (!empty($event_preview)): ?>
    <section class="kk-event-section">
        <div class="container">

            <div class="text-center mb-5 sr sr-up">
                <span class="section-label">Agenda</span>
                <h2 class="section-title">Event Mendatang</h2>
                <p class="section-subtitle">Berbagai kegiatan menarik yang akan berlangsung di Kampung Ketupat</p>
            </div>

            <div class="row g-4">
                <?php foreach ($event_preview as $i => $ev): ?>
                    <?php
                    $statusMap = [
                        'berlangsung' => ['label' => 'Berlangsung', 'cls' => 'ev-status-live', 'dot' => '#16a34a'],
                        'akan_datang' => ['label' => 'Akan Datang', 'cls' => 'ev-status-soon', 'dot' => '#d97706'],
                        'selesai'     => ['label' => 'Selesai',    'cls' => 'ev-status-done', 'dot' => '#6b7280'],
                    ];
                    $st   = $statusMap[$ev['status']] ?? $statusMap['selesai'];
                    $desc = !empty($ev['deskripsi']) ? mb_strimwidth($ev['deskripsi'], 0, 90, '...') : '';
                    ?>
                    <div class="col-lg-4 col-md-6 sr sr-up" data-sr-delay="<?= $i * 100 ?>">
                        <div class="ev-card">

                            <div class="ev-top">
                                <div class="ev-date-badge">
                                    <span class="ev-day"><?= date('d', strtotime($ev['tanggal_mulai'])) ?></span>
                                    <span class="ev-month"><?= date('M Y', strtotime($ev['tanggal_mulai'])) ?></span>
                                </div>
                                <span class="ev-status <?= $st['cls'] ?>">
                                    <span class="ev-dot" style="background:<?= $st['dot'] ?>"></span>
                                    <?= $st['label'] ?>
                                </span>
                            </div>

                            <h5 class="ev-title"><?= htmlspecialchars($ev['nama_event']) ?></h5>

                            <?php if ($desc): ?>
                                <p class="ev-desc"><?= htmlspecialchars($desc) ?></p>
                            <?php endif; ?>

                            <div class="ev-meta">
                                <div class="ev-meta-item">
                                    <i class="bi bi-clock"></i>
                                    <?php if (!empty($ev['jam_mulai'])): ?>
                                        <?php
                                        $jm = date('H:i', strtotime($ev['jam_mulai']));
                                        $js = !empty($ev['jam_selesai']) ? date('H:i', strtotime($ev['jam_selesai'])) : '';
                                        if ($js !== '' && $js < $jm) {
                                            [$jm, $js] = [$js, $jm];
                                        }
                                        ?>
                                        <?= $jm ?>
                                        <?= $js !== '' ? '– ' . $js : '' ?> WITA
                                    <?php else: ?>
                                        Waktu menyusul
                                    <?php endif; ?>
                                </div>
                                <div class="ev-meta-item">
                                    <i class="bi bi-geo-alt"></i>
                                    <?= htmlspecialchars($ev['lokasi']) ?>
                                </div>
                            </div>

                            <?php if (!empty($ev['link_info'])): ?>
                                <a href="<?= htmlspecialchars($ev['link_info']) ?>" target="_blank" class="ev-link">
                                    <i class="bi bi-instagram"></i> Lihat Info Lengkap <i class="bi bi-arrow-right"></i>
                                </a>
                            <?php endif; ?>

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="text-center mt-5 sr sr-up">
                <a href="<?= BASE_URL ?>/event" class="kk-event-btn">
                    <i class="bi bi-calendar-event me-2"></i>Lihat Semua Event
                </a>
            </div>

        </div>
    </section>
<?php endif; ?>

<?php if (!empty($umkm_preview)): ?>
    <section class="section-kk">
        <div class="container">
            <div class="text-center mb-5 sr sr-up">
                <span class="section-label">UMKM Lokal</span>
                <h2 class="section-title">Usaha Masyarakat Kampung Ketupat</h2>
                <p class="section-subtitle">Dukung ekonomi lokal melalui produk UMKM warga</p>
            </div>
            <div class="row g-4">
                <?php foreach ($umkm_preview as $i => $u): ?>
                    <?php
                    $usrc = $u['foto']
                        ? BASE_URL . '/assets/uploads/umkm/' . $u['foto']
                        : 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=400&q=60';
                    ?>
                    <div class="col-sm-6 col-lg-3 sr sr-up" data-sr-delay="<?= $i * 80 ?>">
                        <div class="card-kk umkm-card h-100">
                            <div class="umkm-img">
                                <img src="<?= htmlspecialchars($usrc) ?>" alt="<?= htmlspecialchars($u['nama_umkm']) ?>" loading="lazy" />
                            </div>
                            <div class="card-body">
                                <span class="umkm-badge"><?= htmlspecialchars($u['kategori']) ?></span>
                                <h6 class="umkm-title"><?= htmlspecialchars($u['nama_umkm']) ?></h6>
                                <div class="umkm-meta">
                                    <span class="umkm-owner"><i class="bi bi-people me-1"></i><?= htmlspecialchars($u['pemilik']) ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="text-center mt-4 sr sr-up">
                <a href="<?= BASE_URL ?>/umkm" class="btn btn-kk-outline"><i class="bi bi-shop me-2"></i>Lihat Semua UMKM</a>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if (!empty($pesanPublik)): ?>
    <section class="section-kk" style="padding-top:20px;background:linear-gradient(180deg,#eef6f1 0%,#dfeee6 100%);">
        <div class="container">
            <div class="text-center my-5 sr sr-up">
                <span class="section-label">Suara Pengunjung</span>
                <h2 class="section-title" style="font-size:1.6rem;">Apa Kata Mereka?</h2>
            </div>
            <div class="row g-3">
                <?php
                $jenisCfg = [
                    'kritik'     => ['icon' => 'bi-exclamation-circle-fill', 'color' => '#e11d48', 'bg' => '#fff1f2'],
                    'saran'      => ['icon' => 'bi-lightbulb-fill',         'color' => '#15803d', 'bg' => '#f0fdf4'],
                    'pertanyaan' => ['icon' => 'bi-question-circle-fill',   'color' => '#2563eb', 'bg' => '#eff6ff'],
                    'apresiasi'  => ['icon' => 'bi-heart-fill',             'color' => '#9333ea', 'bg' => '#fdf4ff'],
                ];
                foreach ($pesanPublik as $i => $p):
                    $cfg = $jenisCfg[$p['jenis']] ?? ['icon' => 'bi-chat', 'color' => '#6b7280', 'bg' => '#f3f4f6'];
                ?>
                    <div class="col-md-6 col-lg-4 sr sr-up" data-sr-delay="<?= ($i % 3) * 100 ?>">
                        <div class="ks-publik-card">
                            <div class="ks-publik-top">
                                <span class="ks-publik-jenis" style="color:<?= $cfg['color'] ?>;background:<?= $cfg['bg'] ?>;">
                                    <i class="bi <?= $cfg['icon'] ?>"></i> <?= ucfirst($p['jenis']) ?>
                                </span>
                            </div>
                            <p class="ks-publik-pesan">"<?= nl2br(htmlspecialchars($p['pesan'])) ?>"</p>
                            <div class="ks-publik-footer">
                                <div class="ks-publik-avatar"><?= mb_strtoupper(mb_substr($p['nama_pengunjung'], 0, 1)) ?></div>
                                <div>
                                    <div class="ks-publik-nama"><?= htmlspecialchars($p['nama_pengunjung']) ?></div>
                                    <div class="ks-publik-tgl"><?= date('d M Y', strtotime($p['created_at'])) ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<section class="cta-kk">
    <div class="container text-center">
        <h2 class="cta-title">Ingin Berkunjung?</h2>
        <p class="cta-subtitle">Temukan lokasi kami dan rencanakan kunjungan Anda ke Kampung Ketupat Warna Warni Samarinda.</p>
        <div class="cta-buttons">
            <a href="<?= BASE_URL ?>/lokasi" class="btn btn-cta-primary"><i class="bi bi-geo-alt me-2"></i>Lihat Lokasi & Peta</a>
            <a href="<?= BASE_URL ?>/kritik-saran" class="btn btn-cta-outline"><i class="bi bi-chat-heart me-2"></i>Berikan Saran</a>
        </div>
    </div>
</section>

<script>
    (function() {
        var allEls = document.querySelectorAll('.sr');

        var observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (!entry.isIntersecting) return;

                var el = entry.target;
                var delay = parseInt(el.getAttribute('data-sr-delay') || '0', 10);

                setTimeout(function() {
                    el.classList.add('sr-done');
                }, delay);

                observer.unobserve(el);
            });
        }, {
            threshold: 0.08,
            rootMargin: '0px 0px -30px 0px'
        });

        allEls.forEach(function(el) {
            observer.observe(el);
        });

    })();
</script>

<?php require_once BASE_PATH . '/app/views/user/layouts/footer.php'; ?>