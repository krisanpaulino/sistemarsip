<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('dashboard', 'Dashboard::index');
$routes->get('auth', 'Auth::index');
$routes->post('logout', 'Auth::logout');
$routes->post('dologin', 'Auth::login');
$routes->group('admin', function ($routes) {
    $routes->get('user/signup', 'User::signup');
    $routes->post('user/register', 'User::register');
    $routes->get('master/unit', 'Master::unit');
    $routes->get('user/signup', 'User::signup');
    $routes->post('master/saveunit', 'Master::saveunit');
    $routes->post('master/deleteunit', 'Master::deleteunit');
});
