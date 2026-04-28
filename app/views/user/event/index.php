<?php require_once BASE_PATH . '/app/views/user/layouts/header.php'; ?>
<?php
$semua_event = $semua_event ?? [];
?>

<section class="section-kk" style="padding-top:50px;">
    <div class="container">
        <div class="text-center mb-5 reveal">
            <span class="section-label">Event</span>
            <h1 class="section-title">Kalender Event</h1>
            <p class="section-subtitle">Koleksi event menarik di Kampung Ketupat</p>
        </div>
        <div id="app-event"></div>
    </div>
</section>

<script>
    window.__EVENT_DATA__ = <?= json_encode($semua_event) ?>;
</script>

<?php require_once BASE_PATH . '/app/views/user/layouts/footer.php'; ?>