<?php
$menu_aktif = 'galeri';
require_once BASE_PATH . '/app/views/admin/layouts/header.php';
?>

<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">

                <h6 class="fw-bold mb-4">Edit Foto Galeri</h6>

                <form action="<?= BASE_URL ?>/admin/galeri/update"
                    method="POST"
                    enctype="multipart/form-data"
                    onsubmit="return submitForm(event)">

                    <input type="hidden" name="id" value="<?= $galeri['id'] ?>" />

                    <!-- JUDUL -->
                    <div class="mb-3">
                        <label class="form-label fw-500">
                            Judul Foto <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="judul" class="form-control"
                            value="<?= htmlspecialchars($galeri['judul']) ?>" required />
                    </div>

                    <!-- KATEGORI -->
                    <div class="mb-3">
                        <label class="form-label fw-500">Kategori</label>
                        <select name="kategori" class="form-select">
                            <?php foreach (['umum', 'wisata', 'kuliner', 'budaya', 'fasilitas'] as $kat): ?>
                                <option value="<?= $kat ?>" <?= $galeri['kategori'] === $kat ? 'selected' : '' ?>>
                                    <?= ucfirst($kat) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- DESKRIPSI -->
                    <div class="mb-3">
                        <label class="form-label fw-500">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3"><?= htmlspecialchars($galeri['deskripsi'] ?? '') ?></textarea>
                    </div>

                    <!-- FOTO SAAT INI -->
                    <div class="mb-3">
                        <?php
                        $src = str_starts_with($galeri['foto'], 'http')
                            ? $galeri['foto']
                            : BASE_URL . '/assets/uploads/galeri/' . $galeri['foto'];
                        ?>
                        <label class="form-label fw-500">Foto Saat Ini</label>
                        <div>
                            <img src="<?= htmlspecialchars($src) ?>"
                                style="height:120px;border-radius:8px;object-fit:cover;" />
                        </div>
                    </div>

                    <!-- GANTI FOTO -->
                    <div class="mb-4">
                        <label class="form-label fw-500">
                            Ganti Foto <small class="text-muted">(opsional)</small>
                        </label>
                        <input type="file" name="foto" class="form-control" accept=".jpg,.jpeg,.png,.webp" />
                    </div>

                    <!-- BUTTON -->
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-kk">
                            <i class="bi bi-save me-1"></i>Perbarui
                        </button>
                        <a href="<?= BASE_URL ?>/admin/galeri" class="btn btn-outline-kk">
                            Batal
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

<?php require_once BASE_PATH . '/app/views/admin/layouts/footer.php'; ?>