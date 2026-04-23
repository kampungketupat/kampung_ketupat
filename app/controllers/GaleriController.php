<?php
// ============================================================
// GaleriController (FINAL - CLEAN + SAFE)
// ============================================================

require_once BASE_PATH . '/app/core/Controller.php';
require_once BASE_PATH . '/app/models/GaleriModel.php';

class GaleriController extends Controller
{
    private $galeriModel;

    public function __construct()
    {
        global $koneksi;
        $this->galeriModel = new GaleriModel($koneksi);
    }

    // =========================
    // INDEX (USER VIEW)
    // =========================
    public function index()
    {
        // 🔥 Ambil hanya yang ditampilkan
        $galeri = $this->galeriModel->getAllPublished();

        // 🔒 Safety: pastikan selalu array
        if (!is_array($galeri)) {
            $galeri = [];
        }

        $data = [
            'semua_galeri' => $galeri,
            'total_galeri' => count($galeri), // 🔥 bonus bisa dipakai di view
            'judul_halaman' => 'Galeri Wisata — Kampung Ketupat Warna Warni',
            'halaman_aktif' => 'galeri'
        ];

        $this->view('user/galeri/index', $data);
    }
}
