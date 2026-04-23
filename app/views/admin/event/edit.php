<?php
$menu_aktif = 'event';
require_once BASE_PATH . '/app/views/admin/layouts/header.php';
?>

<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">

                <h6 class="fw-bold mb-4">Edit Event</h6>

                <form action="<?= BASE_URL ?>/admin/event/update"
                    method="POST"
                    enctype="multipart/form-data"
                    onsubmit="return submitForm(event)">

                    <input type="hidden" name="id" value="<?= $event['id'] ?>" />

                    <!-- NAMA -->
                    <div class="mb-3">
                        <label class="form-label fw-500">Nama Event</label>
                        <input type="text" name="nama_event" class="form-control"
                            value="<?= htmlspecialchars($event['nama_event']) ?>" required />
                    </div>

                    <!-- DESKRIPSI -->
                    <div class="mb-3">
                        <label class="form-label fw-500">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3"><?= htmlspecialchars($event['deskripsi'] ?? '') ?></textarea>
                    </div>

                    <!-- TANGGAL -->
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label fw-500">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" class="form-control"
                                value="<?= $event['tanggal_mulai'] ?>" required />
                        </div>
                        <div class="col">
                            <label class="form-label fw-500">Tanggal Selesai</label>
                            <input type="date" name="tanggal_selesai" class="form-control"
                                value="<?= $event['tanggal_selesai'] ?>" />
                        </div>
                    </div>

                    <!-- JAM -->
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label fw-500">Jam Mulai</label>
                            <input type="time" name="jam_mulai" class="form-control"
                                value="<?= $event['jam_mulai'] ?? '' ?>" />
                        </div>
                        <div class="col">
                            <label class="form-label fw-500">Jam Selesai</label>
                            <input type="time" name="jam_selesai" class="form-control"
                                value="<?= $event['jam_selesai'] ?? '' ?>" />
                        </div>
                    </div>

                    <!-- LINK -->
                    <div class="mb-3">
                        <label class="form-label fw-500">Link Info</label>
                        <input type="text" name="link_info" class="form-control"
                            value="<?= htmlspecialchars($event['link_info'] ?? '') ?>" />
                    </div>

                    <!-- LOKASI -->
                    <div class="mb-3">
                        <label class="form-label fw-500">Lokasi</label>
                        <input type="text" name="lokasi" class="form-control"
                            value="<?= htmlspecialchars($event['lokasi']) ?>" />
                    </div>

                    <!-- STATUS -->
                    <div class="mb-3">
                        <label class="form-label fw-500">Status</label>
                        <select name="status" class="form-select">
                            <?php foreach (['akan_datang', 'berlangsung', 'selesai'] as $s): ?>
                                <option value="<?= $s ?>" <?= $event['status'] === $s ? 'selected' : '' ?>>
                                    <?= ucwords(str_replace('_', ' ', $s)) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- FOTO -->
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
                        <a href="<?= BASE_URL ?>/admin/event" class="btn btn-outline-secondary">Batal</a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

<?php require_once BASE_PATH . '/app/views/admin/layouts/footer.php'; ?>