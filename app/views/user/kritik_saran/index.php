<?php require_once BASE_PATH . '/app/views/user/layouts/header.php'; ?>
<?php
$pesan_sukses = $pesan_sukses ?? null;
$pesan_error  = $pesan_error  ?? null;

// Ambil pesan publik yang sedang tayang
require_once BASE_PATH . '/app/models/KritikSaranModel.php';
global $koneksi;
$ksModel     = new KritikSaranModel($koneksi);
$pesanPublik = $ksModel->getPublik();
?>

<!-- ═══════════════════════════════════════
     SECTION JUDUL
════════════════════════════════════════ -->
<section class="section-kk" style="padding-top:50px; padding-bottom: 30px;">
    <div class="container">

        <div class="text-center mb-5 reveal">
            <span class="section-label">Pendapat Anda</span>
            <h1 class="section-title">Kritik &amp; Saran</h1>
            <p class="section-subtitle">Bantu kami meningkatkan kualitas wisata</p>
        </div>

        <!-- ═══ FORM KIRIM ═══ -->
        <div class="row justify-content-center">
            <div class="col-lg-7 reveal">

                <?php if ($pesan_sukses): ?>
                    <div class="alert alert-success mb-4">
                        <i class="bi bi-check-circle me-2"></i>
                        <?= htmlspecialchars($pesan_sukses) ?>
                    </div>
                <?php endif; ?>

                <?php if ($pesan_error): ?>
                    <div class="alert alert-danger mb-4">
                        <i class="bi bi-exclamation-circle me-2"></i>
                        <?= htmlspecialchars($pesan_error) ?>
                    </div>
                <?php endif; ?>

                <div class="card-kk card-body p-5">
                    <h5 class="mb-4 text-center fs-4"
                        style="color:var(--kk-primary); font-family: Playfair Display;">
                        <i class="bi bi-chat-heart me-2"></i>Kirim Pesan
                    </h5>

                    <form id="form-kritik-saran"
                        action="<?= BASE_URL ?>/kritik-saran"
                        method="POST">
                        <?= csrf_field() ?>
                        <div id="app-kritik-saran"></div>
                    </form>
                </div>

            </div>
        </div>

    </div>
</section>

<!-- ═══════════════════════════════════════
     SECTION SUARA PENGUNJUNG (PUBLIK)
════════════════════════════════════════ -->
<?php if (!empty($pesanPublik)): ?>
    <section class="section-kk" style="padding-top: 20px;">
        <div class="container">

            <div class="text-center mb-4 reveal">
                <span class="section-label">Suara Pengunjung</span>
                <h2 class="section-title" style="font-size:1.6rem;">Apa Kata Mereka?</h2>
            </div>

            <div class="row g-3">
                <?php
                $jenisCfg = [
                    'kritik'     => ['icon' => 'bi-exclamation-circle-fill', 'color' => '#e11d48', 'bg' => '#fff1f2'],
                    'saran'      => ['icon' => 'bi-lightbulb-fill',          'color' => '#15803d', 'bg' => '#f0fdf4'],
                    'pertanyaan' => ['icon' => 'bi-question-circle-fill',    'color' => '#2563eb', 'bg' => '#eff6ff'],
                    'apresiasi'  => ['icon' => 'bi-heart-fill',              'color' => '#9333ea', 'bg' => '#fdf4ff'],
                ];
                foreach ($pesanPublik as $p):
                    $cfg = $jenisCfg[$p['jenis']] ?? ['icon' => 'bi-chat', 'color' => '#6b7280', 'bg' => '#f3f4f6'];
                ?>
                    <div class="col-md-6 col-lg-4 reveal">
                        <div class="ks-publik-card">

                            <div class="ks-publik-top">
                                <span class="ks-publik-jenis"
                                    style="color:<?= $cfg['color'] ?>;background:<?= $cfg['bg'] ?>;">
                                    <i class="bi <?= $cfg['icon'] ?>"></i>
                                    <?= ucfirst($p['jenis']) ?>
                                </span>
                            </div>

                            <p class="ks-publik-pesan">
                                "<?= nl2br(htmlspecialchars($p['pesan'])) ?>"
                            </p>

                            <div class="ks-publik-footer">
                                <div class="ks-publik-avatar">
                                    <?= mb_strtoupper(mb_substr($p['nama_pengunjung'], 0, 1)) ?>
                                </div>
                                <div>
                                    <div class="ks-publik-nama">
                                        <?= htmlspecialchars($p['nama_pengunjung']) ?>
                                    </div>
                                    <div class="ks-publik-tgl">
                                        <?= date('d M Y', strtotime($p['created_at'])) ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </section>
<?php endif; ?>

<?php require_once BASE_PATH . '/app/views/user/layouts/footer.php'; ?>
