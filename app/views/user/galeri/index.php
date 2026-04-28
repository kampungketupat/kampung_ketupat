<?php require_once BASE_PATH . '/app/views/user/layouts/header.php'; ?>
<?php
$semua_galeri = $semua_galeri ?? [];
$galeri_json  = json_encode($semua_galeri);
?>

<section class="section-kk" style="padding-top: 50px;">
    <div class="container">

        
        <div class="text-center mb-5 reveal">
            <span class="section-label">Foto</span>
            <h1 class="section-title">Galeri Wisata</h1>
            <p class="section-subtitle">
                Koleksi foto indah Kampung Ketupat Warna Warni
            </p>
        </div>

        
        <div id="app-galeri"></div>

    </div>
</section>

<script>
    window.__GALERI_DATA__ = <?= $galeri_json ?>;
</script>

<?php require_once BASE_PATH . '/app/views/user/layouts/footer.php'; ?>