<?php
// ============================================================
// FILE: app/models/AdminModel.php
// Model autentikasi admin
// ============================================================

class AdminModel {
    private $db;

    public function __construct($koneksi) {
        $this->db = $koneksi;
    }

    // Cari admin berdasarkan username
    public function findByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM admin WHERE username = ? LIMIT 1");

        if (!$stmt) {
            return null; // jika query gagal
        }

        $stmt->bind_param('s', $username);
        $stmt->execute();

        $result = $stmt->get_result();
        $data = $result ? $result->fetch_assoc() : null;

        $stmt->close();

        return $data;
    }

    // Verifikasi login
    public function login($username, $password) {
        $admin = $this->findByUsername($username);

        if ($admin && isset($admin['password']) && password_verify($password, $admin['password'])) {
            return $admin;
        }

        // Mitigasi timing attack untuk username yang tidak ditemukan.
        password_verify((string)$password, '$2y$10$A5qR0jSDR/X8Cg6XFkM8L.pdfjP9hOMFgdI2VCfWIA6vR4k9yN2dW');

        return false;
    }
}
