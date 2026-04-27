<?php
$menu_aktif = 'umkm';
require_once BASE_PATH . '/app/views/admin/layouts/header.php';
?>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">

                <h6 class="fw-bold mb-4">Tambah UMKM Lokal</h6>

                <form action="<?= BASE_URL ?>/admin/umkm/store" method="POST" enctype="multipart/form-data" onsubmit="return submitForm(event)">

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-500">
                                Nama UMKM <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="nama_umkm" class="form-control" required />
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-500">Pemilik</label>
                            <input type="text" name="pemilik" class="form-control" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-500">Kategori</label>
                            <select name="kategori" class="form-select">
                                <option value="kuliner">Kuliner</option>
                                <option value="kerajinan">Kerajinan</option>
                                <option value="souvenir">Souvenir</option>
                                <option value="jasa">Jasa</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-500">Kontak</label>
                            <input type="text" name="kontak" class="form-control"
                                placeholder="No. HP / WhatsApp" />
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-500">Produk Unggulan</label>
                        <input type="text" name="produk_unggulan" class="form-control" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-500">Alamat</label>
                        <input type="text" name="alamat" class="form-control" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-500">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-500">Foto UMKM</label>
                        <input type="file" name="foto" class="form-control"
                            accept=".jpg,.jpeg,.png,.webp" />
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-kk">
                            <i class="bi bi-save me-1"></i>Simpan
                        </button>

                        <a href="<?= BASE_URL ?>/admin/umkm" class="btn btn-outline-kk">
                            Batal
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

<?php require_once BASE_PATH . '/app/views/admin/layouts/footer.php'; ?>