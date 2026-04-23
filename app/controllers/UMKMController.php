<?php
// ============================================================
// UMKMController (FINAL - MVC CLEAN)
// ============================================================

require_once BASE_PATH . '/app/core/Controller.php';
require_once BASE_PATH . '/app/models/UMKMModel.php';

class UMKMController extends Controller
{
    private $umkmModel;

    public function __construct()
    {
        global $koneksi;
        $this->umkmModel = new UMKMModel($koneksi);
    }

    // =========================
    // INDEX (TAMPILKAN DATA)
    // =========================
    public function index()
    {
        $data['semua_umkm'] = $this->umkmModel->getAll();

        $data['judul_halaman'] = 'UMKM Lokal — Kampung Ketupat Warna Warni';
        $data['halaman_aktif'] = 'umkm';

        $this->view('user/umkm/index', $data);
    }

    // =========================
    // STORE (TAMBAH DATA)
    // =========================
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/umkm');
            exit;
        }

        $nama      = $_POST['nama'] ?? '';
        $pemilik   = $_POST['pemilik'] ?? '';
        $kategori  = $_POST['kategori'] ?? '';
        $deskripsi = $_POST['deskripsi'] ?? '';
        $produk    = $_POST['produk'] ?? '';
        $kontak    = $_POST['kontak'] ?? '';
        $alamat    = $_POST['alamat'] ?? '';

        $foto = $this->uploadFoto();

        $this->umkmModel->tambah(
            $nama,
            $pemilik,
            $kategori,
            $deskripsi,
            $produk,
            $kontak,
            $alamat,
            $foto
        );

        header('Location: ' . BASE_URL . '/umkm');
        exit;
    }

    // =========================
    // UPLOAD FOTO
    // =========================
    private function uploadFoto()
    {
        if (empty($_FILES['foto']['name'])) return null;

        $ext  = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $foto = time() . '_' . uniqid() . '.' . $ext;

        $tmp    = $_FILES['foto']['tmp_name'];
        $folder = BASE_PATH . '/public/assets/uploads/umkm/';

        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        move_uploaded_file($tmp, $folder . $foto);

        return $foto;
    }
}
