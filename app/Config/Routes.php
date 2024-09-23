<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Dashboard::index', ['filter' => 'login']);
$routes->get('dashboard', 'Dashboard::index', ['filter' => 'login']);
$routes->get('ganti-password', 'User::gantiPassword', ['filter' => 'login']);
$routes->post('ganti-password', 'User::updatePassword', ['filter' => 'login']);
$routes->get('auth', 'Auth::index');
$routes->post('logout', 'Auth::logout');
$routes->post('dologin', 'Auth::login');
$routes->group('admin', ['filter' => 'admin'], function ($routes) {
    $routes->get('user', 'User::index');
    $routes->get('user/signup', 'User::signup');
    $routes->post('user/register', 'User::register');
    $routes->post('user/delete', 'User::delete');
    $routes->get('user/signup', 'User::signup');

    $routes->get('master/unit', 'Master::unit');
    $routes->post('master/saveunit', 'Master::saveunit');
    $routes->post('master/deleteunit', 'Master::deleteunit');

    $routes->get('master/jenis', 'Master::jenis');
    $routes->post('master/savejenis', 'Master::savejenis');
    $routes->post('master/deletejenis', 'Master::deletejenis');

    $routes->get('arsip', 'Arsip::index');
    $routes->get('arsip/tambah', 'Arsip::tambah');
    $routes->post('arsip/save', 'Arsip::save');

    $routes->get('pinjam/request', 'Arsip::requestPinjam');
    $routes->get('pinjam/riwayat', 'Arsip::riwayatPinjam');
    $routes->post('pinjam/respon', 'Arsip::respondPinjam');

    $routes->get('laporan/harian', 'Laporan::harian');
    $routes->post('laporan/harian', 'Laporan::harian');
    $routes->get('laporan/tahunan', 'Laporan::tahunan');
    $routes->post('laporan/tahunan', 'Laporan::tahunan');
    $routes->get('laporan/bulanan', 'Laporan::bulanan');
    $routes->post('laporan/bulanan', 'Laporan::bulanan');
    $routes->post('laporan/cetakharian', 'Laporan::cetakharian');
    $routes->post('laporan/cetakbulanan', 'Laporan::cetakbulanan');
    $routes->post('laporan/cetaktahunan', 'Laporan::cetaktahunan');
});
$routes->group('operator', ['filter' => 'operator'], function ($routes) {
    $routes->get('arsip', 'Arsip::index');
    $routes->get('arsip/tambah', 'Arsip::tambah');
    $routes->post('arsip/save', 'Arsip::save');
    $routes->post('arsip/delete', 'Arsip::delete');
    $routes->post('arsip/download', 'Arsip::downloadPinjam');

    $routes->get('pinjam', 'Arsip::pinjamIndex');
    $routes->post('pinjam', 'Arsip::pinjam');
    $routes->get('pinjam/pinjam', 'Arsip::pinjamForm');

    $routes->get('laporan/harian', 'Laporan::harian');
    $routes->post('laporan/harian', 'Laporan::harian');
    $routes->get('laporan/tahunan', 'Laporan::tahunan');
    $routes->post('laporan/tahunan', 'Laporan::tahunan');
    $routes->get('laporan/bulanan', 'Laporan::bulanan');
    $routes->post('laporan/bulanan', 'Laporan::bulanan');
    $routes->post('laporan/cetakharian', 'Laporan::cetakharian');
    $routes->post('laporan/cetakbulanan', 'Laporan::cetakbulanan');
    $routes->post('laporan/cetaktahunan', 'Laporan::cetaktahunan');
});
