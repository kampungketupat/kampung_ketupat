<?php require_once BASE_PATH . '/app/views/user/layouts/header.php'; ?>

<?php
$semua_umkm = $semua_umkm ?? [];

$umkm_json = json_encode($semua_umkm);
?>

<section class="section-kk" style="padding-top:50px;">
    <div class="container">

        
        <div class="text-center mb-5 reveal">
            <span class="section-label">Usaha Lokal</span>
            <h1 class="section-title">UMKM Kampung Ketupat</h1>
            <p class="section-subtitle">
                Dukung usaha masyarakat lokal
            </p>
        </div>

        <?php if (empty($semua_umkm)): ?>

            
            <div class="text-center py-5 text-muted">
                <i class="bi bi-shop fs-1 d-block mb-3"></i>
                <p>Data UMKM belum tersedia.</p>
            </div>

        <?php else: ?>

            
            <div id="app-umkm"></div>

        <?php endif; ?>

    </div>
</section>


<script>
    window.__UMKM_DATA__ = <?= $umkm_json ?>;
</script>

<?php require_once BASE_PATH . '/app/views/user/layouts/footer.php'; ?>