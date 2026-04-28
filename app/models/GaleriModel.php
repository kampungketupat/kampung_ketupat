<?php

class GaleriModel
{
    private $db;

    public function __construct($koneksi)
    {
        $this->db = $koneksi;
    }

    // =========================
    // ADMIN (SEMUA DATA)
    // =========================
    public function getAll()
    {
        $result = $this->db->query("
            SELECT * FROM galeri 
            ORDER BY created_at DESC
        ");

        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }


    public function countAll()
    {
        $result = $this->db->query("
            SELECT COUNT(*) as total 
            FROM galeri 
            WHERE is_publish = 1
        ");

        $data = $result ? $result->fetch_assoc() : ['total' => 0];

        return $data['total'];
    }
    // =========================
    // USER (HANYA YANG DITAMPILKAN)
    // =========================
    public function getAllPublished()
    {
        $result = $this->db->query("
            SELECT * FROM galeri 
            WHERE is_publish = 1
            ORDER BY created_at DESC
        ");

        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    // =========================
    // 🔥 LIMIT UNTUK BERANDA
    // =========================
    public function getPublishedLimit($limit)
    {
        $stmt = $this->db->prepare("
            SELECT * FROM galeri 
            WHERE is_publish = 1
            ORDER BY created_at DESC
            LIMIT ?
        ");

        if (!$stmt) return [];

        $stmt->bind_param('i', $limit);
        $stmt->execute();

        $result = $stmt->get_result();
        $data = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];

        $stmt->close();

        return $data;
    }

    // =========================
    // GET BY ID
    // =========================
    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM galeri WHERE id = ?");

        if (!$stmt) return null;

        $stmt->bind_param('i', $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $data = $result ? $result->fetch_assoc() : null;

        $stmt->close();

        return $data;
    }

    // =========================
    // TAMBAH
    // =========================
    public function tambah($judul, $deskripsi, $foto, $kategori)
    {
        $stmt = $this->db->prepare("
            INSERT INTO galeri (judul, deskripsi, foto, kategori, is_publish) 
            VALUES (?, ?, ?, ?, 1)
        ");

        if (!$stmt) return false;

        $stmt->bind_param('ssss', $judul, $deskripsi, $foto, $kategori);

        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    // =========================
    // UPDATE
    // =========================
    public function update($id, $judul, $deskripsi, $kategori, $foto = null)
    {
        if ($foto) {
            $stmt = $this->db->prepare("
                UPDATE galeri 
                SET judul=?, deskripsi=?, kategori=?, foto=? 
                WHERE id=?
            ");

            if (!$stmt) return false;

            $stmt->bind_param('ssssi', $judul, $deskripsi, $kategori, $foto, $id);
        } else {
            $stmt = $this->db->prepare("
                UPDATE galeri 
                SET judul=?, deskripsi=?, kategori=? 
                WHERE id=?
            ");

            if (!$stmt) return false;

            $stmt->bind_param('sssi', $judul, $deskripsi, $kategori, $id);
        }

        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    // =========================
    // DELETE
    // =========================
    public function hapus($id)
    {
        $data = $this->getById($id);

        $stmt = $this->db->prepare("DELETE FROM galeri WHERE id=?");

        if (!$stmt) return false;

        $stmt->bind_param('i', $id);
        $result = $stmt->execute();
        $stmt->close();

        if ($result && $data && !empty($data['foto'])) {
            $fileName = basename((string)$data['foto']);
            $baseDir = realpath(BASE_PATH . '/public/assets/uploads/galeri');
            $filePath = realpath(BASE_PATH . '/public/assets/uploads/galeri/' . $fileName);

            if (
                $baseDir &&
                $filePath &&
                strpos((string)$data['foto'], 'http') !== 0 &&
                strpos($filePath, $baseDir . DIRECTORY_SEPARATOR) === 0 &&
                is_file($filePath)
            ) {
                unlink($filePath);
            }
        }

        return $result;
    }

    // =========================
    // TOGGLE PUBLISH
    // =========================
    public function setPublish($id, $status)
    {
        $stmt = $this->db->prepare("UPDATE galeri SET is_publish=? WHERE id=?");

        if (!$stmt) return false;

        $stmt->bind_param('ii', $status, $id);

        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    // =========================
    // PUBLISH ALL
    // =========================
    public function publishAll()
    {
        return $this->db->query("UPDATE galeri SET is_publish=1");
    }
}
