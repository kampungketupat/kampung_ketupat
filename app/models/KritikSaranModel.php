<?php
// ============================================================
// FILE: app/models/KritikSaranModel.php
// ============================================================

class KritikSaranModel
{
    private $db;

    public function __construct($koneksi)
    {
        $this->db = $koneksi;
    }

    // ===== GET PENDING (kotak masuk) =====
    public function getPending()
    {
        $result = $this->db->query("
            SELECT * FROM kritik_saran
            WHERE status = 'pending'
            ORDER BY created_at DESC
        ");
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    // ===== GET ARSIP (diterima, belum/sudah publik) =====
    public function getArsip()
    {
        $result = $this->db->query("
            SELECT * FROM kritik_saran
            WHERE status IN ('diterima', 'publik')
            ORDER BY created_at DESC
        ");
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    // ===== GET PUBLIK (untuk halaman user, cek expired) =====
    public function getPublik()
    {
        $result = $this->db->query("
            SELECT * FROM kritik_saran
            WHERE status = 'publik'
              AND tampil_mulai  <= CURDATE()
              AND tampil_selesai >= CURDATE()
            ORDER BY created_at DESC
        ");
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    // ===== GET BY ID =====
    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM kritik_saran WHERE id = ?");
        if (!$stmt) return null;
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $data = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $data;
    }

    // ===== COUNT =====
    public function countPending()
    {
        $r = $this->db->query("SELECT COUNT(*) as t FROM kritik_saran WHERE status = 'pending'");
        return $r ? (int)$r->fetch_assoc()['t'] : 0;
    }

    public function countArsip()
    {
        $r = $this->db->query("SELECT COUNT(*) as t FROM kritik_saran WHERE status IN ('diterima','publik')");
        return $r ? (int)$r->fetch_assoc()['t'] : 0;
    }

    public function countBelumDibaca()
    {
        $r = $this->db->query("SELECT COUNT(*) as t FROM kritik_saran WHERE sudah_dibaca = 0 AND status = 'pending'");
        return $r ? (int)$r->fetch_assoc()['t'] : 0;
    }

    // ===== SIMPAN (dari form user, default pending) =====
    public function simpan($nama, $email, $jenis, $pesan)
    {
        $stmt = $this->db->prepare("
            INSERT INTO kritik_saran (nama_pengunjung, email, jenis, pesan, status)
            VALUES (?, ?, ?, ?, 'pending')
        ");
        if (!$stmt) return false;
        $stmt->bind_param('ssss', $nama, $email, $jenis, $pesan);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // ===== TANDAI DIBACA =====
    public function tandaiDibaca($id)
    {
        $stmt = $this->db->prepare("UPDATE kritik_saran SET sudah_dibaca = 1 WHERE id = ?");
        if (!$stmt) return false;
        $stmt->bind_param('i', $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // ===== TERIMA (pending → diterima/arsip) =====
    public function terima($id)
    {
        $stmt = $this->db->prepare("UPDATE kritik_saran SET status = 'diterima' WHERE id = ?");
        if (!$stmt) return false;
        $stmt->bind_param('i', $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // ===== KEMBALIKAN KE PENDING =====
    public function kembalikanPending($id)
    {
        $stmt = $this->db->prepare("UPDATE kritik_saran SET status = 'pending' WHERE id = ?");
        if (!$stmt) return false;
        $stmt->bind_param('i', $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // ===== TAMPILKAN KE PUBLIK =====
    public function tampilkan($id, $mulai, $selesai)
    {
        $stmt = $this->db->prepare("
            UPDATE kritik_saran
            SET status = 'publik', tampil_mulai = ?, tampil_selesai = ?
            WHERE id = ?
        ");
        if (!$stmt) return false;
        $stmt->bind_param('ssi', $mulai, $selesai, $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // ===== SEMBUNYIKAN (publik → diterima) =====
    public function sembunyikan($id)
    {
        $stmt = $this->db->prepare("
            UPDATE kritik_saran
            SET status = 'diterima', tampil_mulai = NULL, tampil_selesai = NULL
            WHERE id = ?
        ");
        if (!$stmt) return false;
        $stmt->bind_param('i', $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // ===== AUTO-EXPIRE: jalankan tiap kali index dipanggil =====
    public function expireOtomatis()
    {
        $this->db->query("
            UPDATE kritik_saran
            SET status = 'diterima', tampil_mulai = NULL, tampil_selesai = NULL
            WHERE status = 'publik' AND tampil_selesai < CURDATE()
        ");
    }
}
