<?php

require_once BASE_PATH . '/app/core/Controller.php';
require_once BASE_PATH . '/app/models/EventModel.php';

class EventController extends Controller
{
    private $eventModel;

    public function __construct()
    {
        global $koneksi;
        $this->eventModel = new EventModel($koneksi);
    }

    public function index()
    {
        $data['semua_event'] = $this->eventModel->getAll();

        $data['judul_halaman'] = 'Kalender Event — Kampung Ketupat Warna Warni';
        $data['halaman_aktif'] = 'event';

        $this->view('user/event/index', $data);
    }
}
