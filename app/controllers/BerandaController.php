<?php
// ============================================================
// BerandaController (FINAL - MVC CLEAN)
// ============================================================

require_once BASE_PATH . '/app/core/Controller.php';
require_once BASE_PATH . '/app/models/GaleriModel.php';
require_once BASE_PATH . '/app/models/EventModel.php';
require_once BASE_PATH . '/app/models/UMKMModel.php';


class BerandaController extends Controller
{
    private $galeriModel;
    private $eventModel;
    private $umkmModel;

    public function __construct()
    {
        global $koneksi;

        $this->galeriModel = new GaleriModel($koneksi);
        $this->eventModel  = new EventModel($koneksi);
        $this->umkmModel   = new UMKMModel($koneksi);
    }

    public function index()
    {
        // =========================
        // AMBIL DATA
        // =========================
        $data['galeri_preview'] = array_slice(
            $this->galeriModel->getAllPublished(),
            0,
            6
        );

        $data['event_preview'] = $this->eventModel->getAkanDatang();

        $data['umkm_preview'] = array_slice(
            $this->umkmModel->getAll(),
            0,
            4
        );

        // =========================
        // DATA TAMBAHAN
        // =========================
        $data['judul_halaman'] = 'Beranda — Kampung Ketupat Warna Warni Samarinda';
        $data['halaman_aktif'] = 'beranda';

        // =========================
        // LOAD VIEW
        // =========================
        $this->view('user/beranda/index', $data);
    }
}
