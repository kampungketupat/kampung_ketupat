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

        $data['total_publish'] = count(array_filter($semua, fn($g) => ((int)($g['is_publish'] ?? 0)) === 1));
        $data['total_hidden']  = count(array_filter($semua, fn($g) => ((int)($g['is_publish'] ?? 0)) === 0));

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
        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
            header('Location: ' . BASE_URL . '/admin/galeri');
            exit;
        }
        csrf_require('/admin/galeri');

        try {
            $judul     = trim($_POST['judul'] ?? '');
            $kategori  = trim($_POST['kategori'] ?? 'umum');
            $deskripsi = trim($_POST['deskripsi'] ?? '');

            if ($judul === '') {
                throw new RuntimeException('Judul galeri wajib diisi.');
            }

            $foto = $this->uploadFoto();
            if ($foto === null) {
                throw new RuntimeException('Foto wajib diupload dengan format JPG/PNG/WEBP maksimal 5MB.');
            }

            $saved = $this->galeriModel->tambah($judul, $deskripsi, $foto, $kategori);
            if (!$saved) {
                throw new RuntimeException('Gagal menyimpan data galeri ke database.');
            }

            $_SESSION['success'] = 'Foto berhasil ditambahkan!';
        } catch (Throwable $e) {
            $_SESSION['error'] = $e->getMessage();
        }

        header('Location: ' . BASE_URL . '/admin/galeri');
        exit;
    }

    public function edit()
    {
        $id = (int)($_GET['id'] ?? 0);

        if ($id <= 0) {
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
        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
            header('Location: ' . BASE_URL . '/admin/galeri');
            exit;
        }
        csrf_require('/admin/galeri');

        try {
            $id        = (int)($_POST['id'] ?? 0);
            $judul     = trim($_POST['judul'] ?? '');
            $kategori  = trim($_POST['kategori'] ?? 'umum');
            $deskripsi = trim($_POST['deskripsi'] ?? '');

            if ($id <= 0 || $judul === '') {
                throw new RuntimeException('Data update galeri tidak valid.');
            }

            $foto = null;
            if (!empty($_FILES['foto']['name'] ?? '')) {
                $foto = $this->uploadFoto();
                if ($foto === null) {
                    throw new RuntimeException('Format foto tidak valid atau ukuran terlalu besar.');
                }
            }

            $updated = $this->galeriModel->update($id, $judul, $deskripsi, $kategori, $foto);
            if (!$updated) {
                throw new RuntimeException('Gagal memperbarui data galeri.');
            }

            $_SESSION['success'] = 'Foto berhasil diperbarui!';
        } catch (Throwable $e) {
            $_SESSION['error'] = $e->getMessage();
        }

        header('Location: ' . BASE_URL . '/admin/galeri');
        exit;
    }

    public function delete()
    {
        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
            header('Location: ' . BASE_URL . '/admin/galeri');
            exit;
        }
        csrf_require('/admin/galeri');

        $id = (int)($_POST['id'] ?? 0);

        if ($id <= 0) {
            $_SESSION['error'] = 'ID tidak valid!';
            header('Location: ' . BASE_URL . '/admin/galeri');
            exit;
        }

        try {
            $deleted = $this->galeriModel->hapus($id);
            if (!$deleted) {
                throw new RuntimeException('Gagal menghapus foto galeri.');
            }

            $_SESSION['success'] = 'Foto berhasil dihapus!';
        } catch (Throwable $e) {
            $_SESSION['error'] = $e->getMessage();
        }

        header('Location: ' . BASE_URL . '/admin/galeri');
        exit;
    }

    public function togglePublish()
    {
        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
            http_response_code(405);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(['success' => false, 'message' => 'Method tidak diizinkan.']);
            exit;
        }

        if (!csrf_validate_request()) {
            http_response_code(419);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(['success' => false, 'message' => 'CSRF token tidak valid.']);
            exit;
        }

        $id = (int)($_POST['id'] ?? 0);
        $status = isset($_POST['status']) ? (int)$_POST['status'] : null;

        try {
            if ($id <= 0) {
                throw new RuntimeException('ID galeri tidak valid.');
            }

            if ($status === null || !in_array($status, [0, 1], true)) {
                throw new RuntimeException('Status publish tidak valid.');
            }

            $ok = $this->galeriModel->setPublish($id, $status === 1 ? 1 : 0);
            if (!$ok) {
                throw new RuntimeException('Gagal mengubah status publish.');
            }

            header('Content-Type: application/json; charset=utf-8');
            echo json_encode([
                'success' => true,
                'status' => $status === 1 ? 1 : 0,
                'is_publish' => $status === 1 ? 1 : 0
            ]);
        } catch (Throwable $e) {
            http_response_code(400);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }

        exit;
    }

    public function publishAll()
    {
        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
            header('Location: ' . BASE_URL . '/admin/galeri');
            exit;
        }
        csrf_require('/admin/galeri');

        try {
            $this->galeriModel->publishAll();
            $_SESSION['success'] = 'Semua foto ditampilkan!';
        } catch (Throwable $e) {
            $_SESSION['error'] = 'Gagal menampilkan semua foto.';
        }

        header('Location: ' . BASE_URL . '/admin/galeri');
        exit;
    }

    private function uploadFoto(): ?string
    {
        if (empty($_FILES['foto']['name'] ?? '')) {
            return null;
        }

        $file = $_FILES['foto'];

        if (($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
            SecurityLogger::log('upload.galeri.rejected', ['reason' => 'upload_error', 'code' => (int)($file['error'] ?? -1)]);
            return null;
        }

        $allowedMime = [
            'image/jpeg' => ['jpg', 'jpeg'],
            'image/png' => ['png'],
            'image/webp' => ['webp'],
        ];
        $maxSize = 5 * 1024 * 1024;

        if (($file['size'] ?? 0) > $maxSize) {
            SecurityLogger::log('upload.galeri.rejected', ['reason' => 'size_exceeded', 'size' => (int)($file['size'] ?? 0)]);
            return null;
        }

        $mime = '';
        if (class_exists('finfo')) {
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mime = (string)$finfo->file($file['tmp_name']);
        }
        if ($mime === '') {
            $mime = mime_content_type($file['tmp_name']) ?: '';
        }
        if (!isset($allowedMime[$mime])) {
            SecurityLogger::log('upload.galeri.rejected', ['reason' => 'mime_invalid', 'mime' => $mime]);
            return null;
        }
        if (@getimagesize($file['tmp_name']) === false) {
            SecurityLogger::log('upload.galeri.rejected', ['reason' => 'not_image']);
            return null;
        }

        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowedMime[$mime], true)) {
            SecurityLogger::log('upload.galeri.rejected', ['reason' => 'extension_mismatch', 'ext' => $ext, 'mime' => $mime]);
            return null;
        }

        try {
            $suffix = bin2hex(random_bytes(6));
        } catch (Throwable $e) {
            $suffix = uniqid();
        }
        $foto = time() . '_' . $suffix . '.' . $ext;

        $folder = BASE_PATH . '/public/assets/uploads/galeri/';
        if (!is_dir($folder)) {
            mkdir($folder, 0755, true);
        }

        if (!move_uploaded_file($file['tmp_name'], $folder . $foto)) {
            SecurityLogger::log('upload.galeri.rejected', ['reason' => 'move_failed']);
            return null;
        }

        SecurityLogger::log('upload.galeri.accepted', ['file' => $foto], 'info');
        return $foto;
    }
}
