<?php require_once BASE_PATH . '/app/views/user/layouts/header.php'; ?>

<section class="section-kk lokasi-section" style="padding-top:60px;">
    <div class="container">

        
        <div class="text-center mb-5 reveal">
            <span class="section-label">Peta</span>
            <h1 class="section-title">Lokasi Kampung Ketupat</h1>
            <p class="section-subtitle">
                Jl. Mangkupalas, Samarinda Seberang, Kalimantan Timur
            </p>
        </div>

        
        <div class="row g-4 align-items-stretch">

            
            <div class="col-lg-6 reveal">
                <div class="map-wrapper h-100">
                    <iframe
                        title="Lokasi Kampung Ketupat Samarinda"
                        src="https://maps.google.com/maps?q=Kampung+Ketupat+Warna+Warni+Samarinda&z=15&output=embed"
                        loading="lazy"
                        allowfullscreen>
                    </iframe>
                </div>
            </div>

            
            <div class="col-lg-6 reveal">
                <div class="card-kk lokasi-card p-4 h-100 d-flex flex-column justify-content-between">

                    <div>
                        <h5 class="mb-4 text-center fs-4" style="color:var(--kk-primary); font-family: Playfair Display;">
                            <i class="bi bi-geo-alt-fill me-2"></i>Informasi Lokasi
                        </h5>

                        <div class="lokasi-list">

                            <div class="lokasi-item">
                                <div class="lokasi-icon"><i class="bi bi-map-fill"></i></div>
                                <div>
                                    <h6>Alamat</h6>
                                    <p>
                                        Jl. Mangkupalas, Kelurahan Mesjid, Kecamatan Samarinda Seberang,
                                        Kota Samarinda, Kalimantan Timur 75251
                                    </p>
                                </div>
                            </div>

                            <div class="lokasi-item">
                                <div class="lokasi-icon"><i class="bi bi-clock-fill"></i></div>
                                <div>
                                    <h6>Jam Operasional</h6>
                                    <p>Setiap Hari, 08.30 – 17.30 WITA</p>
                                </div>
                            </div>

                            <div class="lokasi-item">
                                <div class="lokasi-icon"><i class="bi bi-car-front-fill"></i></div>
                                <div>
                                    <h6>Jarak</h6>
                                    <p>±26 menit dari pusat kota</p>
                                </div>
                            </div>

                            <div class="lokasi-item">
                                <div class="lokasi-icon success">
                                    <i class="bi bi-ticket-perforated-fill"></i>
                                </div>
                                <div>
                                    <h6>Tiket Masuk</h6>
                                    <p class="text-success fw-bold">Gratis</p>
                                </div>
                            </div>

                        </div>
                    </div>

                    
                    <a href="https://maps.google.com/?q=Kampung+Ketupat+Samarinda"
                        target="_blank"
                        class="btn btn-kk mt-4 w-100">
                        <i class="bi bi-google me-2"></i>Buka di Google Maps
                    </a>

                </div>
            </div>

        </div>

    </div>
</section>

<?php require_once BASE_PATH . '/app/views/user/layouts/footer.php'; ?>