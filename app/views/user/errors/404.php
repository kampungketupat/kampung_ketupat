<?php require_once BASE_PATH . '/app/views/user/layouts/header.php'; ?>

<section class="section-kk d-flex align-items-center" style="min-height:80vh;">
    <div class="container text-center">

        <div class="card-kk mx-auto p-5" style="max-width:600px;">

            <h1 style="font-size:80px; font-weight:800; color:var(--kk-primary);">
                404
            </h1>

            <h4 class="mb-2">Halaman Tidak Ditemukan</h4>

            <p class="text-muted mb-4">
                Maaf, halaman yang kamu cari tidak tersedia atau sudah dipindahkan.
            </p>

            <a href="<?= BASE_URL ?>/" class="btn btn-kk">
                <i class="bi bi-house-door me-1"></i> Kembali ke Beranda
            </a>

        </div>

    </div>
</section>

<?php require_once BASE_PATH . '/app/views/user/layouts/footer.php'; ?>