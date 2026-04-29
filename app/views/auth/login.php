<?php
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title><?= $judul_halaman ?? 'Login Admin' ?></title>

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet" />

    <link rel="icon" href="<?= BASE_URL ?>/assets/favicon.svg" type="image/svg+xml" />
    <link rel="shortcut icon" href="<?= BASE_URL ?>/assets/favicon.svg" type="image/svg+xml" />

    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/admin.css" />
</head>

<body class="bg-light" style="padding-top:0;">

    <div class="login-wrap">
        <div class="login-card">

            <div class="login-logo">
                LOGIN
            </div>

            <p class="text-center text-muted small mb-4">
                Panel Admin — Masuk untuk mengelola konten
            </p>

            
            <?php if (!empty($pesan_error)): ?>
                <div class="alert alert-danger small">
                    <i class="bi bi-exclamation-circle me-2"></i>
                    <?= htmlspecialchars($pesan_error) ?>
                </div>
            <?php endif; ?>

            
            <form action="<?= BASE_URL ?>/admin/login/proses" method="POST">
                <?= csrf_field() ?>

                <div class="mb-3">
                    <label class="form-label fw-500">Username</label>
                    <input
                        type="text"
                        name="username"
                        class="form-control"
                        placeholder="Masukkan username..."
                        required
                        autofocus />
                </div>

                <div class="mb-4">
                    <label class="form-label fw-500">Password</label>
                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        placeholder="Masukkan password..."
                        required />
                </div>

                <button type="submit" class="btn btn-kk w-100">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
                </button>

            </form>

            
            <div class="text-center mt-3">
                <a href="<?= BASE_URL ?>/" class="text-muted small">
                    ← Kembali ke Website
                </a>
            </div>

        </div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?= BASE_URL ?>/assets/js/swal-helper.js"></script>

    <?php if (!empty($_SESSION['success'])): ?>
        <script>
            SwalHelper.success("<?= $_SESSION['success'] ?>");
        </script>
    <?php unset($_SESSION['success']);
    endif; ?>
</body>

</html>
