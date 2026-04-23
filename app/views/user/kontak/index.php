<?php require_once BASE_PATH . '/app/views/user/layouts/header.php'; ?>

<section class="section-kk" style="padding-top:60px;">
    <div class="container">

        <!-- TITLE -->
        <div class="text-center mb-5 reveal">
            <span class="section-label">Hubungi Kami</span>
            <h1 class="section-title">Kontak & Informasi</h1>
            <p class="section-subtitle">
                Kami siap membantu dan menerima masukan Anda
            </p>
        </div>

        <div class="row justify-content-center">

            <div class="col-lg-8 reveal">
                <div class="card-kk p-4 kontak-clean">

                    <!-- ITEM -->
                    <div class="kontak-row">
                        <div class="kontak-icon"><i class="bi bi-geo-alt-fill"></i></div>
                        <div>
                            <h6>Alamat</h6>
                            <p>Jl. Mangkupalas, Samarinda Seberang, Kalimantan Timur</p>
                        </div>
                    </div>

                    <div class="kontak-row">
                        <div class="kontak-icon"><i class="bi bi-person-fill"></i></div>
                        <div>
                            <h6>Ketua Pokdarwis</h6>
                            <p>H. Abdul Azis</p>
                        </div>
                    </div>

                    <div class="kontak-row">
                        <div class="kontak-icon"><i class="bi bi-telephone-fill"></i></div>
                        <div>
                            <h6>Telepon</h6>
                            <p>Silakan kunjungi langsung</p>
                        </div>
                    </div>

                    <div class="kontak-row">
                        <div class="kontak-icon instagram"><i class="bi bi-instagram"></i></div>
                        <div>
                            <h6>Instagram</h6>
                            <p>@kampungketupat_samarinda</p>
                        </div>
                    </div>

                    <div class="kontak-row">
                        <div class="kontak-icon facebook"><i class="bi bi-facebook"></i></div>
                        <div>
                            <h6>Facebook</h6>
                            <p>Kampung Ketupat Warna Warni</p>
                        </div>
                    </div>

                    <!-- CTA -->
                    <div class="text-center mt-4">
                        <a href="<?= BASE_URL ?>/kritik-saran" class="btn btn-kk px-4 py-2">
                            <i class="bi bi-chat-heart me-2"></i>Kirim Kritik & Saran
                        </a>
                    </div>

                </div>
            </div>

        </div>

    </div>
</section>

<?php require_once BASE_PATH . '/app/views/user/layouts/footer.php'; ?>