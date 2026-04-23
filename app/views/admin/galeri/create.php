<?php
$menu_aktif = 'galeri';
require_once BASE_PATH . '/app/views/admin/layouts/header.php';
?>

<?php if (!empty($pesan_error)): ?>
    <div class="alert-kk-error mb-3"><?= htmlspecialchars($pesan_error) ?></div>
<?php endif; ?>

<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">

                <h6 class="fw-bold mb-4">Tambah Foto Galeri</h6>

                <form action="<?= BASE_URL ?>/admin/galeri/store"
                    method="POST"
                    enctype="multipart/form-data"
                    onsubmit="return submitForm(event)">

                    <!-- JUDUL -->
                    <div class="mb-3">
                        <label class="form-label fw-500">
                            Judul Foto <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="judul" class="form-control"
                            placeholder="Contoh: Monumen Ketupat Raksasa" required />
                    </div>

                    <!-- KATEGORI -->
                    <div class="mb-3">
                        <label class="form-label fw-500">Kategori</label>
                        <select name="kategori" class="form-select">
                            <option value="umum">Umum</option>
                            <option value="wisata">Wisata</option>
                            <option value="kuliner">Kuliner</option>
                            <option value="budaya">Budaya</option>
                            <option value="fasilitas">Fasilitas</option>
                        </select>
                    </div>

                    <!-- DESKRIPSI -->
                    <div class="mb-3">
                        <label class="form-label fw-500">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3"
                            placeholder="Deskripsi singkat foto..."></textarea>
                    </div>

                    <!-- FOTO -->
                    <div class="mb-4">
                        <label class="form-label fw-500">
                            Upload Foto <span class="text-danger">*</span>
                        </label>
                        <input type="file" name="foto" class="form-control"
                            accept=".jpg,.jpeg,.png,.webp" required />
                        <small class="text-muted">
                            Format: JPG, PNG, WEBP. Maks 5MB.
                        </small>
                    </div>

                    <!-- BUTTON -->
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-kk">
                            <i class="bi bi-save me-1"></i>Simpan
                        </button>
                        <a href="<?= BASE_URL ?>/admin/galeri" class="btn btn-outline-secondary">
                            Batal
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

<?php require_once BASE_PATH . '/app/views/admin/layouts/footer.php'; ?>