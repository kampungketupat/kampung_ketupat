<?php
$menu_aktif = 'kritik';
require_once BASE_PATH . '/app/views/admin/layouts/header.php';
?>

<?php if (!empty($pesan_sukses)): ?>
    <div class="alert-kk-success mb-3"><?= htmlspecialchars($pesan_sukses) ?></div>
<?php endif; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h6 class="fw-bold mb-0">Total: <?= count($semua_pesan) ?> pesan</h6>
</div>

<?php if (empty($semua_pesan)): ?>

    <div class="text-center py-5 text-muted">
        <i class="bi bi-chat-x fs-1 d-block mb-2"></i>
        Belum ada pesan masuk.
    </div>

<?php else: ?>

    <div class="row g-3">

        <?php foreach ($semua_pesan as $p): ?>
            <div class="col-md-6 col-lg-4">

                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">

                        <!-- HEADER -->
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <strong><?= htmlspecialchars($p['nama_pengunjung']) ?></strong>

                                <?php if (!$p['sudah_dibaca']): ?>
                                    <span class="badge bg-warning text-dark ms-1">Baru</span>
                                <?php endif; ?>
                            </div>

                            <span class="badge bg-secondary">
                                <?= ucfirst($p['jenis']) ?>
                            </span>
                        </div>

                        <!-- EMAIL -->
                        <?php if (!empty($p['email'])): ?>
                            <small class="text-muted">
                                <i class="bi bi-envelope me-1"></i>
                                <?= htmlspecialchars($p['email']) ?>
                            </small><br />
                        <?php endif; ?>

                        <!-- PESAN -->
                        <p class="mt-2 mb-2 small">
                            <?= nl2br(htmlspecialchars($p['pesan'])) ?>
                        </p>

                        <!-- FOOTER -->
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <small class="text-muted">
                                <?= date('d M Y, H:i', strtotime($p['created_at'])) ?>
                            </small>

                            <!-- DELETE -->
                            <button type="button"
                                class="btn btn-outline-danger btn-sm"
                                onclick="hapus('<?= BASE_URL ?>/admin/kritik-saran/delete?id=<?= $p['id'] ?>')">
                                <i class="bi bi-trash"></i>
                            </button>

                        </div>

                    </div>
                </div>

            </div>
        <?php endforeach; ?>

    </div>

<?php endif; ?>

<?php require_once BASE_PATH . '/app/views/admin/layouts/footer.php'; ?>