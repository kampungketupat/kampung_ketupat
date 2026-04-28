<?php

require_once BASE_PATH . '/app/core/Controller.php';

class LokasiController extends Controller
{
    public function index()
    {
        $data['judul_halaman'] = 'Lokasi — Kampung Ketupat Warna Warni';
        $data['halaman_aktif'] = 'lokasi';

        $this->view('user/lokasi/index', $data);
    }
}
