<?php

require_once BASE_PATH . '/app/core/Controller.php';

class KontakController extends Controller
{
    public function index()
    {
        $data['judul_halaman'] = 'Kontak — Kampung Ketupat Warna Warni';
        $data['halaman_aktif'] = 'kontak';

        $this->view('user/kontak/index', $data);
    }
}