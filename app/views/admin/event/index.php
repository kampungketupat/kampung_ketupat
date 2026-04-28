<?php
$menu_aktif = 'event';
require_once BASE_PATH . '/app/views/admin/layouts/header.php';
?>

<?php if (!empty($pesan_sukses)): ?>
    <div class="alert-kk-success mb-3"><?= htmlspecialchars($pesan_sukses) ?></div>
<?php endif; ?>

<?php if (!empty($pesan_error)): ?>
    <div class="alert-kk-error mb-3"><?= htmlspecialchars($pesan_error) ?></div>
<?php endif; ?>

<div class="page-header">
    <div class="page-title">
        <p>Kelola &amp; atur jadwal event Kampung Ketupat</p>
    </div>
    <div class="page-actions">
        <a href="<?= BASE_URL ?>/admin/event/create" class="btn-modern primary">
            <i class="bi bi-plus-circle"></i>
            <span>Tambah Event</span>
        </a>
    </div>
</div>

<div class="search-filter-bar mb-4">

    <div class="search-box">
        <i class="bi bi-search"></i>
        <input type="text" id="searchInput" placeholder="Cari nama event...">
    </div>

    <div class="filter-box">
        <i class="bi bi-funnel"></i>
        <select id="filterStatus">
            <option value="">Semua Status</option>
            <option value="akan_datang">Akan Datang</option>
            <option value="berlangsung">Berlangsung</option>
            <option value="selesai">Selesai</option>
        </select>
    </div>

</div>

<?php
$total       = count($semua_event);
$akan_datang = count(array_filter($semua_event, fn($e) => $e['status'] === 'akan_datang'));
$berlangsung = count(array_filter($semua_event, fn($e) => $e['status'] === 'berlangsung'));
$selesai     = count(array_filter($semua_event, fn($e) => $e['status'] === 'selesai'));
?>

<div class="stat-grid mb-4">

    <div class="stat-card">
        <div class="stat-icon total">
            <i class="bi bi-calendar3"></i>
        </div>
        <div class="stat-info">
            <span>Total Event</span>
            <h4><?= $total ?></h4>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon warning">
            <i class="bi bi-clock"></i>
        </div>
        <div class="stat-info">
            <span>Akan Datang</span>
            <h4><?= $akan_datang ?></h4>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon success">
            <i class="bi bi-broadcast"></i>
        </div>
        <div class="stat-info">
            <span>Berlangsung</span>
            <h4><?= $berlangsung ?></h4>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon gray">
            <i class="bi bi-check-circle"></i>
        </div>
        <div class="stat-info">
            <span>Selesai</span>
            <h4><?= $selesai ?></h4>
        </div>
    </div>

</div>

<?php if (empty($semua_event)): ?>

    <div class="empty-state">
        <i class="bi bi-calendar-x"></i>
        <p>Belum ada event yang ditambahkan.</p>
        <a href="<?= BASE_URL ?>/admin/event/create" class="btn-modern primary mt-3">
            <i class="bi bi-plus-circle"></i> Tambah Event Pertama
        </a>
    </div>

<?php else: ?>

    <div class="table-card">
        <table class="event-table" id="eventTable">

            <thead>
                <tr>
                    <th style="width:34%">Nama Event</th>
                    <th style="width:14%">Tanggal</th>
                    <th style="width:14%">Jam</th>
                    <th style="width:22%">Lokasi</th>
                    <th style="width:10%">Status</th>
                    <th style="width:6%; text-align:right;">Aksi</th>
                </tr>
            </thead>

            <tbody id="eventBody">
                <?php foreach ($semua_event as $e): ?>
                    <tr class="event-row"
                        data-nama="<?= strtolower(htmlspecialchars($e['nama_event'])) ?>"
                        data-status="<?= $e['status'] ?>">

                        <td>
                            <div class="event-nama">
                                <?= htmlspecialchars($e['nama_event']) ?>
                            </div>
                            <?php if (!empty($e['deskripsi'])): ?>
                                <div class="event-desc">
                                    <?= htmlspecialchars(mb_strimwidth($e['deskripsi'], 0, 60, '...')) ?>
                                </div>
                            <?php endif; ?>
                        </td>

                        <td>
                            <div class="event-date-main">
                                <?= date('d M Y', strtotime($e['tanggal_mulai'])) ?>
                            </div>
                            <?php if (!empty($e['tanggal_selesai']) && $e['tanggal_selesai'] !== $e['tanggal_mulai']): ?>
                                <div class="event-date-end">
                                    s/d <?= date('d M Y', strtotime($e['tanggal_selesai'])) ?>
                                </div>
                            <?php endif; ?>
                        </td>

                        <td>
                            <?php if (!empty($e['jam_mulai'])): ?>
                                <div class="event-jam">
                                    <?= substr($e['jam_mulai'], 0, 5) ?>
                                    <?= !empty($e['jam_selesai']) ? ' – ' . substr($e['jam_selesai'], 0, 5) : '' ?>
                                </div>
                            <?php else: ?>
                                <span class="text-muted">—</span>
                            <?php endif; ?>
                        </td>

                        <td>
                            <div class="event-lokasi" title="<?= htmlspecialchars($e['lokasi']) ?>">
                                <i class="bi bi-geo-alt-fill me-1" style="color:#9ca3af; font-size:11px;"></i>
                                <?= htmlspecialchars($e['lokasi']) ?>
                            </div>
                        </td>

                        <td>
                            <?php
                            $statusMap = [
                                'berlangsung' => ['label' => 'Berlangsung', 'class' => 'badge-success'],
                                'akan_datang' => ['label' => 'Akan Datang', 'class' => 'badge-warning'],
                                'selesai'     => ['label' => 'Selesai',     'class' => 'badge-gray'],
                            ];
                            $s = $statusMap[$e['status']] ?? ['label' => ucfirst($e['status']), 'class' => 'badge-gray'];
                            ?>
                            <span class="status-badge <?= $s['class'] ?>">
                                <?= $s['label'] ?>
                            </span>
                        </td>

                        <td>
                            <div class="action-btns">
                                <a href="<?= BASE_URL ?>/admin/event/edit?id=<?= $e['id'] ?>"
                                    class="btn-edit" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <button type="button"
                                    class="btn-delete"
                                    title="Hapus"
                                    onclick="hapusEvent('<?= $e['id'] ?>')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>

        <div id="emptyFiltered" class="empty-state d-none" style="padding: 40px 16px;">
            <i class="bi bi-search"></i>
            <p>Tidak ada event yang cocok dengan pencarian.</p>
        </div>

    </div>

<?php endif; ?>
<script>
    const searchInput = document.getElementById('searchInput');
    const filterStatus = document.getElementById('filterStatus');
    const rows = document.querySelectorAll('.event-row');
    const emptyState = document.getElementById('emptyFiltered');
    const tableEl = document.getElementById('eventTable');

    function filterTable() {
        const keyword = searchInput?.value.toLowerCase().trim() ?? '';
        const status = filterStatus?.value ?? '';
        let visible = 0;

        rows.forEach(row => {
            const matchNama = row.dataset.nama.includes(keyword);
            const matchStatus = !status || row.dataset.status === status;

            if (matchNama && matchStatus) {
                row.style.display = '';
                visible++;
            } else {
                row.style.display = 'none';
            }
        });

        if (emptyState) emptyState.classList.toggle('d-none', visible > 0);
        if (tableEl) tableEl.style.display = visible === 0 ? 'none' : '';
    }

    searchInput?.addEventListener('input', filterTable);
    filterStatus?.addEventListener('change', filterTable);

    function hapusEvent(id) {
        SwalHelper.confirmDelete("<?= BASE_URL ?>/admin/event/delete", id);
    }
</script>

<?php require_once BASE_PATH . '/app/views/admin/layouts/footer.php'; ?>