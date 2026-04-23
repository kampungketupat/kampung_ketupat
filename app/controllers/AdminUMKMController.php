<?php
// ============================================================
// AdminUMKMController (FINAL - MVC CLEAN)
// ============================================================

require_once BASE_PATH . '/app/core/Controller.php';
require_once BASE_PATH . '/app/models/UMKMModel.php';

class AdminUMKMController extends Controller
{
    private $umkmModel;

    public function __construct()
    {
        // PROTEKSI ADMIN
        if (!isset($_SESSION['admin'])) {
            header('Location: ' . BASE_URL . '/admin/login');
            exit;
        }

        global $koneksi;
        $this->umkmModel = new UMKMModel($koneksi);
    }

    // =========================
    // INDEX
    // =========================
    // =========================
    // INDEX
    // =========================
    public function index()
    {
        $data['semua_umkm'] = $this->umkmModel->getAll();
        $data['judul_halaman'] = 'Kelola UMKM';
        $data['menu_aktif'] = 'umkm';

        $this->view('admin/umkm/index', $data);
    }

    // =========================
    // FORM CREATE
    // =========================
    public function create()
    {
        $data['judul_halaman'] = 'Tambah UMKM';
        $data['menu_aktif'] = 'umkm';

        $this->view('admin/umkm/create', $data);
    }

    // =========================
    // STORE
    // =========================
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/admin/umkm');
            exit;
        }

        try {
            $nama      = trim($_POST['nama_umkm'] ?? '');
            $pemilik   = trim($_POST['pemilik'] ?? '');
            $kategori  = $_POST['kategori'] ?? '';
            $deskripsi = $_POST['deskripsi'] ?? '';
            $produk    = $_POST['produk_unggulan'] ?? '';
            $kontak    = $_POST['kontak'] ?? '';
            $alamat    = $_POST['alamat'] ?? '';

            if (!$nama) {
                $_SESSION['error'] = 'Nama UMKM wajib diisi!';
                header('Location: ' . BASE_URL . '/admin/umkm/create');
                exit;
            }

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

            $_SESSION['success'] = 'UMKM berhasil ditambahkan!';
        } catch (Exception $e) {
            $_SESSION['error'] = 'Gagal menambahkan UMKM!';
        }

        header('Location: ' . BASE_URL . '/admin/umkm');
        exit;
    }

    // =========================
    // FORM EDIT
    // =========================
    public function edit()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            header('Location: ' . BASE_URL . '/admin/umkm');
            exit;
        }

        $umkm = $this->umkmModel->getById($id);

        if (!$umkm) {
            header('Location: ' . BASE_URL . '/admin/umkm');
            exit;
        }

        $data['umkm'] = $umkm;
        $data['judul_halaman'] = 'Edit UMKM';
        $data['menu_aktif'] = 'umkm';

        $this->view('admin/umkm/edit', $data);
    }

    // =========================
    // UPDATE
    // =========================
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/admin/umkm');
            exit;
        }

        try {
            $id        = (int)$_POST['id'];
            $nama      = trim($_POST['nama_umkm'] ?? '');
            $pemilik   = trim($_POST['pemilik'] ?? '');
            $kategori  = $_POST['kategori'] ?? '';
            $deskripsi = $_POST['deskripsi'] ?? '';
            $produk    = $_POST['produk_unggulan'] ?? '';
            $kontak    = $_POST['kontak'] ?? '';
            $alamat    = $_POST['alamat'] ?? '';

            if (!$nama) {
                $_SESSION['error'] = 'Nama UMKM wajib diisi!';
                header('Location: ' . BASE_URL . '/admin/umkm/edit?id=' . $id);
                exit;
            }

            $foto = null;
            if (!empty($_FILES['foto']['name'])) {
                $foto = $this->uploadFoto();
            }

            $this->umkmModel->update(
                $id,
                $nama,
                $pemilik,
                $kategori,
                $deskripsi,
                $produk,
                $kontak,
                $alamat,
                $foto
            );

            $_SESSION['success'] = 'UMKM berhasil diperbarui!';
        } catch (Exception $e) {
            $_SESSION['error'] = 'Gagal memperbarui UMKM!';
        }

        header('Location: ' . BASE_URL . '/admin/umkm');
        exit;
    }

    // =========================
    // DELETE
    // =========================
    public function delete()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            $_SESSION['error'] = 'ID tidak valid!';
            header('Location: ' . BASE_URL . '/admin/umkm');
            exit;
        }

        try {
            $this->umkmModel->hapus($id);
            $_SESSION['success'] = 'UMKM berhasil dihapus!';
        } catch (Exception $e) {
            $_SESSION['error'] = 'Gagal menghapus UMKM!';
        }

        header('Location: ' . BASE_URL . '/admin/umkm');
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
