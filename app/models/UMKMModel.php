<?php

class UMKMModel {
    private $db;

    public function __construct($koneksi) {
        $this->db = $koneksi;
    }

    public function getAll() {
        $result = $this->db->query("SELECT * FROM umkm ORDER BY created_at DESC");
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM umkm WHERE id = ?");

        if (!$stmt) return null;

        $stmt->bind_param('i', $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $data = $result ? $result->fetch_assoc() : null;

        $stmt->close();

        return $data;
    }

    public function countAll() {
        $result = $this->db->query("SELECT COUNT(*) as total FROM umkm");
        $data = $result ? $result->fetch_assoc() : ['total' => 0];

        return $data['total'];
    }

    public function tambah($nama, $pemilik, $kategori, $deskripsi, $produk, $kontak, $alamat, $foto) {
        $stmt = $this->db->prepare("
            INSERT INTO umkm 
            (nama_umkm, pemilik, kategori, deskripsi, produk_unggulan, kontak, alamat, foto) 
            VALUES (?,?,?,?,?,?,?,?)
        ");

        if (!$stmt) return false;

        $stmt->bind_param('ssssssss', $nama, $pemilik, $kategori, $deskripsi, $produk, $kontak, $alamat, $foto);

        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function update($id, $nama, $pemilik, $kategori, $deskripsi, $produk, $kontak, $alamat, $foto = null) {
        if ($foto) {
            $stmt = $this->db->prepare("
                UPDATE umkm SET 
                nama_umkm=?, 
                pemilik=?, 
                kategori=?, 
                deskripsi=?, 
                produk_unggulan=?, 
                kontak=?, 
                alamat=?, 
                foto=? 
                WHERE id=?
            ");

            if (!$stmt) return false;

            $stmt->bind_param(
                'ssssssssi',
                $nama,
                $pemilik,
                $kategori,
                $deskripsi,
                $produk,
                $kontak,
                $alamat,
                $foto,
                $id
            );
        } else {
            $stmt = $this->db->prepare("
                UPDATE umkm SET 
                nama_umkm=?, 
                pemilik=?, 
                kategori=?, 
                deskripsi=?, 
                produk_unggulan=?, 
                kontak=?, 
                alamat=? 
                WHERE id=?
            ");

            if (!$stmt) return false;

            $stmt->bind_param(
                'sssssssi',
                $nama,
                $pemilik,
                $kategori,
                $deskripsi,
                $produk,
                $kontak,
                $alamat,
                $id
            );
        }

        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function hapus($id) {
        $data = $this->getById($id);

        $stmt = $this->db->prepare("DELETE FROM umkm WHERE id=?");

        if (!$stmt) return false;

        $stmt->bind_param('i', $id);

        $result = $stmt->execute();
        $stmt->close();

        if ($result && $data && !empty($data['foto'])) {
            $fileName = basename((string)$data['foto']);
            $baseDir = realpath(BASE_PATH . '/public/assets/uploads/umkm');
            $filePath = realpath(BASE_PATH . '/public/assets/uploads/umkm/' . $fileName);

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
}
