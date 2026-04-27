<div id="dashboardApp">

    <!-- ======= TOPBAR ======= -->
    <div class="dash-topbar mb-4">
        <div>
            <div class="dash-greet-title">
                <i class="bi bi-hand-wave text-warning me-1"></i>
                Selamat Datang, <?= htmlspecialchars($admin_nama) ?>
            </div>
            <div class="dash-greet-sub">
                <i class="bi bi-calendar3 me-1"></i>
                <?= date('l, d F Y') ?> &nbsp;&middot;&nbsp; Kampung Ketupat
            </div>
        </div>
        <div class="dash-topbar-right">
            <div class="dash-avatar"><?= htmlspecialchars($initials ?: 'AD') ?></div>
        </div>
    </div>

    <!-- ======= STAT CARDS ======= -->
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-lg-3">
            <div class="dash-stat-card sc-green">
                <div class="sc-icon i-green"><i class="bi bi-images"></i></div>
                <div class="sc-label">Total Foto Galeri</div>
                <div class="sc-num"><?= htmlspecialchars($stats['galeri']) ?></div>
                <div class="sc-footer">
                    <i class="bi bi-arrow-up-short sc-up"></i>
                    <span class="sc-up">Foto terpublikasi</span>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="dash-stat-card sc-amber">
                <div class="sc-icon i-amber"><i class="bi bi-calendar-event"></i></div>
                <div class="sc-label">Event Aktif</div>
                <div class="sc-num"><?= htmlspecialchars($stats['event']) ?></div>
                <div class="sc-footer">
                    <i class="bi bi-arrow-up-short sc-up"></i>
                    <span class="sc-up">Event berjalan</span>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="dash-stat-card sc-orange">
                <div class="sc-icon i-orange"><i class="bi bi-shop"></i></div>
                <div class="sc-label">UMKM Terdaftar</div>
                <div class="sc-num"><?= htmlspecialchars($stats['umkm']) ?></div>
                <div class="sc-footer">
                    <i class="bi bi-arrow-up-short sc-up"></i>
                    <span class="sc-up">Mitra terdaftar</span>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="dash-stat-card sc-blue">
                <div class="sc-icon i-blue"><i class="bi bi-chat-heart"></i></div>
                <div class="sc-label">Pesan Belum Dibaca</div>
                <div class="sc-num"><?= htmlspecialchars($stats['kritik']) ?></div>
                <div class="sc-footer">
                    <?php if ($stats['kritik'] > 0): ?>
                        <i class="bi bi-exclamation-circle sc-warn"></i>
                        <span class="sc-warn">Perlu ditindak</span>
                    <?php else: ?>
                        <i class="bi bi-check-circle sc-up"></i>
                        <span class="sc-up">Semua telah dibaca</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- ======= CHARTS ROW ======= -->
    <div class="row g-3 mb-4">
        <div class="col-lg-7">
            <div class="dash-card h-100">
                <div class="d-flex justify-content-between align-items-start mb-1">
                    <div>
                        <div class="dash-card-title">
                            <i class="bi bi-bar-chart-line text-success me-2"></i>Upload Foto Galeri
                        </div>
                        <div class="dash-card-sub">Jumlah foto diunggah per bulan</div>
                    </div>
                    <span class="dash-period-badge">
                        <i class="bi bi-clock me-1"></i>7 Bulan
                    </span>
                </div>

                <div class="dash-legend mb-2">
                    <span class="dl-item"><span class="dl-sq" style="background:var(--kk-primary);"></span>Foto Galeri</span>
                    <span class="dl-item"><span class="dl-sq" style="background:var(--kk-secondary);"></span>Bulan Ini</span>
                </div>

                <div style="position:relative;width:100%;height:180px;">
                    <canvas id="chartGaleri"
                        role="img"
                        aria-label="Bar chart jumlah upload foto galeri per bulan">
                        Data upload foto galeri 7 bulan terakhir.
                    </canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="dash-card h-100">
                <div class="dash-card-title">
                    <i class="bi bi-pie-chart text-success me-2"></i>Jenis Pesan Masuk
                </div>
                <div class="dash-card-sub mb-3">Distribusi kritik &amp; saran</div>

                <div class="d-flex align-items-center gap-4">
                    <div style="position:relative;width:120px;height:120px;flex-shrink:0;">
                        <canvas id="chartJenis"
                            role="img"
                            aria-label="Donut chart distribusi jenis pesan: kritik, saran, apresiasi, pertanyaan">
                            Kritik 35%, Saran 28%, Apresiasi 22%, Pertanyaan 15%.
                        </canvas>
                    </div>
                    <div class="dash-donut-legend">
                        <div class="dd-item">
                            <div class="dd-dot" style="background:var(--kk-primary);"></div>
                            Kritik <span class="dd-val">35%</span>
                        </div>
                        <div class="dd-item">
                            <div class="dd-dot" style="background:var(--kk-secondary);"></div>
                            Saran <span class="dd-val">28%</span>
                        </div>
                        <div class="dd-item">
                            <div class="dd-dot" style="background:var(--kk-accent);"></div>
                            Apresiasi <span class="dd-val">22%</span>
                        </div>
                        <div class="dd-item">
                            <div class="dd-dot" style="background:#2563eb;"></div>
                            Pertanyaan <span class="dd-val">15%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ======= BOTTOM ROW ======= -->
    <div class="row g-3 mb-4">
        <div class="col-lg-5">
            <div class="dash-card h-100">
                <div class="dash-card-title mb-3">
                    <i class="bi bi-lightning-charge text-warning me-2"></i>Aksi Cepat
                </div>
                <div class="row g-2">
                    <div class="col-6">
                        <a href="/admin/galeri/create" class="dash-qa qa-green">
                            <i class="bi bi-plus-circle"></i> Tambah Foto
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="/admin/event/create" class="dash-qa qa-amber">
                            <i class="bi bi-calendar-plus"></i> Tambah Event
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="/admin/umkm/create" class="dash-qa qa-orange">
                            <i class="bi bi-shop-window"></i> Tambah UMKM
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="/admin/kritik-saran" class="dash-qa qa-blue">
                            <i class="bi bi-chat-heart"></i> Kritik &amp; Saran
                            <?php if ($stats['kritik'] > 0): ?>
                                <span class="badge bg-danger ms-auto"><?= $stats['kritik'] ?></span>
                            <?php endif; ?>
                        </a>
                    </div>
                </div>

                <hr class="my-3">
                <div class="row g-0 text-center">
                    <div class="col-4 border-end">
                        <div class="dash-mini-val" style="color:var(--kk-primary);"><?= $stats['galeri'] ?></div>
                        <div class="dash-mini-lbl"><i class="bi bi-images"></i> Foto</div>
                    </div>
                    <div class="col-4 border-end">
                        <div class="dash-mini-val" style="color:var(--kk-secondary);"><?= $stats['event'] ?></div>
                        <div class="dash-mini-lbl"><i class="bi bi-calendar-event"></i> Event</div>
                    </div>
                    <div class="col-4">
                        <div class="dash-mini-val" style="color:var(--kk-accent);"><?= $stats['umkm'] ?></div>
                        <div class="dash-mini-lbl"><i class="bi bi-shop"></i> UMKM</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <?php if (!empty($pesan_terbaru)): ?>
                <div class="dash-card h-100">
                    <div class="dash-card-title mb-3">
                        <i class="bi bi-envelope-paper text-success me-2"></i>Pesan Terbaru
                    </div>
                    <div class="d-flex flex-column gap-2">
                        <?php foreach ($pesan_terbaru as $p):
                            $init = strtoupper(substr($p['nama_pengunjung'], 0, 1));
                            $is_baru = !$p['sudah_dibaca'];
                        ?>
                            <div class="dash-msg-row <?= $is_baru ? 'unread' : '' ?>">
                                <div class="dash-msg-av"><?= $init ?></div>
                                <div class="dash-msg-info">
                                    <div class="dash-msg-name"><?= htmlspecialchars($p['nama_pengunjung']) ?></div>
                                    <div class="dash-msg-text"><?= htmlspecialchars(substr($p['pesan'], 0, 55)) ?>...</div>
                                </div>
                                <div class="d-flex flex-column align-items-end gap-1">
                                    <span class="dash-pill pill-jenis"><?= htmlspecialchars($p['jenis']) ?></span>
                                    <?php if ($is_baru): ?>
                                        <span class="dash-pill pill-baru">Baru</span>
                                    <?php else: ?>
                                        <span class="dash-pill pill-baca">Dibaca</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <a href="<?= BASE_URL ?>/admin/kritik-saran" class="btn btn-outline-kk btn-sm mt-3">
                        <i class="bi bi-arrow-right-circle me-1"></i> Lihat Semua Pesan
                    </a>
                </div>
            <?php else: ?>
                <div class="dash-card h-100 d-flex flex-column align-items-center justify-content-center text-center py-5">
                    <i class="bi bi-inbox fs-1 text-muted opacity-25 mb-2"></i>
                    <div class="fw-semibold text-muted">Belum ada pesan masuk</div>
                    <small class="text-muted">Pesan kritik &amp; saran akan muncul di sini</small>
                </div>
            <?php endif; ?>
        </div>
    </div>

</div>

<script>
    const labels = <?= json_encode($labelBulan ?? []); ?>;
    const dataUpload = <?= json_encode($dataBulanan ?? []); ?>;

    console.log('LABELS:', labels);
    console.log('DATA:', dataUpload);
</script>

<script>
    (function() {
        const primary = '#1a6b3c',
            amber = '#e8a020',
            orange = '#e05c1a',
            blue = '#2563eb';

        new Chart(document.getElementById('chartGaleri'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Foto',
                    data: dataUpload,
                    backgroundColor: labels.map((_, i) =>
                        i === labels.length - 1 ? amber : primary
                    ),
                    borderRadius: 6,
                    borderSkipped: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: c => ` ${c.raw} foto`
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 11
                            },
                            color: '#7a9a82'
                        },
                        border: {
                            display: false
                        }
                    },
                    y: {
                        grid: {
                            color: '#f0f4f1'
                        },
                        ticks: {
                            font: {
                                size: 11
                            },
                            color: '#7a9a82',
                            stepSize: 5
                        },
                        border: {
                            display: false
                        },
                        min: 0
                    }
                }
            }
        });

        new Chart(document.getElementById('chartJenis'), {
            type: 'doughnut',
            data: {
                labels: ['Kritik', 'Saran', 'Apresiasi', 'Pertanyaan'],
                datasets: [{
                    data: [35, 28, 22, 15],
                    backgroundColor: [primary, amber, orange, blue],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '68%',
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: c => ` ${c.label}: ${c.raw}%`
                        }
                    }
                }
            }
        });
    })();
</script>