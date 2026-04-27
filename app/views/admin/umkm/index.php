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

<!-- ═══════════════════════════════════════
     HEADER
════════════════════════════════════════ -->
<div class="page-header">
    <div class="page-title">
        <p>Kelola &amp; atur data UMKM Kampung Ketupat</p>
    </div>
    <div class="page-actions">
        <a href="<?= BASE_URL ?>/admin/umkm/create" class="btn-modern primary">
            <i class="bi bi-plus-circle"></i>
            <span>Tambah UMKM</span>
        </a>
    </div>
</div>

<!-- ═══════════════════════════════════════
     SEARCH & FILTER
════════════════════════════════════════ -->
<div class="search-filter-bar mb-4">

    <div class="search-box">
        <i class="bi bi-search"></i>
        <input type="text" id="searchInput" placeholder="Cari nama UMKM...">
    </div>

    <div class="filter-box">
        <i class="bi bi-funnel"></i>
        <select id="filterKategori">
            <option value="">Semua Kategori</option>
            <option value="kuliner">Kuliner</option>
            <option value="kerajinan">Kerajinan</option>
            <option value="souvenir">Souvenir</option>
            <option value="jasa">Jasa</option>
            <option value="lainnya">Lainnya</option>
        </select>
    </div>

</div>

<!-- ═══════════════════════════════════════
     STAT CARDS
════════════════════════════════════════ -->
<?php
$total     = count($semua_umkm);
$kuliner   = count(array_filter($semua_umkm, fn($u) => $u['kategori'] === 'kuliner'));
$kerajinan = count(array_filter($semua_umkm, fn($u) => $u['kategori'] === 'kerajinan'));
$jasa      = count(array_filter($semua_umkm, fn($u) => $u['kategori'] === 'jasa'));
?>

<div class="stat-grid mb-4">

    <div class="stat-card">
        <div class="stat-icon total">
            <i class="bi bi-shop"></i>
        </div>
        <div class="stat-info">
            <span>Total UMKM</span>
            <h4><?= $total ?></h4>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon warning">
            <i class="bi bi-egg-fried"></i>
        </div>
        <div class="stat-info">
            <span>Kuliner</span>
            <h4><?= $kuliner ?></h4>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon success">
            <i class="bi bi-palette"></i>
        </div>
        <div class="stat-info">
            <span>Kerajinan</span>
            <h4><?= $kerajinan ?></h4>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon gray">
            <i class="bi bi-briefcase"></i>
        </div>
        <div class="stat-info">
            <span>Jasa</span>
            <h4><?= $jasa ?></h4>
        </div>
    </div>

</div>

<!-- ═══════════════════════════════════════
     TABLE
════════════════════════════════════════ -->
<?php if (empty($semua_umkm)): ?>

    <div class="empty-state">
        <i class="bi bi-shop"></i>
        <p>Belum ada UMKM yang terdaftar.</p>
        <a href="<?= BASE_URL ?>/admin/umkm/create" class="btn-modern primary mt-3">
            <i class="bi bi-plus-circle"></i> Tambah UMKM Pertama
        </a>
    </div>

<?php else: ?>

    <div class="table-card">
        <table class="event-table" id="umkmTable">

            <thead>
                <tr>
                    <th style="width:28%">Nama UMKM</th>
                    <th style="width:18%">Pemilik</th>
                    <th style="width:14%">Kategori</th>
                    <th style="width:20%">Produk Unggulan</th>
                    <th style="width:14%">Kontak</th>
                    <th style="width:6%; text-align:right;">Aksi</th>
                </tr>
            </thead>

            <tbody id="umkmBody">
                <?php foreach ($semua_umkm as $u): ?>
                    <tr class="umkm-row"
                        data-nama="<?= strtolower(htmlspecialchars($u['nama_umkm'])) ?>"
                        data-kategori="<?= $u['kategori'] ?>">

                        <!-- NAMA + ALAMAT -->
                        <td>
                            <div class="event-nama">
                                <?= htmlspecialchars($u['nama_umkm']) ?>
                            </div>
                            <?php if (!empty($u['alamat'])): ?>
                                <div class="event-desc">
                                    <i class="bi bi-geo-alt-fill me-1" style="color:#9ca3af; font-size:11px;"></i>
                                    <?= htmlspecialchars(mb_strimwidth($u['alamat'], 0, 50, '...')) ?>
                                </div>
                            <?php endif; ?>
                        </td>

                        <!-- PEMILIK -->
                        <td><?= htmlspecialchars($u['pemilik'] ?? '-') ?></td>

                        <!-- KATEGORI -->
                        <td>
                            <?php
                            $kategoriMap = [
                                'kuliner'   => 'badge-warning',
                                'kerajinan' => 'badge-success',
                                'souvenir'  => 'badge-success',
                                'jasa'      => 'badge-gray',
                                'lainnya'   => 'badge-gray',
                            ];
                            $badgeClass = $kategoriMap[$u['kategori']] ?? 'badge-gray';
                            ?>
                            <span class="status-badge <?= $badgeClass ?>">
                                <?= ucfirst($u['kategori']) ?>
                            </span>
                        </td>

                        <!-- PRODUK UNGGULAN -->
                        <td class="small">
                            <?= htmlspecialchars($u['produk_unggulan'] ?? '-') ?>
                        </td>

                        <!-- KONTAK -->
                        <td class="small">
                            <?= htmlspecialchars($u['kontak'] ?? '-') ?>
                        </td>

                        <!-- AKSI -->
                        <td>
                            <div class="action-btns">
                                <a href="<?= BASE_URL ?>/admin/umkm/edit?id=<?= $u['id'] ?>"
                                    class="btn-edit" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <button type="button"
                                    class="btn-delete"
                                    title="Hapus"
                                    onclick="hapusUmkm('<?= $u['id'] ?>')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>

        <!-- EMPTY FILTERED -->
        <div id="emptyFiltered" class="empty-state d-none" style="padding: 40px 16px;">
            <i class="bi bi-search"></i>
            <p>Tidak ada UMKM yang cocok dengan pencarian.</p>
        </div>

    </div>

<?php endif; ?>

<!-- ═══════════════════════════════════════
     SCRIPT
════════════════════════════════════════ -->
<script>
    const searchInput = document.getElementById('searchInput');
    const filterKategori = document.getElementById('filterKategori');
    const rows = document.querySelectorAll('.umkm-row');
    const emptyState = document.getElementById('emptyFiltered');
    const tableEl = document.getElementById('umkmTable');

    function filterTable() {
        const keyword = searchInput?.value.toLowerCase().trim() ?? '';
        const kategori = filterKategori?.value ?? '';
        let visible = 0;

        rows.forEach(row => {
            const matchNama = row.dataset.nama.includes(keyword);
            const matchKategori = !kategori || row.dataset.kategori === kategori;

            if (matchNama && matchKategori) {
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
    filterKategori?.addEventListener('change', filterTable);

    function hapusUmkm(id) {
        SwalHelper.confirmDelete("<?= BASE_URL ?>/admin/umkm/delete?id=" + id);
    }
</script>

<?php require_once BASE_PATH . '/app/views/admin/layouts/footer.php'; ?>