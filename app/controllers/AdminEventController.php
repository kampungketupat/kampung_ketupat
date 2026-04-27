<?php
// ============================================================
// AdminEventController (FINAL - WITH FOTO UPLOAD)
// ============================================================

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

    // =========================
    // INDEX
    // =========================
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

    // =========================
    // CREATE FORM
    // =========================
    public function create()
    {
        $data['judul_halaman'] = 'Tambah Event';
        $data['menu_aktif']    = 'event';
        $this->view('admin/event/create', $data);
    }

    // =========================
    // STORE (INSERT)
    // =========================
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/admin/event');
            exit;
        }

        // UPLOAD FOTO
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
            $this->eventModel->tambah(
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

            $_SESSION['success'] = 'Event berhasil ditambahkan!';
        } catch (Exception $e) {
            $_SESSION['error'] = 'Gagal menambahkan event!';
        }

        header('Location: ' . BASE_URL . '/admin/event');
        exit;
    }

    // =========================
    // EDIT FORM
    // =========================
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

    // =========================
    // UPDATE
    // =========================
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/admin/event');
            exit;
        }

        $id = $_POST['id'] ?? null;

        // UPLOAD FOTO BARU (kalau ada)
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
            $this->eventModel->update(
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

            $_SESSION['success'] = 'Event berhasil diperbarui!';
        } catch (Exception $e) {
            $_SESSION['error'] = 'Gagal memperbarui event!';
        }

        header('Location: ' . BASE_URL . '/admin/event');
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
            header('Location: ' . BASE_URL . '/admin/event');
            exit;
        }

        try {
            $this->eventModel->hapus($id);
            $_SESSION['success'] = 'Event berhasil dihapus!';
        } catch (Exception $e) {
            $_SESSION['error'] = 'Gagal menghapus event!';
        }

        header('Location: ' . BASE_URL . '/admin/event');
        exit;
    }

    // =========================
    // HELPER: UPLOAD FOTO
    // =========================
    private function uploadFoto(array $file): ?string
    {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
        $maxSize      = 5 * 1024 * 1024; // 5MB

        // Validasi tipe & ukuran
        if (!in_array($file['type'], $allowedTypes)) return null;
        if ($file['size'] > $maxSize) return null;
        if ($file['error'] !== UPLOAD_ERR_OK) return null;

        // Nama file unik
        $ext      = pathinfo($file['name'], PATHINFO_EXTENSION);
        $namaFile = time() . '_' . bin2hex(random_bytes(6)) . '.' . $ext;

        // Folder tujuan
        $uploadDir = BASE_PATH . '/public/assets/uploads/event/';

        // Buat folder kalau belum ada
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Pindahkan file
        if (move_uploaded_file($file['tmp_name'], $uploadDir . $namaFile)) {
            return $namaFile;
        }

        return null;
    }
}
