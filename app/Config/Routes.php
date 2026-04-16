<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//Artikel Admin//
$routes->get('admin/artikel', 'Admin\Artikel::index');
$routes->get('admin/artikel/tambah', 'Admin\Artikel::create');
$routes->post('admin/artikel/simpan', 'Admin\Artikel::store');

$routes->get('admin/artikel/edit/(:num)', 'Admin\Artikel::edit/$1');
$routes->post('admin/artikel/update/(:num)', 'Admin\Artikel::update/$1');
$routes->get('admin/artikel/delete/(:num)', 'Admin\Artikel::delete/$1');
$routes->get('admin/artikel/toggle/(:num)', 'Admin\Artikel::toggle/$1');

$routes->get('admin/artikel/(:num)', 'Admin\Artikel::show/$1'); // PALING BAWAH

//Berita Admin//
$routes->get('admin/berita', 'Admin\Berita::index');
$routes->get('admin/berita/tambah', 'Admin\Berita::create');
$routes->post('admin/berita/simpan', 'Admin\Berita::store');
$routes->get('admin/berita/(:num)', 'Admin\Berita::show/$1');
$routes->get('admin/berita/delete/(:num)', 'Admin\Berita::delete/$1');
$routes->get('admin/berita/edit/(:num)', 'Admin\Berita::edit/$1');
$routes->post('admin/berita/update/(:num)', 'Admin\Berita::update/$1');
$routes->get('admin/berita/toggle/(:num)', 'Admin\Berita::toggle/$1');