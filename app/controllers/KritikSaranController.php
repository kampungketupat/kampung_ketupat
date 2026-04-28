<?php
// ============================================================
// KritikSaranController (FINAL - SESUAI MODEL KAMU)
// ============================================================

require_once BASE_PATH . '/app/core/Controller.php';
require_once BASE_PATH . '/app/models/KritikSaranModel.php';

class KritikSaranController extends Controller
{
    private $kritikModel;

    public function __construct()
    {
        global $koneksi;
        $this->kritikModel = new KritikSaranModel($koneksi);
    }

    public function index()
    {
        // =========================
        // HANDLE POST (SUBMIT FORM)
        // =========================
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            csrf_require('/kritik-saran');

            $nama   = trim($_POST['nama'] ?? '');
            $email  = trim($_POST['email'] ?? '');
            $jenis  = trim($_POST['jenis'] ?? 'saran');
            $pesan  = trim($_POST['pesan'] ?? '');

            // VALIDASI
            if ($nama === '' || $pesan === '') {
                $_SESSION['pesan_error'] = "Nama dan pesan wajib diisi";
                header('Location: ' . BASE_URL . '/kritik-saran');
                exit;
            }

            // SIMPAN KE DATABASE (PAKAI METHOD MODEL KAMU)
            $simpan = $this->kritikModel->simpan(
                $nama,
                $email,
                $jenis,
                $pesan
            );

            if ($simpan) {
                $_SESSION['pesan_sukses'] = "Pesan berhasil dikirim!";
            } else {
                $_SESSION['pesan_error'] = "Gagal mengirim pesan, coba lagi.";
            }

            header('Location: ' . BASE_URL . '/kritik-saran');
            exit;
        }

        // =========================
        // AMBIL SESSION MESSAGE
        // =========================
        $data['pesan_sukses'] = $_SESSION['pesan_sukses'] ?? null;
        $data['pesan_error']  = $_SESSION['pesan_error'] ?? null;

        unset($_SESSION['pesan_sukses'], $_SESSION['pesan_error']);

        // =========================
        // DATA VIEW
        // =========================
        $data['judul_halaman'] = 'Kritik & Saran — Kampung Ketupat Warna Warni';
        $data['halaman_aktif'] = 'kritik';

        // =========================
        // LOAD VIEW (PAKAI LAYOUT)
        // =========================
        $this->view('user/kritik_saran/index', $data);
    }
}
