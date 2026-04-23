<?php
// ============================================================
// AuthController (FINAL - MVC CLEAN)
// ============================================================

require_once BASE_PATH . '/app/core/Controller.php';
require_once BASE_PATH . '/app/models/AdminModel.php';

class AuthController extends Controller
{
    private $adminModel;

    public function __construct()
    {
        global $koneksi;
        $this->adminModel = new AdminModel($koneksi);
    }

    // =========================
    // LOGIN PAGE
    // =========================
    public function login()
    {
        // kalau sudah login → dashboard
        if (isset($_SESSION['admin'])) {
            header('Location: ' . BASE_URL . '/admin/dashboard');
            exit;
        }

        $data['pesan_error'] = $_SESSION['login_error'] ?? null;
        unset($_SESSION['login_error']);

        $data['judul_halaman'] = 'Login Admin — Kampung Ketupat';

        $this->view('auth/login', $data, false);
    }

    // =========================
    // PROSES LOGIN
    // =========================
    public function proses()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/admin/login');
            exit;
        }

        $username = trim($_POST['username'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if (!$username || !$password) {
            $_SESSION['login_error'] = 'Username dan password wajib diisi.';
            header('Location: ' . BASE_URL . '/admin/login');
            exit;
        }

        $admin = $this->adminModel->login($username, $password);

        if ($admin) {
            $_SESSION['admin'] = [
                'id'       => $admin['id'],
                'username' => $admin['username'],
                'nama'     => $admin['nama_lengkap']
            ];

            $_SESSION['welcome'] = $admin['nama_lengkap'];
            header('Location: ' . BASE_URL . '/admin/dashboard');
            exit;
        } else {
            $_SESSION['login_error'] = 'Username atau password salah.';
            header('Location: ' . BASE_URL . '/admin/login');
            exit;
        }
    }

    // =========================
    // LOGOUT
    // =========================
    public function logout()
    {
        session_destroy();

        session_start();
        $_SESSION['success'] = "Berhasil logout";

        header('Location: ' . BASE_URL . '/');
        exit;
    }
}
