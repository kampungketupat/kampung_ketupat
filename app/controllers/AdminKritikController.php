<?php

require_once BASE_PATH . '/app/core/Controller.php';
require_once BASE_PATH . '/app/models/KritikSaranModel.php';

class AdminKritikController extends Controller
{
    private $model;

    public function __construct()
    {
        if (!isset($_SESSION['admin'])) {
            header('Location: ' . BASE_URL . '/admin/login');
            exit;
        }
        global $koneksi;
        $this->model = new KritikSaranModel($koneksi);
    }

    public function index()
    {
        $this->model->expireOtomatis();

        $pesan = $this->model->getPending();

        foreach ($pesan as $p) {
            if (!$p['sudah_dibaca']) $this->model->tandaiDibaca($p['id']);
        }

        $data = $this->_hitungStat($pesan);
        $data['semua_pesan']   = $pesan;
        $data['jumlah_arsip']  = $this->model->countArsip();
        $data['judul_halaman'] = 'Kotak Masuk — Kritik & Saran';
        $data['menu_aktif']    = 'kritik';
        $data['tab_aktif']     = 'pending';

        $this->_flashMessage($data);
        $this->view('admin/kritik_saran/index', $data);
    }

    public function arsip()
    {
        $this->model->expireOtomatis();

        $pesan = $this->model->getArsip();

        $data = $this->_hitungStat($pesan);
        $data['semua_pesan']   = $pesan;
        $data['jumlah_arsip']  = count($pesan);
        $data['judul_halaman'] = 'Arsip — Kritik & Saran';
        $data['menu_aktif']    = 'kritik';
        $data['tab_aktif']     = 'arsip';

        $this->_flashMessage($data);
        $this->view('admin/kritik_saran/index', $data);
    }

    public function terima()
    {
        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
            $this->_redirect('/admin/kritik-saran', 'Method tidak diizinkan.', 'error');
            return;
        }
        csrf_require('/admin/kritik-saran');

        $id = $_POST['id'] ?? null;
        if (!$id) {
            $this->_redirect('/admin/kritik-saran', 'ID tidak valid!', 'error');
            return;
        }

        $this->model->terima($id);
        $this->_redirect('/admin/kritik-saran', 'Pesan diterima dan dipindahkan ke arsip.');
    }

    public function kembalikan()
    {
        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
            $this->_redirect('/admin/kritik-saran/arsip', 'Method tidak diizinkan.', 'error');
            return;
        }
        csrf_require('/admin/kritik-saran/arsip');

        $id = $_POST['id'] ?? null;
        if (!$id) {
            $this->_redirect('/admin/kritik-saran/arsip', 'ID tidak valid!', 'error');
            return;
        }

        $this->model->kembalikanPending($id);
        $this->_redirect('/admin/kritik-saran/arsip', 'Pesan dikembalikan ke kotak masuk.');
    }

    public function tampilkan()
    {
        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
            $this->_redirect('/admin/kritik-saran/arsip', 'Method tidak diizinkan.', 'error');
            return;
        }
        csrf_require('/admin/kritik-saran/arsip');

        $id      = $_POST['id']      ?? null;
        $mulai   = $_POST['mulai']   ?? null;
        $selesai = $_POST['selesai'] ?? null;

        if (!$id || !$mulai || !$selesai) {
            $this->_redirect('/admin/kritik-saran/arsip', 'Data tidak lengkap!', 'error');
            return;
        }

        $this->model->tampilkan($id, $mulai, $selesai);
        $this->_redirect('/admin/kritik-saran/arsip', 'Pesan berhasil ditampilkan ke publik.');
    }

    public function sembunyikan()
    {
        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
            $this->_redirect('/admin/kritik-saran/arsip', 'Method tidak diizinkan.', 'error');
            return;
        }
        csrf_require('/admin/kritik-saran/arsip');

        $id = $_POST['id'] ?? null;
        if (!$id) {
            $this->_redirect('/admin/kritik-saran/arsip', 'ID tidak valid!', 'error');
            return;
        }

        $this->model->sembunyikan($id);
        $this->_redirect('/admin/kritik-saran/arsip', 'Pesan disembunyikan dari publik.');
    }

    private function _hitungStat(array $pesan): array
    {
        return [
            'total_kritik'     => count(array_filter($pesan, fn($p) => $p['jenis'] === 'kritik')),
            'total_saran'      => count(array_filter($pesan, fn($p) => $p['jenis'] === 'saran')),
            'total_pertanyaan' => count(array_filter($pesan, fn($p) => $p['jenis'] === 'pertanyaan')),
            'total_apresiasi'  => count(array_filter($pesan, fn($p) => $p['jenis'] === 'apresiasi')),
        ];
    }

    private function _flashMessage(array &$data): void
    {
        if (!empty($_SESSION['success'])) {
            $data['pesan_sukses'] = $_SESSION['success'];
            unset($_SESSION['success']);
        }
        if (!empty($_SESSION['error'])) {
            $data['pesan_error'] = $_SESSION['error'];
            unset($_SESSION['error']);
        }
    }

    private function _redirect(string $path, string $msg, string $type = 'success'): void
    {
        $_SESSION[$type === 'error' ? 'error' : 'success'] = $msg;
        header('Location: ' . BASE_URL . $path);
        exit;
    }
}
