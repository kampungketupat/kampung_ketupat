<?php
// ============================================================
// WisataController (FINAL - MVC CLEAN)
// ============================================================

require_once BASE_PATH . '/app/core/Controller.php';

class WisataController extends Controller
{
    public function index()
    {
        $data['judul_halaman'] = 'Detail Wisata — Kampung Ketupat Warna Warni';
        $data['halaman_aktif'] = 'wisata';

        $this->view('user/wisata/detail', $data);
    }
}
