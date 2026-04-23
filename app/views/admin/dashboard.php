<?php
// =========================
// DATA FALLBACK (AMAN)
// =========================
$stats = $stats ?? [
    'galeri' => 0,
    'event'  => 0,
    'umkm'   => 0,
    'kritik' => 0
];

$pesan_terbaru = $pesan_terbaru ?? [];
?>

<div id="dashboardApp">

    <!-- ========================= -->
    <!-- STAT CARDS -->
    <!-- ========================= -->
    <div class="row g-4 mb-4">

        <div class="col-sm-6 col-lg-3">
            <div class="stat-card">
                <div class="text-muted small mb-1">
                    <i class="bi bi-images me-1"></i>Total Foto Galeri
                </div>
                <div class="stat-number"><?= htmlspecialchars($stats['galeri']) ?></div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="stat-card secondary">
                <div class="text-muted small mb-1">
                    <i class="bi bi-calendar-event me-1"></i>Event Aktif
                </div>
                <div class="stat-number"><?= htmlspecialchars($stats['event']) ?></div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="stat-card accent">
                <div class="text-muted small mb-1">
                    <i class="bi bi-shop me-1"></i>UMKM Terdaftar
                </div>
                <div class="stat-number"><?= htmlspecialchars($stats['umkm']) ?></div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="stat-card" style="border-left-color:var(--kk-secondary);">
                <div class="text-muted small mb-1">
                    <i class="bi bi-chat-heart me-1"></i>Pesan Belum Dibaca
                </div>
                <div class="stat-number"><?= htmlspecialchars($stats['kritik']) ?></div>
            </div>
        </div>

    </div>

    <!-- ========================= -->
    <!-- QUICK ACTIONS -->
    <!-- ========================= -->
    <div class="row g-3 mb-4">
        <div class="col-12">
            <div class="card p-3 border-0 shadow-sm">
                <h6 class="fw-bold mb-3">Aksi Cepat</h6>

                <div class="d-flex flex-wrap gap-2">

                    <a href="/admin/galeri/create" class="btn btn-kk btn-sm">
                        <i class="bi bi-plus-lg me-1"></i> Tambah Foto
                    </a>

                    <a href="/admin/event/create" class="btn btn-kk btn-sm">
                        <i class="bi bi-plus-lg me-1"></i> Tambah Event
                    </a>

                    <a href="/admin/umkm/create" class="btn btn-kk btn-sm">
                        <i class="bi bi-plus-lg me-1"></i> Tambah UMKM
                    </a>

                    <a href="/admin/kritik-saran" class="btn btn-outline-kk btn-sm">
                        <i class="bi bi-chat-heart me-1"></i> Lihat Kritik & Saran
                    </a>

                </div>
            </div>
        </div>
    </div>

    <!-- ========================= -->
    <!-- PESAN TERBARU -->
    <!-- ========================= -->
    <?php if (!empty($pesan_terbaru)): ?>
        <div class="card border-0 shadow-sm">
            <div class="card-body">

                <h6 class="fw-bold mb-3">
                    <i class="bi bi-envelope-paper me-2"></i>
                    Pesan Kritik & Saran Terbaru
                </h6>

                <div class="table-responsive">
                    <table class="table table-hover align-middle">

                        <thead class="table-light">
                            <tr>
                                <th>Nama</th>
                                <th>Jenis</th>
                                <th>Pesan</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($pesan_terbaru as $p): ?>
                                <tr>
                                    <td class="fw-500">
                                        <?= htmlspecialchars($p['nama_pengunjung']) ?>
                                    </td>

                                    <td>
                                        <span class="badge bg-secondary">
                                            <?= htmlspecialchars($p['jenis']) ?>
                                        </span>
                                    </td>

                                    <td class="text-muted small">
                                        <?= htmlspecialchars(substr($p['pesan'], 0, 60)) ?>...
                                    </td>

                                    <td class="small">
                                        <?= date('d M Y', strtotime($p['created_at'])) ?>
                                    </td>

                                    <td>
                                        <?php if ($p['sudah_dibaca']): ?>
                                            <span class="badge bg-success">Dibaca</span>
                                        <?php else: ?>
                                            <span class="badge bg-warning text-dark">Baru</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>

                <a href="<?= BASE_URL ?>/admin/kritik-saran" class="btn btn-outline-kk btn-sm mt-3">
                    Lihat Semua Pesan
                </a>

            </div>
        </div>
    <?php else: ?>

        <!-- Kalau tidak ada pesan -->
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center text-muted">
                <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                Belum ada pesan masuk
            </div>
        </div>

    <?php endif; ?>

</div>