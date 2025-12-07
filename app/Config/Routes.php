<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/dashboard', 'Home::index');

// AUTH
$routes->get('/login','Auth::login');
$routes->post('/login/process','Auth::loginProcess');
$routes->get('/register','Auth::register');
$routes->post('/register/process','Auth::registerProcess');
$routes->get('/logout','Auth::logout');

// USER Dashboard
$routes->get('/user/dashboard','User\Dashboard::index',['filter'=>'user']);

// ADMIN Dashboard
$routes->get('/admin/dashboard','Admin\Dashboard::index',['filter'=>'admin']);

// CRUD USER
$routes->group('admin', ['filter' => 'admin'], function($routes){
    $routes->get('user','Admin\User::index');
    $routes->get('user/create','Admin\User::create');
    $routes->post('user/store','Admin\User::store');
    $routes->get('user/edit/(:num)','Admin\User::edit/$1');
    $routes->post('user/update/(:num)','Admin\User::update/$1');
    $routes->get('user/delete/(:num)','Admin\User::delete/$1');
});

// ADMIN KATEGORI
$routes->group('admin', ['filter' => 'admin'], function($routes){
    $routes->get('kategori','Admin\Kategori::index');
    $routes->get('kategori/create','Admin\Kategori::create');
    $routes->post('kategori/store','Admin\Kategori::store');
    $routes->get('kategori/edit/(:num)','Admin\Kategori::edit/$1');
    $routes->post('kategori/update/(:num)','Admin\Kategori::update/$1');
    $routes->get('kategori/delete/(:num)','Admin\Kategori::delete/$1');
});

// Admin Kondisi Barang 
$routes->get('/admin/kondisi','Admin\Kondisi::index');
$routes->get('/admin/kondisi/create','Admin\Kondisi::create');
$routes->post('/admin/kondisi/store','Admin\Kondisi::store');
$routes->get('/admin/kondisi/edit/(:num)','Admin\Kondisi::edit/$1');
$routes->post('/admin/kondisi/update/(:num)','Admin\Kondisi::update/$1');
$routes->get('/admin/kondisi/delete/(:num)','Admin\Kondisi::delete/$1');

// USER BARANG (Ajukan Barang) 
$routes->get('/user/barang','User\Barang::index',['filter'=>'user']);
$routes->get('/user/barang/create','User\Barang::create',['filter'=>'user']);
$routes->post('/user/barang/store','User\Barang::store',['filter'=>'user']);

// ADMIN BARANG 
$routes->group('admin', ['filter'=>'admin'], function($routes){

    // Barang yang sudah approved / manage data
    $routes->get('barang','Admin\Barang::index');
    $routes->get('barang/edit/(:num)','Admin\Barang::edit/$1'); 
    $routes->post('barang/update/(:num)','Admin\Barang::update/$1'); 
    $routes->get('barang/delete/(:num)','Admin\Barang::delete/$1'); 

    // Barang pengajuan pending
    $routes->get('pengajuanbarang','Admin\Barang::pengajuan'); 
    $routes->get('pengajuanbarang/approve/(:num)','Admin\Barang::approve/$1'); 
    $routes->get('pengajuanbarang/reject/(:num)','Admin\Barang::reject/$1'); 
});

// ADMIN LELANG
$routes->group('admin/lelang',['filter'=>'admin'],function($routes){

    // Jadwal
    $routes->get('jadwal','Admin\Lelang::jadwal');
    $routes->get('create','Admin\Lelang::create');
    $routes->post('store','Admin\Lelang::store');

    // Edit/Delete
    $routes->get('edit/(:num)','Admin\Lelang::edit/$1');
    $routes->post('update/(:num)','Admin\Lelang::update/$1');
    $routes->get('delete/(:num)','Admin\Lelang::delete/$1');

    // Status proses
    $routes->get('aktif','Admin\Lelang::aktif');
    $routes->get('stop/(:num)','Admin\Lelang::stop/$1');
    $routes->get('monitor/(:num)','Admin\Lelang::monitoring/$1');
});


// USER LELANG & BID
$routes->group('user', ['filter'=>'user'], function($routes){
    // Lelang
    $routes->get('lelang/aktif','User\Lelang::aktif');
    $routes->get('lelang/detail/(:num)','User\Lelang::detail/$1');
    // Bid
    $routes->post('bid/(:num)','User\Bid::submit/$1');
});


// USER PESERTA REGISTRATION
$routes->group('user', ['filter'=>'user'], function($routes){
    $routes->get('peserta','User\Peserta::index');
    $routes->get('peserta/daftar','User\Peserta::daftar');
    $routes->post('peserta/store','User\Peserta::store');
});

// ADMIN PESERTA MANAGEMENT
$routes->group('admin', ['filter'=>'admin'], function($routes){

    $routes->get('peserta','Admin\Peserta::index');
    $routes->get('peserta/approve/(:num)','Admin\Peserta::approve/$1');
    $routes->get('peserta/reject/(:num)','Admin\Peserta::reject/$1');
});

// ADMIN PEMENANG LELANG
$routes->group('admin',['filter'=>'admin'],function($routes){

    $routes->get('pemenang','Admin\Pemenang::index');
    $routes->get('pemenang/pilih/(:num)','Admin\Pemenang::pilih/$1');
});



