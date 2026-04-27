<?php

// buat ngasih tau jalan apa aja yang bisa diakses di website kita, dan nanti akan dihubungkan ke controller mana

// =========================
// USER
// =========================
$router->get('/', 'BerandaController@index');

$router->get('/wisata', 'WisataController@index');

$router->get('/event', 'EventController@index');

$router->get('/galeri', 'GaleriController@index');

$router->get('/umkm', 'UMKMController@index');
$router->post('/umkm/store', 'UMKMController@store');

$router->get('/lokasi', 'LokasiController@index');

$router->get('/kontak', 'KontakController@index');

$router->get('/kritik-saran', 'KritikSaranController@index');
$router->post('/kritik-saran', 'KritikSaranController@index');


// =========================
// AUTH
// =========================
$router->get('/admin/login', 'AuthController@login');
$router->post('/admin/login/proses', 'AuthController@proses');
$router->get('/admin/logout', 'AuthController@logout');


// =========================
// ADMIN DASHBOARD
// =========================
$router->get('/admin/dashboard', 'AdminController@dashboard');


// =========================
// ADMIN GALERI
// =========================
$router->get('/admin/galeri', 'AdminGaleriController@index');
$router->get('/admin/galeri/create', 'AdminGaleriController@create');
$router->post('/admin/galeri/store', 'AdminGaleriController@store');

$router->get('/admin/galeri/edit', 'AdminGaleriController@edit');
$router->post('/admin/galeri/update', 'AdminGaleriController@update');

$router->get('/admin/galeri/delete', 'AdminGaleriController@delete');

$router->post('/admin/galeri/togglePublish', 'AdminGaleriController@togglePublish');
$router->get('/admin/galeri/publishAll', 'AdminGaleriController@publishAll');


// =========================
// ADMIN EVENT
// =========================
$router->get('/admin/event', 'AdminEventController@index');
$router->get('/admin/event/create', 'AdminEventController@create');
$router->post('/admin/event/store', 'AdminEventController@store');

$router->get('/admin/event/edit', 'AdminEventController@edit');
$router->post('/admin/event/update', 'AdminEventController@update');

$router->get('/admin/event/delete', 'AdminEventController@delete');


// =========================
// ADMIN UMKM
// =========================
$router->get('/admin/umkm', 'AdminUMKMController@index');
$router->get('/admin/umkm/create', 'AdminUMKMController@create');
$router->post('/admin/umkm/store', 'AdminUMKMController@store');

$router->get('/admin/umkm/edit', 'AdminUMKMController@edit');
$router->post('/admin/umkm/update', 'AdminUMKMController@update');

$router->get('/admin/umkm/delete', 'AdminUMKMController@delete');


// =========================
// ADMIN KRITIK SARAN
// =========================
$router->get('/admin/kritik-saran',            'AdminKritikController@index');
$router->get('/admin/kritik-saran/arsip',      'AdminKritikController@arsip');
$router->get('/admin/kritik-saran/terima',     'AdminKritikController@terima');
$router->get('/admin/kritik-saran/kembalikan', 'AdminKritikController@kembalikan');
$router->get('/admin/kritik-saran/tampilkan',  'AdminKritikController@tampilkan');
$router->get('/admin/kritik-saran/sembunyikan', 'AdminKritikController@sembunyikan');
