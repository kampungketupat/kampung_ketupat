<?php
// ============================================================
// AdminEventController (FINAL - MVC CLEAN)
// ============================================================

require_once BASE_PATH . '/app/core/Controller.php';
require_once BASE_PATH . '/app/models/EventModel.php';

class AdminEventController extends Controller
{
    private $eventModel;

    public function __construct()
    {
        // PROTEKSI LOGIN
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
        $data['semua_event'] = $this->eventModel->getAll();
        $data['judul_halaman'] = 'Kelola Event';
        $data['menu_aktif'] = 'event';

        $this->view('admin/event/index', $data);
    }

    // =========================
    // CREATE FORM
    // =========================
    public function create()
    {
        $data['judul_halaman'] = 'Tambah Event';
        $data['menu_aktif'] = 'event';

        $this->view('admin/event/create', $data);
    }

    // =========================
    // STORE (INSERT)
    // =========================
    // =========================
    // STORE
    // =========================
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/admin/event');
            exit;
        }

        try {
            $this->eventModel->tambah(
                $_POST['nama_event'],
                $_POST['deskripsi'],
                $_POST['tanggal_mulai'],
                $_POST['tanggal_selesai'],
                $_POST['lokasi'],
                null,
                $_POST['status'],
                $_POST['link_info'],
                $_POST['jam_mulai'],
                $_POST['jam_selesai']
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

        $data['event'] = $event;
        $data['judul_halaman'] = 'Edit Event';
        $data['menu_aktif'] = 'event';

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

        try {
            $this->eventModel->update(
                $_POST['id'],
                $_POST['nama_event'],
                $_POST['deskripsi'],
                $_POST['tanggal_mulai'],
                $_POST['tanggal_selesai'],
                $_POST['lokasi'],
                $_POST['status'],
                $_POST['link_info'],
                $_POST['jam_mulai'],
                $_POST['jam_selesai']
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
}
