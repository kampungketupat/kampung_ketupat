<?php
// ============================================================
// AdminKritikController (FINAL - MVC CLEAN)
// ============================================================

require_once BASE_PATH . '/app/core/Controller.php';
require_once BASE_PATH . '/app/models/KritikSaranModel.php';

class AdminKritikController extends Controller
{
    private $kritikModel;

    public function __construct()
    {
        // PROTEKSI ADMIN
        if (!isset($_SESSION['admin'])) {
            header('Location: ' . BASE_URL . '/admin/login');
            exit;
        }

        global $koneksi;
        $this->kritikModel = new KritikSaranModel($koneksi);
    }

    // =========================
    // INDEX (LIST PESAN)
    // =========================
    public function index()
    {
        $pesan = $this->kritikModel->getAll();

        foreach ($pesan as $p) {
            if (!$p['sudah_dibaca']) {
                $this->kritikModel->tandaiDibaca($p['id']);
            }
        }

        $data['semua_pesan'] = $pesan;
        $data['judul_halaman'] = 'Kelola Kritik & Saran';
        $data['menu_aktif'] = 'kritik';

        $this->view('admin/kritik_saran/index', $data);
    }

    // =========================
    // DELETE
    // =========================
    public function delete()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            $_SESSION['error'] = 'ID tidak valid!';
            header('Location: ' . BASE_URL . '/admin/kritik-saran');
            exit;
        }

        try {
            $this->kritikModel->hapus($id);
            $_SESSION['success'] = 'Pesan berhasil dihapus!';
        } catch (Exception $e) {
            $_SESSION['error'] = 'Gagal menghapus pesan!';
        }

        header('Location: ' . BASE_URL . '/admin/kritik-saran');
        exit;
    }
}
