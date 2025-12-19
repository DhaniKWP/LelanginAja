<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');
$routes->get('/dashboard', 'Home::index');
$routes->get('/lelang/(:num)', 'Home::detail/$1');

/* =========================
|  AUTH
==========================*/
$routes->get('/login','Auth::login');
$routes->post('/login/process','Auth::loginProcess');
$routes->get('/register','Auth::register');
$routes->post('/register/process','Auth::registerProcess');
$routes->get('/logout','Auth::logout');


/* =========================
|  USER ROUTES (HARUS LOGIN)
==========================*/
$routes->group('user', ['filter'=>'user'], function($routes){

    // Dashboard
    $routes->get('dashboard','User\Dashboard::index');

    // Barang
    $routes->get('barang','User\Barang::index');
    $routes->get('barang/create','User\Barang::create');
    $routes->post('barang/store','User\Barang::store');
    $routes->get('barang/edit/(:num)', 'User\Barang::edit/$1');
    $routes->post('barang/update/(:num)', 'User\Barang::update/$1');

    // Jadwal & Hasil Lelang
    $routes->get('barang/jadwal', 'User\Lelang::jadwalBarang');
    $routes->get('barang/hasil',  'User\Lelang::hasilBarang');
    $routes->get('lelang/monitoring/(:num)', 'User\Lelang::monitoringBarang/$1');

    // Lelang
    $routes->get('lelang/aktif','User\Lelang::aktif');
    $routes->get('lelang/detail/(:num)','User\Lelang::detail/$1');

    // Bid
    $routes->post('bid/(:num)','User\Bid::submit/$1');

    // Riwayat bid
    $routes->get('lelang/riwayat', 'User\Lelang::riwayat');

    // Status pemenang
    $routes->get('pemenang', 'User\Pemenang::status');
    $routes->get('lelang/pemenang', 'User\Pemenang::status');

    // Pembayaran
    $routes->get('pembayaran/(:num)','User\Pembayaran::form/$1');
    $routes->post('pembayaran/submit/(:num)','User\Pembayaran::submit/$1');
    $routes->get('pembayaran', 'User\Pembayaran::index');

    // Peserta lelang
    $routes->get('peserta','User\Peserta::index');
    $routes->get('peserta/daftar','User\Peserta::daftar');
    $routes->post('peserta/store','User\Peserta::store');
});


/* =========================
|  ADMIN ROUTES (ONLY ADMIN)
==========================*/
$routes->group('admin', ['filter'=>'admin'], function($routes){

    // Dashboard
    $routes->get('dashboard','Admin\Dashboard::index');

    // USER CRUD
    $routes->get('user','Admin\User::index');
    $routes->get('user/create','Admin\User::create');
    $routes->post('user/store','Admin\User::store');
    $routes->get('user/edit/(:num)','Admin\User::edit/$1');
    $routes->post('user/update/(:num)','Admin\User::update/$1');
    $routes->get('user/delete/(:num)','Admin\User::delete/$1');

    // Kategori (Kalau kategori masih ada)
    $routes->get('kategori','Admin\Kategori::index');
    $routes->get('kategori/create','Admin\Kategori::create');
    $routes->post('kategori/store','Admin\Kategori::store');
    $routes->get('kategori/edit/(:num)','Admin\Kategori::edit/$1');
    $routes->post('kategori/update/(:num)','Admin\Kategori::update/$1');
    $routes->get('kategori/delete/(:num)','Admin\Kategori::delete/$1');

    // Kondisi Barang
    $routes->get('kondisi','Admin\Kondisi::index');
    $routes->get('kondisi/create','Admin\Kondisi::create');
    $routes->post('kondisi/store','Admin\Kondisi::store');
    $routes->get('kondisi/edit/(:num)','Admin\Kondisi::edit/$1');
    $routes->post('kondisi/update/(:num)','Admin\Kondisi::update/$1');
    $routes->get('kondisi/delete/(:num)','Admin\Kondisi::delete/$1');

    // Barang User
    $routes->get('barang','Admin\Barang::index');
    $routes->get('barang/edit/(:num)','Admin\Barang::edit/$1'); 
    $routes->post('barang/update/(:num)','Admin\Barang::update/$1'); 
    $routes->get('barang/delete/(:num)','Admin\Barang::delete/$1'); 

    // Barang pending approval
    $routes->get('pengajuanbarang','Admin\Barang::pengajuan'); 
    $routes->get('pengajuanbarang/approve/(:num)','Admin\Barang::approve/$1'); 
    $routes->get('pengajuanbarang/reject/(:num)','Admin\Barang::reject/$1'); 

    // Lelang
    $routes->group('lelang', function($routes){
        $routes->get('jadwal','Admin\Lelang::jadwal');
        $routes->get('create','Admin\Lelang::create');
        $routes->post('store','Admin\Lelang::store');

        $routes->get('edit/(:num)','Admin\Lelang::edit/$1');
        $routes->post('update/(:num)','Admin\Lelang::update/$1');
        $routes->get('delete/(:num)','Admin\Lelang::delete/$1');

        $routes->get('aktif','Admin\Lelang::aktif');
        $routes->get('stop/(:num)','Admin\Lelang::stop/$1');
        $routes->get('monitor/(:num)','Admin\Lelang::monitoring/$1');
    });

    // Pemenang
    $routes->get('pemenang', 'Admin\Pemenang::index');
    $routes->get('pemenang/detail/(:num)', 'Admin\Pemenang::detail/$1');

    // pembayaran verifikasi
    $routes->get('pembayaran','Admin\Pembayaran::index');
    $routes->get('pembayaran/detail/(:num)','Admin\Pembayaran::detail/$1');
    $routes->get('pembayaran/verifikasi/(:num)/(:segment)','Admin\Pembayaran::verifikasi/$1/$2');

    // Kelola Peserta
    $routes->get('peserta','Admin\Peserta::index');
    $routes->get('peserta/approve/(:num)','Admin\Peserta::approve/$1');
    $routes->get('peserta/reject/(:num)','Admin\Peserta::reject/$1');

    // LAPORAN (ADMIN)
    $routes->group('laporan', function($routes){
        // LAPORAN BARANG
        $routes->get('barang', 'Admin\Laporan::barang');
        $routes->get('barang/pdf', 'Admin\Laporan::barangPdf');
        $routes->get('barang/excel', 'Admin\Laporan::barangExcel');

        // LAPORAN LELANG
        $routes->get('lelang', 'Admin\Laporan::lelang');
        $routes->get('lelang/pdf', 'Admin\Laporan::lelangPdf');
        $routes->get('lelang/excel', 'Admin\Laporan::lelangExcel');

        // Laporan Pemenang
        $routes->get('pemenang', 'Admin\Laporan::pemenang');
        $routes->get('pemenang/pdf', 'Admin\Laporan::pemenangPdf');
        $routes->get('pemenang/excel', 'Admin\Laporan::pemenangExcel');

        // Laporan Pembayaran
        $routes->get('pembayaran', 'Admin\Laporan::pembayaran');
        $routes->get('pembayaran/pdf', 'Admin\Laporan::pembayaranPdf');
        $routes->get('pembayaran/excel', 'Admin\Laporan::pembayaranExcel');

    });
});

