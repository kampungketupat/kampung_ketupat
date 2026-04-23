<?php
// ============================================================
// RESET PASSWORD ADMIN (TEMPORARY FILE)
// HAPUS FILE INI SETELAH DIGUNAKAN!
// ============================================================

// =========================
// CONFIG
// =========================
define('BASE_PATH', dirname(__DIR__));

// =========================
// LOAD DATABASE
// =========================
require_once BASE_PATH . '/config/database.php';

// =========================
// DATA RESET
// =========================
$username = 'admin';
$password_baru = 'admin123';

// HASH PASSWORD
$hash = password_hash($password_baru, PASSWORD_DEFAULT);

// =========================
// UPDATE PASSWORD
// =========================
$stmt = $koneksi->prepare("UPDATE admin SET password = ? WHERE username = ?");
$stmt->bind_param('ss', $hash, $username);

if ($stmt->execute()) {

    echo '
    <div style="
        font-family:sans-serif;
        padding:30px;
        background:#ecfdf5;
        border-radius:12px;
        max-width:500px;
        margin:60px auto;
        text-align:center;
        box-shadow:0 10px 30px rgba(0,0,0,0.1);
    ">
        <h2 style="color:#065f46;">✅ Password Berhasil Direset!</h2>

        <p>Username: <strong>' . htmlspecialchars($username) . '</strong></p>
        <p>Password baru: <strong>' . htmlspecialchars($password_baru) . '</strong></p>

        <a href="' . '/admin/login' . '"
           style="
            display:inline-block;
            margin-top:16px;
            background:#065f46;
            color:#fff;
            padding:12px 24px;
            border-radius:999px;
            text-decoration:none;
           ">
           → Login Sekarang
        </a>

        <p style="color:red;margin-top:20px;font-size:.85rem;">
            ⚠️ WAJIB HAPUS FILE INI setelah berhasil login!
        </p>
    </div>';
} else {
    echo '<p style="color:red;text-align:center;">Gagal reset: ' . $koneksi->error . '</p>';
}
