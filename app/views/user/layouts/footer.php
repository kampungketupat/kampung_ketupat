<footer class="footer-kk mt-auto">
    <div class="container">
        <div class="row gy-4 py-5">

            <div class="col-lg-4 col-md-6">
                <h5 class="footer-brand mb-3">
                    Kampung Ketupat <span class="text-accent">Warna Warni</span>
                </h5>

                <p class="text-muted-light small">
                    Destinasi wisata budaya dan kuliner di tepi Sungai Mahakam, Samarinda Seberang,
                    Kalimantan Timur. Dikelola oleh <strong>Pokdarwis</strong> bersama Disporapar Kota Samarinda.
                </p>

                <div class="d-flex gap-3 mt-3">
                    <a href="https://www.instagram.com/kampungketupatsmd_/" target="_blank" class="footer-sosmed">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a href="#" class="footer-sosmed"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="footer-sosmed"><i class="bi bi-youtube"></i></a>
                    <a href="#" class="footer-sosmed"><i class="bi bi-tiktok"></i></a>
                </div>
            </div>

            <div class="col-lg-2 col-md-6 col-6">
                <h6 class="footer-heading">Navigasi</h6>
                <ul class="footer-links list-unstyled">
                    <li><a href="<?= BASE_URL ?>">Beranda</a></li>
                    <li><a href="<?= BASE_URL ?>/wisata">Detail Wisata</a></li>
                    <li><a href="<?= BASE_URL ?>/galeri">Galeri</a></li>
                    <li><a href="<?= BASE_URL ?>/event">Event</a></li>
                    <li><a href="<?= BASE_URL ?>/umkm">UMKM Lokal</a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-6 col-6">
                <h6 class="footer-heading">Informasi</h6>
                <ul class="footer-links list-unstyled">
                    <li><a href="<?= BASE_URL ?>/lokasi">Lokasi</a></li>
                    <li><a href="<?= BASE_URL ?>/kontak">Kontak</a></li>
                    <li><a href="<?= BASE_URL ?>/kritik-saran">Kritik & Saran</a></li>
                    <li><a href="<?= BASE_URL ?>/admin/login">Admin</a></li>
                </ul>
            </div>

            <div class="col-lg-4 col-md-6">
                <h6 class="footer-heading">Info Kunjungan</h6>
                <ul class="list-unstyled small text-muted-light">
                    <li class="mb-2">
                        <i class="bi bi-geo-alt-fill text-accent me-2"></i>
                        Jl. Mangkupalas, Samarinda Seberang, Kaltim
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-clock-fill text-accent me-2"></i>
                        Setiap Hari: 08.30 – 17.30 WITA
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-ticket-perforated-fill text-accent me-2"></i>
                        Tiket Masuk: <strong>Gratis</strong>
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-car-front-fill text-accent me-2"></i>
                        ±26 menit dari pusat Kota Samarinda
                    </li>
                </ul>
            </div>

        </div>

        <hr class="footer-divider">

        <div class="footer-bottom">
            <p>© <?= date('Y') ?> Kampung Ketupat Warna Warni Samarinda</p>
            <p>Dibuat oleh <strong>Kelompok 2</strong> — SI Unmul</p>
        </div>

    </div>
</footer>


<script src="<?= BASE_URL ?>/assets/js/app.js?v=<?= time() ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?= BASE_URL ?>/assets/js/swal-helper.js"></script>

<?php if (!empty($_SESSION['success'])): ?>
    <script>
        SwalHelper.success("<?= $_SESSION['success'] ?>");
    </script>
<?php unset($_SESSION['success']);
endif; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>