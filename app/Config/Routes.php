<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');

$routes->group('admin', function($routes) {
    $routes->get('dashboard', 'Admin\Dashboard::index'); // ✅ tidak perlu diubah
});

$routes->get('/', function() {
    return redirect()->to('/admin/dashboard');
});

$routes->get('/', 'Admin\Dashboard::index');
$routes->get('kasus', 'Admin\Dashboard::index');