<?php

require_once BASE_PATH . '/app/core/Controller.php';
require_once BASE_PATH . '/app/models/UMKMModel.php';
require_once BASE_PATH . '/app/core/SecurityLogger.php';

class UMKMController extends Controller
{
    private $umkmModel;

    public function __construct()
    {
        global $koneksi;
        $this->umkmModel = new UMKMModel($koneksi);
    }

    public function index()
    {
        $data['semua_umkm'] = $this->umkmModel->getAll();

        $data['judul_halaman'] = 'UMKM Lokal — Kampung Ketupat Warna Warni';
        $data['halaman_aktif'] = 'umkm';

        $this->view('user/umkm/index', $data);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/umkm');
            exit;
        }
        csrf_require('/umkm');

        $nama      = trim($_POST['nama'] ?? '');
        $pemilik   = trim($_POST['pemilik'] ?? '');
        $kategori  = trim($_POST['kategori'] ?? '');
        $deskripsi = trim($_POST['deskripsi'] ?? '');
        $produk    = trim($_POST['produk'] ?? '');
        $kontak    = trim($_POST['kontak'] ?? '');
        $alamat    = trim($_POST['alamat'] ?? '');

        if ($nama === '') {
            $_SESSION['error'] = 'Nama UMKM wajib diisi.';
            header('Location: ' . BASE_URL . '/umkm');
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

        header('Location: ' . BASE_URL . '/umkm');
        exit;
    }

    private function uploadFoto()
    {
        if (empty($_FILES['foto']['name'] ?? '')) {
            return null;
        }

        $file = $_FILES['foto'];

        if (($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
            SecurityLogger::log('upload.umkm_public.rejected', ['reason' => 'upload_error', 'code' => (int)($file['error'] ?? -1)]);
            return null;
        }

        if (empty($file['tmp_name']) || !is_uploaded_file($file['tmp_name'])) {
            SecurityLogger::log('upload.umkm_public.rejected', ['reason' => 'tmp_file_invalid']);
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
            SecurityLogger::log('upload.umkm_public.rejected', ['reason' => 'mime_invalid', 'mime' => $mime]);
            return null;
        }

        if (@getimagesize($file['tmp_name']) === false) {
            SecurityLogger::log('upload.umkm_public.rejected', ['reason' => 'not_image']);
            return null;
        }

        if (($file['size'] ?? 0) > 5 * 1024 * 1024) {
            SecurityLogger::log('upload.umkm_public.rejected', ['reason' => 'size_exceeded', 'size' => (int)($file['size'] ?? 0)]);
            return null;
        }

        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowedMime[$mime], true)) {
            SecurityLogger::log('upload.umkm_public.rejected', ['reason' => 'extension_mismatch', 'ext' => $ext, 'mime' => $mime]);
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
            SecurityLogger::log('upload.umkm_public.rejected', ['reason' => 'move_failed']);
            return null;
        }

        SecurityLogger::log('upload.umkm_public.accepted', ['file' => $foto], 'info');
        return $foto;
    }
}
