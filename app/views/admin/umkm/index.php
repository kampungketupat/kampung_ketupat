<?php
$menu_aktif = 'umkm';
require_once BASE_PATH . '/app/views/admin/layouts/header.php';
?>

<?php if (!empty($pesan_sukses)): ?>
    <div class="alert-kk-success mb-3"><?= htmlspecialchars($pesan_sukses) ?></div>
<?php endif; ?>

<?php if (!empty($pesan_error)): ?>
    <div class="alert-kk-error mb-3"><?= htmlspecialchars($pesan_error) ?></div>
<?php endif; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h6 class="fw-bold mb-0">Total: <?= count($semua_umkm) ?> UMKM</h6>

    <a href="<?= BASE_URL ?>/admin/umkm/create" class="btn btn-kk btn-sm">
        <i class="bi bi-plus-lg me-1"></i>Tambah UMKM
    </a>
</div>

<?php if (empty($semua_umkm)): ?>

    <div class="text-center py-5 text-muted">
        <i class="bi bi-shop fs-1 d-block mb-2"></i>
        Belum ada UMKM terdaftar.
    </div>

<?php else: ?>

    <div class="table-responsive">
        <table class="table table-hover align-middle">

            <thead class="table-light">
                <tr>
                    <th>Nama UMKM</th>
                    <th>Pemilik</th>
                    <th>Kategori</th>
                    <th>Kontak</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($semua_umkm as $u): ?>
                    <tr>

                        <td class="fw-500"><?= htmlspecialchars($u['nama_umkm']) ?></td>

                        <td><?= htmlspecialchars($u['pemilik'] ?? '-') ?></td>

                        <td>
                            <span class="badge bg-success">
                                <?= ucfirst($u['kategori']) ?>
                            </span>
                        </td>

                        <td class="small">
                            <?= htmlspecialchars($u['kontak'] ?? '-') ?>
                        </td>

                        <td>
                            <!-- EDIT -->
                            <a href="<?= BASE_URL ?>/admin/umkm/edit?id=<?= $u['id'] ?>"
                                class="btn btn-outline-primary btn-sm me-1">
                                <i class="bi bi-pencil"></i>
                            </a>

                            <!-- DELETE -->
                            <button type="button"
                                class="btn btn-outline-danger btn-sm"
                                onclick="return confirm('Hapus UMKM ini?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
    </div>

<?php endif; ?>

<?php require_once BASE_PATH . '/app/views/admin/layouts/footer.php'; ?>