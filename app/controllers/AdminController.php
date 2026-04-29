<?php

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

    public function login()
    {
        header('Location: ' . BASE_URL . '/admin/login');
        exit;
    }

    public function dashboard()
    {
        if (!isset($_SESSION['admin'])) {
            header('Location: ' . BASE_URL . '/admin/login');
            exit;
        }

        $data['stats'] = [
            'galeri' => $this->galeriModel->countAll(),
            'event'  => $this->eventModel->countAll(),
            'umkm'   => $this->umkmModel->countAll(),
            'kritik' => $this->kritikModel->countBelumDibaca(),
        ];

        $data['pesan_terbaru'] = array_slice(
            $this->kritikModel->getPending(),
            0,
            5
        );

        // Query upload foto per bulan (real data)
        $query = "
            SELECT MONTH(created_at) AS bulan, COUNT(*) AS total
            FROM galeri
            GROUP BY MONTH(created_at)
            ORDER BY MONTH(created_at)
        ";

        // Inisialisasi 12 bulan (Jan-Des) dengan 0
        $uploadPerBulan = array_fill(1, 12, 0);

        $result = $this->db->query($query);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $bulan = (int)($row['bulan'] ?? 0);
                if ($bulan >= 1 && $bulan <= 12) {
                    $uploadPerBulan[$bulan] = (int)($row['total'] ?? 0);
                }
            }
        }

        // Build labels & data array untuk 12 bulan
        $labelBulan = [];
        $dataBulanan = [];
        $bulanSekarang = (int)date('n'); // bulan saat ini (1-12)

        for ($i = 1; $i <= 12; $i++) {
            $labelBulan[] = date('M', mktime(0, 0, 0, $i, 10));
            $dataBulanan[] = $uploadPerBulan[$i];
        }

        $data['labelBulan'] = $labelBulan;
        $data['dataBulanan'] = $dataBulanan;
        $data['bulanSekarang'] = $bulanSekarang;

        $nama = trim($_SESSION['admin']['nama'] ?? $_SESSION['admin']['nama_lengkap'] ?? 'Admin');
        $parts = array_values(array_filter(explode(' ', $nama)));
        $initialChars = array_map(static fn($w) => strtoupper(substr($w, 0, 1)), $parts);
        $initials = implode('', $initialChars);

        $data['admin_nama'] = $nama;
        $data['initials'] = $initials !== '' ? $initials : 'AD';
        $data['judul_halaman'] = 'Dashboard Admin - Kampung Ketupat';
        $data['menu_aktif'] = 'dashboard';

        $this->view('admin/dashboard', $data);
    }

    public function logout()
    {
        header('Location: ' . BASE_URL . '/admin/login');
        exit;
    }
}
