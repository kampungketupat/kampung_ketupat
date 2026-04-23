<?php require_once BASE_PATH . '/app/views/user/layouts/header.php'; ?>

<section class="section-kk" style="padding-top:50px;">
    <div class="container">

        <!-- TITLE -->
        <div class="text-center mb-5 reveal">
            <span class="section-label">Informasi Lengkap</span>
            <h1 class="section-title">Detail Wisata Kampung Ketupat</h1>
            <p class="section-subtitle">
                Semua yang perlu Anda ketahui sebelum berkunjung
            </p>
        </div>

        <!-- INFO UTAMA -->
        <div class="row g-4 mb-5 align-items-stretch">

            <!-- KIRI -->
            <div class="col-lg-7 reveal">
                <div class="card-kk tentang-card h-100 p-4">

                    <div class="tentang-header mb-3">
                        <div class="tentang-icon">
                            <i class="bi bi-book"></i>
                        </div>

                        <h4 class="tentang-title">
                            Tentang Kampung Ketupat Warna Warni
                        </h4>
                    </div>

                    <div class="tentang-highlight mb-3">
                        Destinasi wisata budaya & kuliner di tepian
                        <strong>Sungai Mahakam</strong>
                    </div>

                    <p class="text-muted">
                        Kampung Ketupat Warna Warni merupakan salah satu ikon wisata Kota Samarinda
                        yang terkenal dengan <strong>rumah berwarna cerah</strong> dan monumen ketupat.
                    </p>

                    <p class="text-muted">
                        Sebagian besar masyarakat di kawasan ini berprofesi sebagai pengrajin ketupat
                        dari daun nipah, menjadikan tempat ini unik dan kaya budaya lokal.
                    </p>

                    <!-- LIST -->
                    <div class="tentang-list-v2 mt-3">

                        <div class="tentang-item">
                            <i class="bi bi-check"></i>
                            <span>Menawarkan pengalaman wisata budaya dan kuliner khas Samarinda</span>
                        </div>

                        <div class="tentang-item">
                            <i class="bi bi-check"></i>
                            <span>Daya tarik utama berupa rumah warna-warni yang unik dan estetik</span>
                        </div>

                        <div class="tentang-item">
                            <i class="bi bi-check"></i>
                            <span>Banyak spot foto menarik untuk dokumentasi & media sosial</span>
                        </div>

                    </div>

                </div>
            </div>

            <!-- KANAN -->
            <div class="col-lg-5 reveal">
                <div class="card-kk h-100 p-4">

                    <h5 class="judul-section mb-3">
                        <i class="bi bi-info-circle me-2"></i> Informasi Kunjungan
                    </h5>

                    <div class="info-box">

                        <div class="info-item">
                            <i class="bi bi-geo-alt-fill"></i>
                            <div>
                                <span>Alamat</span>
                                <p>Jl. Mangkupalas, Samarinda Seberang</p>
                            </div>
                        </div>

                        <div class="info-item">
                            <i class="bi bi-clock-fill"></i>
                            <div>
                                <span>Jam Buka</span>
                                <p>08.30 – 17.30 WITA</p>
                            </div>
                        </div>

                        <div class="info-item">
                            <i class="bi bi-ticket-perforated-fill"></i>
                            <div>
                                <span>Tiket</span>
                                <p><strong class="text-success">Gratis</strong></p>
                            </div>
                        </div>

                        <div class="info-item">
                            <i class="bi bi-car-front-fill"></i>
                            <div>
                                <span>Jarak</span>
                                <p>±26 menit</p>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>

        <!-- FASILITAS -->
        <div class="reveal mb-5">

            <div class="text-center mb-4">
                <h3 class="judul-section">
                    <i class="bi bi-grid me-2"></i>Fasilitas Tersedia
                </h3>
            </div>

            <div class="row g-3">
                <?php
                $fasilitas = [
                    ['icon' => 'bi-p-square', 'label' => 'Area Parkir'],
                    ['icon' => 'bi-person-bounding-box', 'label' => 'Toilet Umum'],
                    ['icon' => 'bi-building', 'label' => 'Musholla'],
                    ['icon' => 'bi-bag', 'label' => 'Kios Souvenir'],
                    ['icon' => 'bi-cup-hot', 'label' => 'Warung Makan'],
                    ['icon' => 'bi-tree', 'label' => 'Area Santai'],
                    ['icon' => 'bi-wifi', 'label' => 'WiFi'],
                    ['icon' => 'bi-camera', 'label' => 'Spot Foto'],
                ];

                foreach ($fasilitas as $f):
                ?>
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="fasilitas-item">
                            <div class="fasilitas-icon">
                                <i class="bi <?= $f['icon'] ?>"></i>
                            </div>
                            <div class="fasilitas-label"><?= $f['label'] ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>

        <!-- AKTIVITAS -->
        <div class="aktivitas-section reveal">

            <div class="text-center mb-5">
                <h3 class="judul-section">
                    <i class="bi bi-activity me-2"></i>Aktivitas Wisata
                </h3>
            </div>

            <div class="row g-4">

                <div class="col-md-6">
                    <div class="aktivitas-card-v2">
                        <div class="aktivitas-icon-v2">
                            <i class="bi bi-scissors"></i>
                        </div>
                        <div>
                            <h6>Menganyam Ketupat</h6>
                            <p>Belajar langsung dari pengrajin lokal.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="aktivitas-card-v2">
                        <div class="aktivitas-icon-v2">
                            <i class="bi bi-cup-hot"></i>
                        </div>
                        <div>
                            <h6>Kuliner Khas</h6>
                            <p>Soto Banjar & Coto Makassar dengan ketupat.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="aktivitas-card-v2">
                        <div class="aktivitas-icon-v2">
                            <i class="bi bi-camera"></i>
                        </div>
                        <div>
                            <h6>Spot Foto</h6>
                            <p>Monumen ketupat & rumah warna-warni.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="aktivitas-card-v2">
                        <div class="aktivitas-icon-v2">
                            <i class="bi bi-water"></i>
                        </div>
                        <div>
                            <h6>Sungai Mahakam</h6>
                            <p>Nikmati suasana tepi sungai.</p>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</section>

<?php require_once BASE_PATH . '/app/views/user/layouts/footer.php'; ?>