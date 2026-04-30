<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Artikel Admin (CRUD)
$routes->get('admin/artikel', 'Admin\Artikel::index');
$routes->get('admin/artikel/tambah', 'Admin\Artikel::create');
$routes->post('admin/artikel/simpan', 'Admin\Artikel::store');
$routes->get('admin/artikel/edit/(:num)', 'Admin\Artikel::edit/$1');
$routes->post('admin/artikel/update/(:num)', 'Admin\Artikel::update/$1');
$routes->get('admin/artikel/delete/(:num)', 'Admin\Artikel::delete/$1');
$routes->get('admin/artikel/(:num)', 'Admin\Artikel::show/$1');
$routes->post('admin/artikel/toggle/(:num)', 'Admin\Artikel::toggle/$1');

// ADMIN BERITA (CRUD)
$routes->get('admin/berita', 'Admin\Berita::index');  // Daftar berita Admin
$routes->get('admin/berita/tambah', 'Admin\Berita::create'); // Form tambah berita
$routes->post('admin/berita/simpan', 'Admin\Berita::store'); // Proses simpan berita
$routes->get('admin/berita/edit/(:num)', 'Admin\Berita::edit/$1'); // Edit berita
$routes->post('admin/berita/update/(:num)', 'Admin\Berita::update/$1'); // Proses update berita
$routes->get('admin/berita/delete/(:num)', 'Admin\Berita::delete/$1'); // Hapus berita
$routes->get('admin/berita/(:num)', 'Admin\Berita::show/$1');
$routes->post('admin/berita/toggle/(:num)', 'Admin\Berita::toggle/$1');

//Artikel Kapus//
$routes->get('kapus/artikel', 'Kapus\Artikel::index');
$routes->get('kapus/artikel/(:num)', 'Kapus\Artikel::show/$1');
$routes->get('kapus/artikel', 'Kapus\Artikel::index');

// Berita Kapus (View Only)
$routes->get('kapus/berita', 'Kapus\Berita::index');  // Daftar berita Kapus (hanya lihat)
$routes->get('kapus/berita/(:num)', 'Kapus\Berita::show/$1');  // Detail berita Kapus
$routes->get('kapus/berita', 'Kapus\Berita::index');

$routes->get('/', 'RoleSelectionController::index'); // Halaman awal
$routes->get('admin', 'AdminController::index');
$routes->get('kapus', 'KapusController::index');
$routes->get('roleselection', 'Auth::roleSelection');