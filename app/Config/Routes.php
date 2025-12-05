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
$routes->group('admin', ['filter'=>'admin'], function($routes){
    $routes->get('kategori', 'Admin\Kategori::index');
    $routes->get('kategori/create', 'Admin\Kategori::create');
    $routes->post('kategori/store', 'Admin\Kategori::store');
    $routes->get('kategori/edit/(:num)', 'Admin\Kategori::edit/$1');
    $routes->post('kategori/update/(:num)', 'Admin\Kategori::update/$1');
    $routes->get('kategori/delete/(:num)', 'Admin\Kategori::delete/$1');
});

