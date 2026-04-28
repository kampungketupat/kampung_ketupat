<?php

require_once BASE_PATH . '/app/core/Controller.php';
require_once BASE_PATH . '/app/models/EventModel.php';

class AdminEventController extends Controller
{
    private $eventModel;

    public function __construct()
    {
        if (!isset($_SESSION['admin'])) {
            header('Location: ' . BASE_URL . '/admin/login');
            exit;
        }

        global $koneksi;
        $this->eventModel = new EventModel($koneksi);
    }

    public function index()
    {
        $data['semua_event']   = $this->eventModel->getAll();
        $data['judul_halaman'] = 'Kelola Event';
        $data['menu_aktif']    = 'event';

        if (!empty($_SESSION['success'])) {
            $data['pesan_sukses'] = $_SESSION['success'];
            unset($_SESSION['success']);
        }
        if (!empty($_SESSION['error'])) {
            $data['pesan_error'] = $_SESSION['error'];
            unset($_SESSION['error']);
        }

        $this->view('admin/event/index', $data);
    }

    public function create()
    {
        $data['judul_halaman'] = 'Tambah Event';
        $data['menu_aktif']    = 'event';
        $this->view('admin/event/create', $data);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/admin/event');
            exit;
        }
        csrf_require('/admin/event');

        $foto = null;
        if (!empty($_FILES['foto']['name'])) {
            $foto = $this->uploadFoto($_FILES['foto']);
            if (!$foto) {
                $_SESSION['error'] = 'Gagal upload foto! Pastikan format JPG/PNG/WEBP dan ukuran maks 5MB.';
                header('Location: ' . BASE_URL . '/admin/event/create');
                exit;
            }
        }

        try {
            $ok = $this->eventModel->tambah(
                $_POST['nama_event']    ?? '',
                $_POST['deskripsi']     ?? '',
                $_POST['tanggal_mulai'] ?? '',
                $_POST['tanggal_selesai'] ?? null,
                $_POST['lokasi']        ?? '',
                $foto,
                $_POST['status']        ?? 'akan_datang',
                $_POST['link_info']     ?? null,
                $_POST['jam_mulai']     ?? null,
                $_POST['jam_selesai']   ?? null
            );

            if (!$ok) {
                throw new RuntimeException('Gagal menambahkan event ke database.');
            }

            $_SESSION['success'] = 'Event berhasil ditambahkan!';
        } catch (Throwable $e) {
            $_SESSION['error'] = $e->getMessage();
        }

        header('Location: ' . BASE_URL . '/admin/event');
        exit;
    }

    public function edit()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            header('Location: ' . BASE_URL . '/admin/event');
            exit;
        }

        $event = $this->eventModel->getById($id);

        if (!$event) {
            header('Location: ' . BASE_URL . '/admin/event');
            exit;
        }

        $data['event']         = $event;
        $data['judul_halaman'] = 'Edit Event';
        $data['menu_aktif']    = 'event';

        $this->view('admin/event/edit', $data);
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/admin/event');
            exit;
        }
        csrf_require('/admin/event');

        $id = $_POST['id'] ?? null;

        $foto = null;
        if (!empty($_FILES['foto']['name'])) {
            $foto = $this->uploadFoto($_FILES['foto']);
            if (!$foto) {
                $_SESSION['error'] = 'Gagal upload foto! Pastikan format JPG/PNG/WEBP dan ukuran maks 5MB.';
                header('Location: ' . BASE_URL . '/admin/event/edit?id=' . $id);
                exit;
            }
        }

        try {
            $ok = $this->eventModel->update(
                $id,
                $_POST['nama_event']      ?? '',
                $_POST['deskripsi']       ?? '',
                $_POST['tanggal_mulai']   ?? '',
                $_POST['tanggal_selesai'] ?? null,
                $_POST['lokasi']          ?? '',
                $_POST['status']          ?? 'akan_datang',
                $_POST['link_info']       ?? null,
                $_POST['jam_mulai']       ?? null,
                $_POST['jam_selesai']     ?? null,
                $foto  // null = tidak ganti foto lama
            );

            if (!$ok) {
                throw new RuntimeException('Gagal memperbarui event.');
            }

            $_SESSION['success'] = 'Event berhasil diperbarui!';
        } catch (Throwable $e) {
            $_SESSION['error'] = $e->getMessage();
        }

        header('Location: ' . BASE_URL . '/admin/event');
        exit;
    }

    public function delete()
    {
        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
            header('Location: ' . BASE_URL . '/admin/event');
            exit;
        }
        csrf_require('/admin/event');

        $id = $_POST['id'] ?? null;

        if (!$id) {
            $_SESSION['error'] = 'ID tidak valid!';
            header('Location: ' . BASE_URL . '/admin/event');
            exit;
        }

        try {
            $ok = $this->eventModel->hapus($id);
            if (!$ok) {
                throw new RuntimeException('Gagal menghapus event.');
            }
            $_SESSION['success'] = 'Event berhasil dihapus!';
        } catch (Throwable $e) {
            $_SESSION['error'] = $e->getMessage();
        }

        header('Location: ' . BASE_URL . '/admin/event');
        exit;
    }

    private function uploadFoto(array $file): ?string
    {
        $allowedTypes = [
            'image/jpeg' => ['jpg', 'jpeg'],
            'image/png' => ['png'],
            'image/webp' => ['webp'],
        ];
        $maxSize      = 5 * 1024 * 1024; // 5MB

        if (empty($file['tmp_name']) || !is_uploaded_file($file['tmp_name'])) {
            SecurityLogger::log('upload.event.rejected', ['reason' => 'tmp_file_invalid']);
            return null;
        }

        $detectedMime = '';
        if (class_exists('finfo')) {
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $detectedMime = (string)$finfo->file($file['tmp_name']);
        }
        if ($detectedMime === '') {
            $detectedMime = mime_content_type($file['tmp_name']) ?: '';
        }
        if (!isset($allowedTypes[$detectedMime])) {
            SecurityLogger::log('upload.event.rejected', ['reason' => 'mime_invalid', 'mime' => $detectedMime]);
            return null;
        }
        if ($file['size'] > $maxSize) {
            SecurityLogger::log('upload.event.rejected', ['reason' => 'size_exceeded', 'size' => (int)$file['size']]);
            return null;
        }
        if ($file['error'] !== UPLOAD_ERR_OK) {
            SecurityLogger::log('upload.event.rejected', ['reason' => 'upload_error', 'code' => (int)$file['error']]);
            return null;
        }
        if (@getimagesize($file['tmp_name']) === false) {
            SecurityLogger::log('upload.event.rejected', ['reason' => 'not_image']);
            return null;
        }

        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowedTypes[$detectedMime], true)) {
            SecurityLogger::log('upload.event.rejected', ['reason' => 'extension_mismatch', 'ext' => $ext, 'mime' => $detectedMime]);
            return null;
        }
        try {
            $suffix = bin2hex(random_bytes(6));
        } catch (Throwable $e) {
            $suffix = uniqid();
        }
        $namaFile = time() . '_' . $suffix . '.' . $ext;

        $uploadDir = BASE_PATH . '/public/assets/uploads/event/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        if (move_uploaded_file($file['tmp_name'], $uploadDir . $namaFile)) {
            SecurityLogger::log('upload.event.accepted', ['file' => $namaFile], 'info');
            return $namaFile;
        }

        SecurityLogger::log('upload.event.rejected', ['reason' => 'move_failed']);
        return null;
    }
}
