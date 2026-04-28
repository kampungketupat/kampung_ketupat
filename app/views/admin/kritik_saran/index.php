<?php
$menu_aktif = 'kritik';
require_once BASE_PATH . '/app/views/admin/layouts/header.php';
$tab_aktif = $tab_aktif ?? 'pending';
?>

<?php if (!empty($pesan_sukses)): ?>
    <div class="alert-kk-success mb-3"><?= htmlspecialchars($pesan_sukses) ?></div>
<?php endif; ?>
<?php if (!empty($pesan_error)): ?>
    <div class="alert-kk-error mb-3"><?= htmlspecialchars($pesan_error) ?></div>
<?php endif; ?>

<!-- PAGE HEADER -->
<div class="page-header">
    <div class="page-title">
        <p>
            <?= $tab_aktif === 'pending'
                ? 'Pesan masuk dari pengunjung — menunggu persetujuan admin'
                : 'Arsip pesan yang sudah diterima &amp; pengaturan publikasi ke publik' ?>
        </p>
    </div>
    <div class="ks-tab-switch">
        <a href="<?= BASE_URL ?>/admin/kritik-saran"
            class="ks-tab <?= $tab_aktif === 'pending' ? 'active' : '' ?>">
            <i class="bi bi-inbox"></i> Kotak Masuk
            <?php $pending = count($semua_pesan ?? []); ?>
            <?php if ($tab_aktif === 'pending' && $pending > 0): ?>
                <span class="ks-tab-badge"><?= $pending ?></span>
            <?php endif; ?>
        </a>
        <a href="<?= BASE_URL ?>/admin/kritik-saran/arsip"
            class="ks-tab <?= $tab_aktif === 'arsip' ? 'active' : '' ?>">
            <i class="bi bi-archive"></i> Arsip
            <?php if ($tab_aktif === 'pending' && ($jumlah_arsip ?? 0) > 0): ?>
                <span class="ks-tab-badge ks-tab-badge-gray"><?= $jumlah_arsip ?></span>
            <?php endif; ?>
        </a>
    </div>
</div>

<!-- STAT CARDS -->
<div class="stat-grid mb-4">
    <div class="stat-card">
        <div class="stat-icon ks-total"><i class="bi bi-chat-dots"></i></div>
        <div class="stat-info"><span>Total Pesan</span>
            <h4><?= count($semua_pesan ?? []) ?></h4>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon ks-kritik"><i class="bi bi-exclamation-circle"></i></div>
        <div class="stat-info"><span>Kritik</span>
            <h4><?= $total_kritik ?? 0 ?></h4>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon ks-saran"><i class="bi bi-lightbulb"></i></div>
        <div class="stat-info"><span>Saran</span>
            <h4><?= $total_saran ?? 0 ?></h4>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon ks-apresiasi"><i class="bi bi-heart"></i></div>
        <div class="stat-info"><span>Apresiasi</span>
            <h4><?= $total_apresiasi ?? 0 ?></h4>
        </div>
    </div>
</div>

<!-- FILTER BAR -->
<div class="search-filter-bar mb-4">
    <div class="filter-box">
        <i class="bi bi-funnel"></i>
        <select id="filterJenis">
            <option value="">Semua Jenis</option>
            <option value="kritik">Kritik</option>
            <option value="saran">Saran</option>
            <option value="pertanyaan">Pertanyaan</option>
            <option value="apresiasi">Apresiasi</option>
        </select>
    </div>
    <?php if ($tab_aktif === 'arsip'): ?>
        <div class="filter-box">
            <i class="bi bi-eye"></i>
            <select id="filterStatus">
                <option value="">Semua Status Publik</option>
                <option value="publik">Sedang Tayang</option>
                <option value="diterima">Tidak Tayang</option>
            </select>
        </div>
    <?php else: ?>
        <div class="filter-box">
            <i class="bi bi-envelope"></i>
            <select id="filterBaca">
                <option value="">Semua Status Baca</option>
                <option value="baru">Belum Dibaca</option>
                <option value="dibaca">Sudah Dibaca</option>
            </select>
        </div>
    <?php endif; ?>
</div>

<!-- KARTU PESAN -->
<?php if (empty($semua_pesan)): ?>
    <div class="empty-state">
        <i class="bi bi-<?= $tab_aktif === 'arsip' ? 'archive' : 'inbox' ?>"></i>
        <p><?= $tab_aktif === 'arsip' ? 'Belum ada pesan di arsip.' : 'Tidak ada pesan masuk.' ?></p>
    </div>
<?php else: ?>

    <div class="ks-grid" id="pesanGrid">
        <?php foreach ($semua_pesan as $p):
            $jenisCfg = [
                'kritik'     => ['icon' => 'bi-exclamation-circle-fill', 'class' => 'ks-badge-kritik',     'label' => 'Kritik'],
                'saran'      => ['icon' => 'bi-lightbulb-fill',          'class' => 'ks-badge-saran',      'label' => 'Saran'],
                'pertanyaan' => ['icon' => 'bi-question-circle-fill',    'class' => 'ks-badge-pertanyaan', 'label' => 'Pertanyaan'],
                'apresiasi'  => ['icon' => 'bi-heart-fill',              'class' => 'ks-badge-apresiasi',  'label' => 'Apresiasi'],
            ];
            $cfg    = $jenisCfg[$p['jenis']] ?? ['icon' => 'bi-chat', 'class' => 'ks-badge-saran', 'label' => ucfirst($p['jenis'])];
            $isBaru = !$p['sudah_dibaca'];
            $isPubik = $p['status'] === 'publik';
        ?>

            <div class="ks-card <?= $isBaru ? 'ks-card-baru' : '' ?> <?= $isPubik ? 'ks-card-publik' : '' ?>"
                data-jenis="<?= $p['jenis'] ?>"
                data-baca="<?= $isBaru ? 'baru' : 'dibaca' ?>"
                data-status="<?= $p['status'] ?>">

                <!-- HEADER -->
                <div class="ks-card-header">
                    <div class="ks-card-meta">
                        <span class="ks-badge <?= $cfg['class'] ?>">
                            <i class="bi <?= $cfg['icon'] ?>"></i> <?= $cfg['label'] ?>
                        </span>
                        <?php if ($isBaru && $tab_aktif === 'pending'): ?>
                            <span class="ks-new-dot" title="Belum dibaca"></span>
                        <?php endif; ?>
                        <?php if ($isPubik): ?>
                            <span class="ks-publik-badge">
                                <i class="bi bi-broadcast"></i> Tayang
                            </span>
                        <?php endif; ?>
                    </div>

                    <!-- TOMBOL AKSI -->
                    <div class="ks-card-actions">
                        <?php if ($tab_aktif === 'pending'): ?>
                            <!-- TERIMA → arsip -->
                            <button class="ks-btn-terima" title="Terima & simpan ke arsip"
                                onclick="terima('<?= $p['id'] ?>')">
                                <i class="bi bi-check-lg"></i>
                            </button>
                        <?php else: ?>
                            <?php if ($isPubik): ?>
                                <!-- SEMBUNYIKAN -->
                                <button class="ks-btn-sembunyikan" title="Sembunyikan dari publik"
                                    onclick="sembunyikan('<?= $p['id'] ?>')">
                                    <i class="bi bi-eye-slash"></i>
                                </button>
                            <?php else: ?>
                                <!-- TAMPILKAN KE PUBLIK -->
                                <button class="ks-btn-tampilkan" title="Tampilkan ke publik"
                                    onclick="tampilkan('<?= $p['id'] ?>')">
                                    <i class="bi bi-eye"></i>
                                </button>
                            <?php endif; ?>
                            <!-- KEMBALIKAN KE PENDING -->
                            <button class="ks-btn-kembali" title="Kembalikan ke kotak masuk"
                                onclick="kembalikan('<?= $p['id'] ?>')">
                                <i class="bi bi-arrow-counterclockwise"></i>
                            </button>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- PENGIRIM -->
                <div class="ks-sender">
                    <div class="ks-avatar">
                        <?= mb_strtoupper(mb_substr($p['nama_pengunjung'], 0, 1)) ?>
                    </div>
                    <div>
                        <div class="ks-sender-name"><?= htmlspecialchars($p['nama_pengunjung']) ?></div>
                        <?php if (!empty($p['email'])): ?>
                            <div class="ks-sender-email">
                                <i class="bi bi-envelope me-1"></i><?= htmlspecialchars($p['email']) ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- ISI PESAN -->
                <p class="ks-pesan"><?= nl2br(htmlspecialchars($p['pesan'])) ?></p>

                <!-- FOOTER -->
                <div class="ks-card-footer">
                    <span class="ks-time">
                        <i class="bi bi-clock me-1"></i>
                        <?= date('d M Y, H:i', strtotime($p['created_at'])) ?>
                    </span>
                    <?php if ($isPubik && !empty($p['tampil_mulai'])): ?>
                        <span class="ks-publik-info">
                            <i class="bi bi-calendar-range me-1"></i>
                            <?= date('d M', strtotime($p['tampil_mulai'])) ?>
                            – <?= date('d M Y', strtotime($p['tampil_selesai'])) ?>
                        </span>
                    <?php endif; ?>
                </div>

            </div>
        <?php endforeach; ?>
    </div>

    <div id="emptyFiltered" class="empty-state d-none">
        <i class="bi bi-funnel"></i>
        <p>Tidak ada pesan yang cocok dengan filter.</p>
    </div>

<?php endif; ?>

<!-- SCRIPT -->
<script>
    const filterJenis = document.getElementById('filterJenis');
    const filterBaca = document.getElementById('filterBaca');
    const filterStatus = document.getElementById('filterStatus');
    const grid = document.getElementById('pesanGrid');
    const emptyFiltered = document.getElementById('emptyFiltered');

    function applyFilter() {
        const jenis = filterJenis?.value ?? '';
        const baca = filterBaca?.value ?? '';
        const status = filterStatus?.value ?? '';
        let visible = 0;

        document.querySelectorAll('.ks-card').forEach(card => {
            const okJenis = !jenis || card.dataset.jenis === jenis;
            const okBaca = !baca || card.dataset.baca === baca;
            const okStatus = !status || card.dataset.status === status;
            const show = okJenis && okBaca && okStatus;
            card.style.display = show ? '' : 'none';
            if (show) visible++;
        });

        if (emptyFiltered) emptyFiltered.classList.toggle('d-none', visible > 0);
        if (grid) grid.style.display = visible === 0 ? 'none' : '';
    }

    filterJenis?.addEventListener('change', applyFilter);
    filterBaca?.addEventListener('change', applyFilter);
    filterStatus?.addEventListener('change', applyFilter);

    const BASE = '<?= BASE_URL ?>';

    function terima(id) {
        SwalHelper.confirm(
            'Terima Pesan',
            'Pesan akan dipindahkan ke arsip. Kamu bisa tampilkan ke publik dari sana.',
            BASE + '/admin/kritik-saran/terima',
            {
                id: id
            },
            '#16a34a'
        );
    }

    function kembalikan(id) {
        SwalHelper.confirm(
            'Kembalikan ke Kotak Masuk',
            'Pesan akan dikembalikan ke status pending.',
            BASE + '/admin/kritik-saran/kembalikan',
            {
                id: id
            },
            '#6b7280'
        );
    }

    function tampilkan(id) {
        SwalHelper.confirmPublish(BASE + '/admin/kritik-saran/tampilkan', id);
    }

    function sembunyikan(id) {
        SwalHelper.confirm(
            'Sembunyikan dari Publik',
            'Pesan tidak akan ditampilkan lagi ke pengunjung.',
            BASE + '/admin/kritik-saran/sembunyikan',
            {
                id: id
            },
            '#e11d48'
        );
    }
</script>

<?php require_once BASE_PATH . '/app/views/admin/layouts/footer.php'; ?>