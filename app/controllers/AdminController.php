<?php
// ============================================================
// FILE: controller/AdminController.php
// Controller untuk login admin & dashboard admin
// ============================================================

require_once BASE_PATH . '/app/core/Controller.php';
require_once BASE_PATH . '/app/models/AdminModel.php';
require_once BASE_PATH . '/app/models/GaleriModel.php';
require_once BASE_PATH . '/app/models/EventModel.php';
require_once BASE_PATH . '/app/models/UMKMModel.php';
require_once BASE_PATH . '/app/models/KritikSaranModel.php';

class AdminController extends Controller
{
    private $db;
    private $adminModel;
    private $galeriModel;
    private $eventModel;
    private $umkmModel;
    private $kritikModel;

    public function __construct()
    {
        global $koneksi;

        $this->db = $koneksi;

        $this->adminModel  = new AdminModel($koneksi);
        $this->galeriModel = new GaleriModel($koneksi);
        $this->eventModel  = new EventModel($koneksi);
        $this->umkmModel   = new UMKMModel($koneksi);
        $this->kritikModel = new KritikSaranModel($koneksi);
    }

    // =========================
    // LOGIN (GET + POST)
    // =========================
    public function login()
    {
        // kalau sudah login → dashboard
        if (isset($_SESSION['admin'])) {
            header('Location: /admin/dashboard');
            exit;
        }

        // =========================
        // HANDLE POST (LOGIN)
        // =========================
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');

            // validasi sederhana
            if ($username === '' || $password === '') {
                $_SESSION['login_error'] = 'Username dan password wajib diisi';
                header('Location: /admin/login');
                exit;
            }

            // cek ke database
            $admin = $this->adminModel->login($username, $password);

            if ($admin) {
                // simpan session
                $_SESSION['admin'] = $admin;

                header('Location: /admin/dashboard');
                exit;
            } else {
                $_SESSION['login_error'] = 'Username atau password salah';
                header('Location: /admin/login');
                exit;
            }
        }

        // =========================
        // TAMPILKAN LOGIN (GET)
        // =========================
        $data['pesan_error'] = $_SESSION['login_error'] ?? null;
        unset($_SESSION['login_error']);

        $data['judul_halaman'] = 'Login Admin — Kampung Ketupat';

        $this->view('auth/login', $data);
    }

    // =========================
    // DASHBOARD
    // =========================
    public function dashboard()
    {
        if (!isset($_SESSION['admin'])) {
            header('Location: /admin/login');
            exit;
        }

        $data['stats'] = [
            'galeri' => $this->galeriModel->countAll(),
            'event'  => $this->eventModel->countAll(),
            'umkm'   => $this->umkmModel->countAll(),
            'kritik' => $this->kritikModel->countBelumDibaca()
        ];

        $data['pesan_terbaru'] = array_slice(
            $this->kritikModel->getPending(),
            0,
            5
        );

        $labelBulan = [];
        $dataBulanan = [];


        $query = "
        SELECT 
            MONTH(created_at) AS bulan,
            COUNT(*) AS total
        FROM galeri
        GROUP BY MONTH(created_at)
        ORDER BY MONTH(created_at)
        ";

        $result = mysqli_query($this->db, $query);

        $labelBulan = [];
        $dataBulanan = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $namaBulan = date('M', mktime(0, 0, 0, $row['bulan'], 10));

            $labelBulan[] = $namaBulan;
            $dataBulanan[] = (int)$row['total'];
        }

        $data['labelBulan'] = $labelBulan;
        $data['dataBulanan'] = $dataBulanan;

        $nama = $_SESSION['admin']['nama'] ?? 'Admin';

        $initials = strtoupper(
            implode('', array_map(fn($w) => $w[0], explode(' ', $nama)))
        );

        $data['admin_nama'] = $nama;
        $data['initials'] = $initials;
        $data['judul_halaman'] = 'Dashboard Admin — Kampung Ketupat';

        $this->view('admin/dashboard', $data);
    }

    // =========================
    // LOGOUT
    // =========================
    public function logout()
    {
        session_destroy();
        header('Location: /admin/login');
        exit;
    }
}
