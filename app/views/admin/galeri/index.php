<?php
$menu_aktif = 'galeri';
require_once BASE_PATH . '/app/views/admin/layouts/header.php';
?>

<!-- HEADER -->
<div class="page-header">

    <div class="page-title">
        <p>Kelola & atur tampilan foto website</p>
    </div>

    <div class="page-actions">
        <a href="<?= BASE_URL ?>/admin/galeri/publishAll" class="btn-modern success">
            <i class="bi bi-check2-circle"></i>
            <span>Tampilkan Semua</span>
        </a>

        <a href="<?= BASE_URL ?>/admin/galeri/create" class="btn-modern primary">
            <i class="bi bi-plus-circle"></i>
            <span>Tambah Foto</span>
        </a>
    </div>

</div>

<!-- SEARCH & FILTER -->
<div class="row mb-4 g-3">

    <div class="col-md-6">
        <div class="search-box">
            <i class="bi bi-search"></i>
            <input type="text" id="searchInput" placeholder="Cari judul foto...">
        </div>
    </div>

    <div class="col-md-3">
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

</div>

<!-- STATS -->
<div class="row g-3 mb-4">

    <div class="col-md-4">
        <div class="stat-card">
            <span>Total Foto</span>
            <h4 id="total"><?= $total ?></h4>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-card success">
            <span>Ditampilkan</span>
            <h4 id="publish"><?= $total_publish ?></h4>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-card gray">
            <span>Disembunyikan</span>
            <h4 id="hidden"><?= $total_hidden ?></h4>
        </div>
    </div>

</div>

<!-- GALERI -->
<div class="row g-4" id="galeriContainer">

    <?php foreach ($semua_galeri as $g): ?>
        <?php
        $src = str_starts_with($g['foto'], 'http')
            ? $g['foto']
            : BASE_URL . '/assets/uploads/galeri/' . $g['foto'];
        ?>

        <div class="col-md-4 galeri-item"
            data-judul="<?= strtolower($g['judul']) ?>"
            data-kategori="<?= strtolower($g['kategori']) ?>">

            <div class="galeri-card">

                <!-- IMAGE -->
                <div class="img-wrap">
                    <img src="<?= $src ?>">
                </div>

                <!-- CONTENT -->
                <div class="p-3">

                    <span class="badge kategori-badge"><?= ucfirst($g['kategori']) ?></span>

                    <h6 class="fw-bold mt-2 mb-1"><?= $g['judul'] ?></h6>

                    <small class="text-muted d-block mb-3">
                        <?= $g['deskripsi'] ?>
                    </small>

                    <!-- TOGGLE -->
                    <div class="toggle-wrap">
                        <label class="switch">
                            <input type="checkbox"
                                class="toggle-publish"
                                data-id="<?= $g['id'] ?>"
                                <?= $g['is_publish'] ? 'checked' : '' ?>>
                            <span class="slider"></span>
                        </label>

                        <span class="toggle-text">
                            <?= $g['is_publish'] ? 'Ditampilkan' : 'Disembunyikan' ?>
                        </span>
                    </div>

                    <!-- BUTTON -->
                    <div class="action-btns">
                        <a href="<?= BASE_URL ?>/admin/galeri/edit?id=<?= $g['id'] ?>" class="btn-edit">
                            <i class="bi bi-pencil"></i>
                        </a>

                        <a href="<?= BASE_URL ?>/admin/galeri/delete?id=<?= $g['id'] ?>" class="btn-delete">
                            <i class="bi bi-trash"></i>
                        </a>
                    </div>

                </div>

            </div>
        </div>

    <?php endforeach; ?>

</div>

<?php require_once BASE_PATH . '/app/views/admin/layouts/footer.php'; ?>