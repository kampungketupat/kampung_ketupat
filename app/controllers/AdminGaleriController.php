<?php

require_once BASE_PATH . '/app/core/Controller.php';
require_once BASE_PATH . '/app/models/GaleriModel.php';

class AdminGaleriController extends Controller
{
    private $galeriModel;

    public function __construct()
    {
        if (!isset($_SESSION['admin'])) {
            header('Location: ' . BASE_URL . '/admin/login');
            exit;
        }

        global $koneksi;
        $this->galeriModel = new GaleriModel($koneksi);
    }

    public function index()
    {
        $semua = $this->galeriModel->getAll();

        $data['semua_galeri'] = $semua;
        $data['total'] = count($semua);

        $data['total_publish'] = count(array_filter($semua, fn($g) => $g['is_publish'] == 1));
        $data['total_hidden']  = count(array_filter($semua, fn($g) => $g['is_publish'] == 0));

        $data['judul_halaman'] = 'Kelola Galeri';
        $data['menu_aktif'] = 'galeri';

        $this->view('admin/galeri/index', $data);
    }

    public function create()
    {
        $data['judul_halaman'] = 'Tambah Galeri';
        $this->view('admin/galeri/create', $data);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/admin/galeri');
            exit;
        }

        try {
            $judul     = $_POST['judul'];
            $kategori  = $_POST['kategori'];
            $deskripsi = $_POST['deskripsi'];

            $foto = $this->uploadFoto();

            $this->galeriModel->tambah($judul, $deskripsi, $foto, $kategori);

            $_SESSION['success'] = 'Foto berhasil ditambahkan!';
        } catch (Exception $e) {
            $_SESSION['error'] = 'Gagal menambahkan foto!';
        }

        header('Location: ' . BASE_URL . '/admin/galeri');
        exit;
    }

    public function edit()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            header('Location: ' . BASE_URL . '/admin/galeri');
            exit;
        }

        $galeri = $this->galeriModel->getById($id);

        if (!$galeri) {
            $_SESSION['error'] = 'Data tidak ditemukan!';
            header('Location: ' . BASE_URL . '/admin/galeri');
            exit;
        }

        $data['galeri'] = $galeri;
        $data['judul_halaman'] = 'Edit Galeri';

        $this->view('admin/galeri/edit', $data);
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/admin/galeri');
            exit;
        }

        try {
            $id        = $_POST['id'];
            $judul     = $_POST['judul'];
            $kategori  = $_POST['kategori'];
            $deskripsi = $_POST['deskripsi'];

            $foto = null;

            if (!empty($_FILES['foto']['name'])) {
                $foto = $this->uploadFoto();
            }

            $this->galeriModel->update($id, $judul, $deskripsi, $kategori, $foto);

            $_SESSION['success'] = 'Foto berhasil diperbarui!';
        } catch (Exception $e) {
            $_SESSION['error'] = 'Gagal memperbarui foto!';
        }

        header('Location: ' . BASE_URL . '/admin/galeri');
        exit;
    }

    public function delete()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            $_SESSION['error'] = 'ID tidak valid!';
            header('Location: ' . BASE_URL . '/admin/galeri');
            exit;
        }

        try {
            $this->galeriModel->hapus($id);
            $_SESSION['success'] = 'Foto berhasil dihapus!';
        } catch (Exception $e) {
            $_SESSION['error'] = 'Gagal menghapus foto!';
        }

        header('Location: ' . BASE_URL . '/admin/galeri');
        exit;
    }

    // ===== TOGGLE =====
    public function togglePublish()
    {
        $id = $_POST['id'];
        $status = $_POST['status'];

        $this->galeriModel->setPublish($id, $status);

        echo json_encode(['success' => true]);
        exit;
    }

    // ===== PUBLISH ALL =====
    public function publishAll()
    {
        $this->galeriModel->publishAll();

        $_SESSION['success'] = "Semua foto ditampilkan!";
        header('Location: ' . BASE_URL . '/admin/galeri');
        exit;
    }

    private function uploadFoto()
    {
        if (empty($_FILES['foto']['name'])) return null;

        $ext  = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $foto = time() . '_' . uniqid() . '.' . $ext;

        $tmp    = $_FILES['foto']['tmp_name'];
        $folder = BASE_PATH . '/public/assets/uploads/galeri/';

        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        move_uploaded_file($tmp, $folder . $foto);

        return $foto;
    }
}
