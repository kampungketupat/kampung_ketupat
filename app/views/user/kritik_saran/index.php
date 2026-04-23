<?php require_once BASE_PATH . '/app/views/user/layouts/header.php'; ?>
<?php
// fallback biar aman
$pesan_sukses = $pesan_sukses ?? null;
$pesan_error  = $pesan_error ?? null;
?>

<section class="section-kk" style="padding-top:50px;">
    <div class="container">

        <!-- TITLE -->
        <div class="text-center mb-5 reveal">
            <span class="section-label">Pendapat Anda</span>
            <h1 class="section-title">Kritik & Saran</h1>
            <p class="section-subtitle">
                Bantu kami meningkatkan kualitas wisata
            </p>
        </div>

        <div class="row justify-content-center">

            <div class="col-lg-7 reveal">

                <!-- SUCCESS -->
                <?php if ($pesan_sukses): ?>
                    <div class="alert alert-success mb-4">
                        <i class="bi bi-check-circle me-2"></i>
                        <?= htmlspecialchars($pesan_sukses) ?>
                    </div>
                <?php endif; ?>

                <!-- ERROR -->
                <?php if ($pesan_error): ?>
                    <div class="alert alert-danger mb-4">
                        <i class="bi bi-exclamation-circle me-2"></i>
                        <?= htmlspecialchars($pesan_error) ?>
                    </div>
                <?php endif; ?>

                <div class="card-kk card-body p-5">

                    <h5 class="mb-4 text-center fs-4" style="color:var(--kk-primary); font-family: Playfair Display;">
                        <i class="bi bi-chat-heart me-2"></i>Kirim Pesan
                    </h5>

                    <!-- FORM -->
                    <form id="form-kritik-saran" action="<?= BASE_URL ?>/kritik-saran" method="POST">

                        <!-- Vue Form -->
                        <div id="app-kritik-saran"></div>

                    </form>

                </div>

            </div>

        </div>

    </div>
</section>

<?php require_once BASE_PATH . '/app/views/user/layouts/footer.php'; ?>