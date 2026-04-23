<?php
// ============================================================
// FILE: app/models/KritikSaranModel.php
// ============================================================

class KritikSaranModel {
    private $db;

    public function __construct($koneksi) {
        $this->db = $koneksi;
    }

    // ===== GET ALL =====
    public function getAll() {
        $result = $this->db->query("SELECT * FROM kritik_saran ORDER BY created_at DESC");
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    // ===== GET BY ID =====
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM kritik_saran WHERE id = ?");

        if (!$stmt) return null;

        $stmt->bind_param('i', $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $data = $result ? $result->fetch_assoc() : null;

        $stmt->close();

        return $data;
    }

    // ===== COUNT BELUM DIBACA =====
    public function countBelumDibaca() {
        $result = $this->db->query("
            SELECT COUNT(*) as total 
            FROM kritik_saran 
            WHERE sudah_dibaca = 0
        ");

        $data = $result ? $result->fetch_assoc() : ['total' => 0];

        return $data['total'];
    }

    // ===== COUNT ALL =====
    public function countAll() {
        $result = $this->db->query("SELECT COUNT(*) as total FROM kritik_saran");

        $data = $result ? $result->fetch_assoc() : ['total' => 0];

        return $data['total'];
    }

    // ===== SIMPAN =====
    public function simpan($nama, $email, $jenis, $pesan) {
        $stmt = $this->db->prepare("
            INSERT INTO kritik_saran 
            (nama_pengunjung, email, jenis, pesan) 
            VALUES (?,?,?,?)
        ");

        if (!$stmt) return false;

        $stmt->bind_param('ssss', $nama, $email, $jenis, $pesan);

        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    // ===== TANDAI DIBACA =====
    public function tandaiDibaca($id) {
        $stmt = $this->db->prepare("
            UPDATE kritik_saran 
            SET sudah_dibaca = 1 
            WHERE id = ?
        ");

        if (!$stmt) return false;

        $stmt->bind_param('i', $id);

        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    // ===== DELETE =====
    public function hapus($id) {
        $stmt = $this->db->prepare("DELETE FROM kritik_saran WHERE id = ?");

        if (!$stmt) return false;

        $stmt->bind_param('i', $id);

        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }
}