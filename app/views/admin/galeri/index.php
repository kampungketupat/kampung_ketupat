<?php
$menu_aktif = 'galeri';
require_once BASE_PATH . '/app/views/admin/layouts/header.php';
?>

<!-- ═══════════════════════════════════════
     HEADER
════════════════════════════════════════ -->
<div class="page-header">
    <div class="page-title">
        <p>Kelola &amp; atur tampilan foto website</p>
    </div>
    <div class="page-actions">
        <button type="button" onclick="publishAllGaleri()" class="btn-modern success">
            <i class="bi bi-check2-circle"></i>
            <span>Tampilkan Semua</span>
        </button>
        <a href="<?= BASE_URL ?>/admin/galeri/create" class="btn-modern primary">
            <i class="bi bi-plus-circle"></i>
            <span>Tambah Foto</span>
        </a>
    </div>
</div>

<!-- ═══════════════════════════════════════
     SEARCH & FILTER
════════════════════════════════════════ -->
<div class="search-filter-bar mb-4">
    <div class="search-box">
        <i class="bi bi-search"></i>
        <input type="text" id="searchInput" placeholder="Cari judul foto...">
    </div>
    <div class="filter-box">
        <i class="bi bi-funnel"></i>
        <select id="filterKategori">
            <option value="">Semua Kategori</option>
            <option value="umum">Umum</option>
            <option value="wisata">Wisata</option>
            <option value="kuliner">Kuliner</option>
            <option value="budaya">Budaya</option>
            <option value="fasilitas">Fasilitas</option>
        </select>
    </div>
</div>

<!-- ═══════════════════════════════════════
     STAT CARDS
════════════════════════════════════════ -->
<div class="stat-grid mb-4">

    <div class="stat-card">
        <div class="stat-icon total">
            <i class="bi bi-images"></i>
        </div>
        <div class="stat-info">
            <span>Total Foto</span>
            <h4 id="statTotal"><?= $total ?></h4>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon success">
            <i class="bi bi-eye"></i>
        </div>
        <div class="stat-info">
            <span>Ditampilkan</span>
            <h4 id="statPublish"><?= $total_publish ?></h4>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon gray">
            <i class="bi bi-eye-slash"></i>
        </div>
        <div class="stat-info">
            <span>Disembunyikan</span>
            <h4 id="statHidden"><?= $total_hidden ?></h4>
        </div>
    </div>

</div>

<!-- ═══════════════════════════════════════
     GALERI GRID
════════════════════════════════════════ -->
<?php if (empty($semua_galeri)): ?>

    <div class="empty-state">
        <i class="bi bi-image"></i>
        <p>Belum ada foto di galeri.</p>
        <a href="<?= BASE_URL ?>/admin/galeri/create" class="btn-modern primary mt-3">
            <i class="bi bi-plus-circle"></i> Upload Foto Pertama
        </a>
    </div>

<?php else: ?>

    <div class="row g-4" id="galeriContainer">
        <?php foreach ($semua_galeri as $i => $g): ?>
            <?php
            $src = str_starts_with($g['foto'], 'http')
                ? $g['foto']
                : BASE_URL . '/assets/uploads/galeri/' . $g['foto'];
            ?>

            <div class="col-md-4 galeri-item"
                data-judul="<?= strtolower(htmlspecialchars($g['judul'])) ?>"
                data-kategori="<?= strtolower($g['kategori']) ?>">

                <div class="galeri-card">

                    <!-- IMAGE — klik untuk preview -->
                    <div class="img-wrap"
                        onclick="bukaPreview(_galeriAdmin, <?= $i ?>)"
                        title="Klik untuk lihat foto">
                        <img src="<?= $src ?>" alt="<?= htmlspecialchars($g['judul']) ?>">
                        <div class="img-overlay">
                            <i class="bi bi-zoom-in"></i>
                        </div>
                        <span class="overlay-badge"><?= ucfirst($g['kategori']) ?></span>
                    </div>
                    <!-- BODY -->
                    <div class="galeri-body">

                        <h6 class="galeri-judul"><?= htmlspecialchars($g['judul']) ?></h6>

                        <?php if (!empty($g['deskripsi'])): ?>
                            <p class="galeri-desc"><?= htmlspecialchars($g['deskripsi']) ?></p>
                        <?php endif; ?>

                        <!-- TOGGLE -->
                        <div class="toggle-wrap">
                            <label class="switch">
                                <input type="checkbox"
                                    class="toggle-publish"
                                    data-id="<?= $g['id'] ?>"
                                    <?= $g['is_publish'] ? 'checked' : '' ?>>
                                <span class="slider"></span>
                            </label>
                            <span class="toggle-label <?= $g['is_publish'] ? 'on' : 'off' ?>"
                                id="toggleText-<?= $g['id'] ?>">
                                <?= $g['is_publish'] ? 'Ditampilkan' : 'Disembunyikan' ?>
                            </span>
                        </div>

                        <!-- ACTION -->
                        <div class="action-btns">
                            <a href="<?= BASE_URL ?>/admin/galeri/edit?id=<?= $g['id'] ?>"
                                class="btn-edit" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <button type="button"
                                class="btn-delete" title="Hapus"
                                onclick="hapusGaleri('<?= $g['id'] ?>')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>

                    </div>
                </div>
            </div>

        <?php endforeach; ?>
    </div>

    <!-- EMPTY FILTERED -->
    <div id="emptyFiltered" class="empty-state d-none">
        <i class="bi bi-search"></i>
        <p>Tidak ada foto yang cocok dengan pencarian.</p>
    </div>

<?php endif; ?>

<!-- LIGHTBOX PREVIEW ADMIN -->
<div id="modalPreview" class="adm-lightbox" onclick="tutupPreview()">
    <!-- PREV -->
    <button class="adm-lb-arrow adm-lb-prev" id="btnPrev" onclick="event.stopPropagation(); prevPreview();">
        <i class="bi bi-chevron-left"></i>
    </button>
    <div class="adm-lb-inner" onclick="event.stopPropagation()">

        <!-- IMAGE WRAPPER (close + arrow ada di sini) -->
        <div class="adm-lb-img-wrap">

            <!-- CLOSE -->
            <button class="adm-lb-close" onclick="tutupPreview()">
                <i class="bi bi-x-lg"></i>
            </button>


            <!-- IMAGE -->
            <img id="previewImg" src="" alt="" class="adm-lb-img" />


        </div>

        <!-- CAPTION -->
        <div class="adm-lb-caption">
            <div class="adm-lb-caption-top">
                <span class="adm-lb-badge" id="previewKategori"></span>
                <span class="adm-lb-counter" id="previewCounter"></span>
            </div>
            <h5 class="adm-lb-judul" id="previewJudul"></h5>
            <p class="adm-lb-desc" id="previewDesc"></p>
        </div>

    </div>
    <!-- NEXT -->
    <button class="adm-lb-arrow adm-lb-next" id="btnNext" onclick="event.stopPropagation(); nextPreview();">
        <i class="bi bi-chevron-right"></i>
    </button>
</div>

<!-- ═══════════════════════════════════════
     SCRIPT
════════════════════════════════════════ -->
<script>
    /* ════════════════════════════════
   SEARCH & FILTER
════════════════════════════════ */
    var searchInput = document.getElementById('searchInput');
    var filterKategori = document.getElementById('filterKategori');
    var items = document.querySelectorAll('.galeri-item');
    var emptyFiltered = document.getElementById('emptyFiltered');

    function filterGaleri() {
        var keyword = searchInput ? searchInput.value.toLowerCase().trim() : '';
        var kategori = filterKategori ? filterKategori.value : '';
        var visible = 0;

        for (var i = 0; i < items.length; i++) {
            var item = items[i];
            var matchJudul = item.dataset.judul.indexOf(keyword) !== -1;
            var matchKat = !kategori || item.dataset.kategori === kategori;

            if (matchJudul && matchKat) {
                item.style.display = '';
                visible++;
            } else {
                item.style.display = 'none';
            }
        }

        if (emptyFiltered) {
            if (visible > 0) {
                emptyFiltered.classList.add('d-none');
            } else {
                emptyFiltered.classList.remove('d-none');
            }
        }
    }

    if (searchInput) searchInput.addEventListener('input', filterGaleri);
    if (filterKategori) filterKategori.addEventListener('change', filterGaleri);

    /* ════════════════════════════════
       TOGGLE PUBLISH
       - parse text dulu, baru coba JSON
       - kalau gagal parse: reload halaman (fallback aman)
       - TIDAK pakai alert() sama sekali
    ════════════════════════════════ */
    var BASE = '<?= BASE_URL ?>';
    var CSRF = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

    document.querySelectorAll('.toggle-publish').forEach(function(toggle) {
        toggle.addEventListener('change', function() {

            var checkbox = this;
            var id = checkbox.dataset.id;
            var labelEl = document.getElementById('toggleText-' + id);
            var pubEl = document.getElementById('statPublish');
            var hidEl = document.getElementById('statHidden');
            var wasChecked = !checkbox.checked; // kondisi SEBELUM diklik

            checkbox.disabled = true;

            fetch(BASE + '/admin/galeri/togglePublish', {
                    method: 'POST',
                    credentials: 'same-origin',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8'
                    },
                    body: '_token=' + encodeURIComponent(CSRF) +
                        '&id=' + encodeURIComponent(id) +
                        '&status=' + encodeURIComponent(checkbox.checked ? 1 : 0)
                })
                .then(function(res) {
                    // Ambil sebagai text dulu — aman untuk semua format response
                    return res.text();
                })
                .then(function(text) {
                    checkbox.disabled = false;

                    // Coba parse JSON
                    var data = null;
                    try {
                        data = JSON.parse(text);
                    } catch (e) {
                        data = null;
                    }

                    if (data !== null && typeof data.success !== 'undefined') {
                        // ── Backend return JSON ──
                        if (data.success) {
                            var isPublish = (data.is_publish == true || data.is_publish == 1);
                            applyToggleUI(id, isPublish, labelEl, pubEl, hidEl, wasChecked);
                        } else {
                            // Server tolak — revert
                            checkbox.checked = wasChecked;
                        }
                    } else {
                        // ── Backend tidak return JSON (redirect/HTML) ──
                        // Asumsikan berhasil, update UI lalu reload diam-diam
                        var isPublish = checkbox.checked; // state checkbox sekarang = kondisi baru
                        applyToggleUI(id, isPublish, labelEl, pubEl, hidEl, wasChecked);

                        // Reload setelah 600ms supaya animasi sempat kelihatan
                        setTimeout(function() {
                            window.location.reload();
                        }, 600);
                    }
                })
                .catch(function() {
                    // Koneksi benar-benar gagal — revert checkbox, jangan tampilkan alert
                    checkbox.disabled = false;
                    checkbox.checked = wasChecked;
                    // Coba reload sebagai fallback terakhir
                    setTimeout(function() {
                        window.location.reload();
                    }, 400);
                });
        });
    });

    function applyToggleUI(id, isPublish, labelEl, pubEl, hidEl, wasChecked) {
        // Update teks & warna label
        if (labelEl) {
            labelEl.textContent = isPublish ? 'Ditampilkan' : 'Disembunyikan';
            labelEl.className = 'toggle-label ' + (isPublish ? 'on' : 'off');
        }

        // Update angka stat — hanya jika state benar-benar berubah
        var berubahJadiPublish = isPublish && !wasChecked; // tadinya hidden → jadi publish
        var berubahJadiHidden = !isPublish && wasChecked; // tadinya publish → jadi hidden

        if (pubEl && hidEl) {
            var pub = parseInt(pubEl.textContent) || 0;
            var hid = parseInt(hidEl.textContent) || 0;

            if (berubahJadiPublish) {
                pubEl.textContent = pub + 1;
                hidEl.textContent = Math.max(0, hid - 1);
            } else if (berubahJadiHidden) {
                pubEl.textContent = Math.max(0, pub - 1);
                hidEl.textContent = hid + 1;
            }
        }
    }

    function hapusGaleri(id) {
        SwalHelper.confirmDelete(BASE + '/admin/galeri/delete', id);
    }

    function publishAllGaleri() {
        SwalHelper.confirm(
            'Tampilkan semua foto?',
            'Semua foto galeri akan ditampilkan ke publik.',
            BASE + '/admin/galeri/publishAll',
            {},
            '#16a34a'
        );
    }

    const _galeriAdmin = [
        <?php foreach ($semua_galeri as $i => $g):
            $src = str_starts_with($g['foto'], 'http')
                ? $g['foto']
                : BASE_URL . '/assets/uploads/galeri/' . $g['foto'];
        ?> {
                src: "<?= addslashes($src) ?>",
                judul: "<?= addslashes($g['judul']) ?>",
                kategori: "<?= addslashes($g['kategori']) ?>",
                deskripsi: "<?= addslashes($g['deskripsi'] ?? '') ?>"
            }
            <?= $i < count($semua_galeri) - 1 ? ',' : '' ?>
        <?php endforeach; ?>
    ];

    // =============================================
    // ADMIN LIGHTBOX PREVIEW
    // =============================================
    let _lbItems = []; // array semua item { src, judul, kategori, deskripsi }
    let _lbIndex = 0;

    function bukaPreview(items, startIndex) {
        _lbItems = items;
        _lbIndex = Number.isInteger(startIndex) ? startIndex : 0;
        _renderPreview();

        const lb = document.getElementById('modalPreview');
        lb.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function tutupPreview() {
        document.getElementById('modalPreview').classList.remove('active');
        document.body.style.overflow = '';
    }

    function prevPreview() {
        if (_lbItems.length === 0) return;

        _lbIndex = Math.max(_lbIndex - 1, 0);
        _renderPreview();
    }

    function nextPreview() {
        if (_lbItems.length === 0) return;

        _lbIndex = Math.min(_lbIndex + 1, _lbItems.length - 1);
        _renderPreview();
    }

    function _renderPreview() {
        if (_lbItems.length === 0) return;

        if (_lbIndex < 0) _lbIndex = 0;
        if (_lbIndex >= _lbItems.length) _lbIndex = _lbItems.length - 1;

        const item = _lbItems[_lbIndex];

        document.getElementById('previewImg').src = item.src;
        document.getElementById('previewImg').alt = item.judul || '';
        document.getElementById('previewJudul').textContent = item.judul || '';
        document.getElementById('previewKategori').textContent = item.kategori || '';
        document.getElementById('previewDesc').textContent = item.deskripsi || '';
        document.getElementById('previewCounter').textContent =
            (_lbIndex + 1) + ' / ' + _lbItems.length;

        const prevBtn = document.getElementById('btnPrev');
        const nextBtn = document.getElementById('btnNext');

        prevBtn.disabled = (_lbIndex === 0);
        nextBtn.disabled = (_lbIndex === _lbItems.length - 1);

        prevBtn.classList.toggle('arrow-disabled', _lbIndex === 0);
        nextBtn.classList.toggle('arrow-disabled', _lbIndex === _lbItems.length - 1);
    }

    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        const lb = document.getElementById('modalPreview');
        if (!lb.classList.contains('active')) return;
        if (e.key === 'Escape') tutupPreview();
        if (e.key === 'ArrowLeft') prevPreview();
        if (e.key === 'ArrowRight') nextPreview();
    });
</script>

<?php require_once BASE_PATH . '/app/views/admin/layouts/footer.php'; ?>
