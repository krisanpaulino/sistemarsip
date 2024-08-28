<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Dashboard::index', ['filter' => 'login']);
$routes->get('dashboard', 'Dashboard::index', ['filter' => 'login']);
$routes->get('auth', 'Auth::index');
$routes->post('logout', 'Auth::logout');
$routes->post('dologin', 'Auth::login');
$routes->group('admin', ['filter' => 'admin'], function ($routes) {
    $routes->get('user/signup', 'User::signup');
    $routes->post('user/register', 'User::register');
    $routes->get('user/signup', 'User::signup');

    $routes->get('master/unit', 'Master::unit');
    $routes->post('master/saveunit', 'Master::saveunit');
    $routes->post('master/deleteunit', 'Master::deleteunit');

    $routes->get('master/jenis', 'Master::jenis');
    $routes->post('master/savejenis', 'Master::savejenis');
    $routes->post('master/deletejenis', 'Master::deletejenis');

    $routes->get('arsip', 'Arsip::index');
    $routes->get('arsip/tambah', 'Arsip::tambah');
});
