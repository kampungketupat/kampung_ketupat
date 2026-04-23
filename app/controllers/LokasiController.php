<?php
// ============================================================
// LokasiController 
// ============================================================

require_once BASE_PATH . '/app/core/Controller.php';

class LokasiController extends Controller
{
    public function index()
    {
        // =========================
        // DATA UNTUK VIEW
        // =========================
        $data['judul_halaman'] = 'Lokasi — Kampung Ketupat Warna Warni';
        $data['halaman_aktif'] = 'lokasi';

        // =========================
        // LOAD VIEW (PAKAI LAYOUT USER)
        // =========================
        $this->view('user/lokasi/index', $data);
    }
}
