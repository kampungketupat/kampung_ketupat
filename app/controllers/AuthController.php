<?php
// ============================================================
// AuthController (FINAL - MVC CLEAN)
// ============================================================

require_once BASE_PATH . '/app/core/Controller.php';
require_once BASE_PATH . '/app/core/LoginThrottle.php';
require_once BASE_PATH . '/app/models/AdminModel.php';

class AuthController extends Controller
{
    private $adminModel;
    private mysqli $db;

    public function __construct()
    {
        global $koneksi;
        $this->db = $koneksi;
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
        if (!csrf_validate_request()) {
            SecurityLogger::log('auth.csrf_invalid', [
                'username' => substr((string)($_POST['username'] ?? ''), 0, 100),
            ]);
            $_SESSION['login_error'] = 'Permintaan tidak valid. Silakan coba lagi.';
            header('Location: ' . BASE_URL . '/admin/login');
            exit;
        }

        $username = trim($_POST['username'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $usernameKey = strtolower($username);
        $ip = LoginThrottle::clientIp();
        $throttle = new LoginThrottle($this->db);

        if (!$username || !$password) {
            SecurityLogger::log('auth.login_empty_fields', [
                'username' => substr($username, 0, 100),
            ]);
            $_SESSION['login_error'] = 'Username dan password wajib diisi.';
            header('Location: ' . BASE_URL . '/admin/login');
            exit;
        }

        $blocked = $throttle->isBlocked($ip, $usernameKey);
        if ($blocked['blocked']) {
            $retryAfter = max(1, (int)ceil(($blocked['retry_after'] ?? 0) / 60));
            SecurityLogger::log('auth.login_blocked', [
                'username' => $usernameKey,
                'retry_after_seconds' => (int)($blocked['retry_after'] ?? 0),
            ]);
            $_SESSION['login_error'] = "Terlalu banyak percobaan login. Coba lagi dalam {$retryAfter} menit.";
            header('Location: ' . BASE_URL . '/admin/login');
            exit;
        }

        $admin = $this->adminModel->login($username, $password);

        if ($admin) {
            $throttle->clear($ip, $usernameKey);
            SecurityLogger::log('auth.login_success', [
                'username' => $usernameKey,
                'admin_id' => (int)($admin['id'] ?? 0),
            ], 'info');
            session_regenerate_id(true);
            $_SESSION['admin'] = [
                'id'       => $admin['id'],
                'username' => $admin['username'],
                'nama'     => $admin['nama_lengkap']
            ];

            $_SESSION['welcome'] = $admin['nama_lengkap'];
            header('Location: ' . BASE_URL . '/admin/dashboard');
            exit;
        } else {
            $attempt = $throttle->registerFailure($ip, $usernameKey);
            SecurityLogger::log('auth.login_failed', [
                'username' => $usernameKey,
                'attempts' => (int)($attempt['attempts'] ?? 0),
                'blocked' => (bool)($attempt['blocked'] ?? false),
            ]);
            if ($attempt['blocked']) {
                $retryAfter = max(1, (int)ceil(($attempt['retry_after'] ?? 0) / 60));
                $_SESSION['login_error'] = "Terlalu banyak percobaan login. Coba lagi dalam {$retryAfter} menit.";
            } else {
                $_SESSION['login_error'] = 'Username atau password salah.';
            }
            header('Location: ' . BASE_URL . '/admin/login');
            exit;
        }
    }

    // =========================
    // LOGOUT
    // =========================
    public function logout()
    {
        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
            header('Location: ' . BASE_URL . '/admin/dashboard');
            exit;
        }
        csrf_require('/admin/dashboard');

        session_destroy();

        session_start();
        $_SESSION['success'] = "Berhasil logout";

        header('Location: ' . BASE_URL . '/');
        exit;
    }
}
