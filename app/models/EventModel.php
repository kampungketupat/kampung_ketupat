<?php

class EventModel
{
    private $db;

    private function normalizeJam(?string $mulai, ?string $selesai): array
    {
        $mulai = $mulai !== '' ? $mulai : null;
        $selesai = $selesai !== '' ? $selesai : null;

        if (!$mulai || !$selesai) {
            return [$mulai, $selesai];
        }

        $tMulai = strtotime('1970-01-01 ' . substr($mulai, 0, 5));
        $tSelesai = strtotime('1970-01-01 ' . substr($selesai, 0, 5));

        if ($tMulai !== false && $tSelesai !== false && $tSelesai < $tMulai) {
            return [$selesai, $mulai];
        }

        return [$mulai, $selesai];
    }

    public function __construct($koneksi)
    {
        $this->db = $koneksi;
    }

    public function getAll()
    {
        $result = $this->db->query("
            SELECT * FROM event 
            ORDER BY tanggal_mulai ASC
        ");

        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM event WHERE id = ?");

        if (!$stmt) return null;

        $stmt->bind_param('i', $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $data = $result ? $result->fetch_assoc() : null;

        $stmt->close();

        return $data;
    }

    public function getAkanDatang()
    {
        $result = $this->db->query("
            SELECT * FROM event 
            WHERE status IN ('akan_datang','berlangsung') 
            ORDER BY tanggal_mulai ASC 
            LIMIT 3
        ");

        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    public function countAll()
    {
        $result = $this->db->query("
            SELECT COUNT(*) as total 
            FROM event 
            WHERE status != 'selesai'
        ");

        $data = $result ? $result->fetch_assoc() : ['total' => 0];

        return $data['total'];
    }

    public function tambah(
        $nama,
        $deskripsi,
        $tgl_mulai,
        $tgl_selesai,
        $lokasi,
        $foto,
        $status,
        $link_info,
        $jam_mulai,
        $jam_selesai
    ) {
        [$jam_mulai, $jam_selesai] = $this->normalizeJam($jam_mulai, $jam_selesai);

        $stmt = $this->db->prepare("
            INSERT INTO event 
            (nama_event, deskripsi, tanggal_mulai, tanggal_selesai, lokasi, foto, status, link_info, jam_mulai, jam_selesai) 
            VALUES (?,?,?,?,?,?,?,?,?,?)
        ");

        if (!$stmt) return false;

        $stmt->bind_param(
            'ssssssssss',
            $nama,
            $deskripsi,
            $tgl_mulai,
            $tgl_selesai,
            $lokasi,
            $foto,
            $status,
            $link_info,
            $jam_mulai,
            $jam_selesai
        );

        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function update(
        $id,
        $nama,
        $deskripsi,
        $tgl_mulai,
        $tgl_selesai,
        $lokasi,
        $status,
        $link_info,
        $jam_mulai,
        $jam_selesai,
        $foto = null
    ) {
        [$jam_mulai, $jam_selesai] = $this->normalizeJam($jam_mulai, $jam_selesai);

        if ($foto) {
            $stmt = $this->db->prepare("
                UPDATE event SET 
                nama_event=?, 
                deskripsi=?, 
                tanggal_mulai=?, 
                tanggal_selesai=?, 
                lokasi=?, 
                status=?, 
                link_info=?,
                jam_mulai=?,
                jam_selesai=?,
                foto=? 
                WHERE id=?
            ");

            if (!$stmt) return false;

            $stmt->bind_param(
                'ssssssssssi',
                $nama,
                $deskripsi,
                $tgl_mulai,
                $tgl_selesai,
                $lokasi,
                $status,
                $link_info,
                $jam_mulai,
                $jam_selesai,
                $foto,
                $id
            );
        } else {
            $stmt = $this->db->prepare("
                UPDATE event SET 
                nama_event=?, 
                deskripsi=?, 
                tanggal_mulai=?, 
                tanggal_selesai=?, 
                lokasi=?, 
                status=?, 
                link_info=?,
                jam_mulai=?,
                jam_selesai=? 
                WHERE id=?
            ");

            if (!$stmt) return false;

            $stmt->bind_param(
                'sssssssssi',
                $nama,
                $deskripsi,
                $tgl_mulai,
                $tgl_selesai,
                $lokasi,
                $status,
                $link_info,
                $jam_mulai,
                $jam_selesai,
                $id
            );
        }

        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function hapus($id)
    {
        $stmt = $this->db->prepare("DELETE FROM event WHERE id=?");

        if (!$stmt) return false;

        $stmt->bind_param('i', $id);

        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }
}