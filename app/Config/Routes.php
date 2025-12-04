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

