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

