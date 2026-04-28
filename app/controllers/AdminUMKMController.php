<?php
// ============================================================
// AdminUMKMController (HARDENED)
// ============================================================

require_once BASE_PATH . '/app/core/Controller.php';
require_once BASE_PATH . '/app/models/UMKMModel.php';

class AdminUMKMController extends Controller
{
    private $umkmModel;

    public function __construct()
    {
        if (!isset($_SESSION['admin'])) {
            header('Location: ' . BASE_URL . '/admin/login');
            exit;
        }

        global $koneksi;
        $this->umkmModel = new UMKMModel($koneksi);
    }

    public function index()
    {
        $data['semua_umkm'] = $this->umkmModel->getAll();
        $data['judul_halaman'] = 'Kelola UMKM';
        $data['menu_aktif'] = 'umkm';

        $this->view('admin/umkm/index', $data);
    }

    public function create()
    {
        $data['judul_halaman'] = 'Tambah UMKM';
        $data['menu_aktif'] = 'umkm';

        $this->view('admin/umkm/create', $data);
    }

    public function store()
    {
        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
            header('Location: ' . BASE_URL . '/admin/umkm');
            exit;
        }
        csrf_require('/admin/umkm');

        try {
            $nama      = trim($_POST['nama_umkm'] ?? '');
            $pemilik   = trim($_POST['pemilik'] ?? '');
            $kategori  = trim($_POST['kategori'] ?? 'lainnya');
            $deskripsi = trim($_POST['deskripsi'] ?? '');
            $produk    = trim($_POST['produk_unggulan'] ?? '');
            $kontak    = trim($_POST['kontak'] ?? '');
            $alamat    = trim($_POST['alamat'] ?? '');

            if ($nama === '') {
                throw new RuntimeException('Nama UMKM wajib diisi!');
            }

            $foto = $this->uploadFoto();

            $ok = $this->umkmModel->tambah(
                $nama,
                $pemilik,
                $kategori,
                $deskripsi,
                $produk,
                $kontak,
                $alamat,
                $foto
            );

            if (!$ok) {
                throw new RuntimeException('Gagal menambahkan UMKM.');
            }

            $_SESSION['success'] = 'UMKM berhasil ditambahkan!';
        } catch (Throwable $e) {
            $_SESSION['error'] = $e->getMessage();
        }

        header('Location: ' . BASE_URL . '/admin/umkm');
        exit;
    }

    public function edit()
    {
        $id = (int)($_GET['id'] ?? 0);

        if ($id <= 0) {
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

    public function update()
    {
        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
            header('Location: ' . BASE_URL . '/admin/umkm');
            exit;
        }
        csrf_require('/admin/umkm');

        try {
            $id        = (int)($_POST['id'] ?? 0);
            $nama      = trim($_POST['nama_umkm'] ?? '');
            $pemilik   = trim($_POST['pemilik'] ?? '');
            $kategori  = trim($_POST['kategori'] ?? 'lainnya');
            $deskripsi = trim($_POST['deskripsi'] ?? '');
            $produk    = trim($_POST['produk_unggulan'] ?? '');
            $kontak    = trim($_POST['kontak'] ?? '');
            $alamat    = trim($_POST['alamat'] ?? '');

            if ($id <= 0 || $nama === '') {
                throw new RuntimeException('Data UMKM tidak valid.');
            }

            $foto = null;
            if (!empty($_FILES['foto']['name'] ?? '')) {
                $foto = $this->uploadFoto();
                if ($foto === null) {
                    throw new RuntimeException('Format foto tidak valid atau ukuran terlalu besar.');
                }
            }

            $ok = $this->umkmModel->update(
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

            if (!$ok) {
                throw new RuntimeException('Gagal memperbarui UMKM.');
            }

            $_SESSION['success'] = 'UMKM berhasil diperbarui!';
        } catch (Throwable $e) {
            $_SESSION['error'] = $e->getMessage();
        }

        header('Location: ' . BASE_URL . '/admin/umkm');
        exit;
    }

    public function delete()
    {
        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
            header('Location: ' . BASE_URL . '/admin/umkm');
            exit;
        }
        csrf_require('/admin/umkm');

        $id = (int)($_POST['id'] ?? 0);

        if ($id <= 0) {
            $_SESSION['error'] = 'ID tidak valid!';
            header('Location: ' . BASE_URL . '/admin/umkm');
            exit;
        }

        try {
            $ok = $this->umkmModel->hapus($id);
            if (!$ok) {
                throw new RuntimeException('Gagal menghapus UMKM.');
            }
            $_SESSION['success'] = 'UMKM berhasil dihapus!';
        } catch (Throwable $e) {
            $_SESSION['error'] = $e->getMessage();
        }

        header('Location: ' . BASE_URL . '/admin/umkm');
        exit;
    }

    private function uploadFoto(): ?string
    {
        if (empty($_FILES['foto']['name'] ?? '')) {
            return null;
        }

        $file = $_FILES['foto'];

        if (($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
            SecurityLogger::log('upload.umkm.rejected', ['reason' => 'upload_error', 'code' => (int)($file['error'] ?? -1)]);
            return null;
        }

        if (empty($file['tmp_name']) || !is_uploaded_file($file['tmp_name'])) {
            SecurityLogger::log('upload.umkm.rejected', ['reason' => 'tmp_file_invalid']);
            return null;
        }

        $allowedMime = [
            'image/jpeg' => ['jpg', 'jpeg'],
            'image/png' => ['png'],
            'image/webp' => ['webp'],
        ];
        $mime = '';
        if (class_exists('finfo')) {
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mime = (string)$finfo->file($file['tmp_name']);
        }
        if ($mime === '') {
            $mime = mime_content_type($file['tmp_name']) ?: '';
        }
        if (!isset($allowedMime[$mime])) {
            SecurityLogger::log('upload.umkm.rejected', ['reason' => 'mime_invalid', 'mime' => $mime]);
            return null;
        }
        if (@getimagesize($file['tmp_name']) === false) {
            SecurityLogger::log('upload.umkm.rejected', ['reason' => 'not_image']);
            return null;
        }

        if (($file['size'] ?? 0) > 5 * 1024 * 1024) {
            SecurityLogger::log('upload.umkm.rejected', ['reason' => 'size_exceeded', 'size' => (int)($file['size'] ?? 0)]);
            return null;
        }

        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowedMime[$mime], true)) {
            SecurityLogger::log('upload.umkm.rejected', ['reason' => 'extension_mismatch', 'ext' => $ext, 'mime' => $mime]);
            return null;
        }

        try {
            $suffix = bin2hex(random_bytes(6));
        } catch (Throwable $e) {
            $suffix = uniqid();
        }
        $foto = time() . '_' . $suffix . '.' . $ext;
        $folder = BASE_PATH . '/public/assets/uploads/umkm/';

        if (!is_dir($folder)) {
            mkdir($folder, 0755, true);
        }

        if (!move_uploaded_file($file['tmp_name'], $folder . $foto)) {
            SecurityLogger::log('upload.umkm.rejected', ['reason' => 'move_failed']);
            return null;
        }

        SecurityLogger::log('upload.umkm.accepted', ['file' => $foto], 'info');
        return $foto;
    }
}
