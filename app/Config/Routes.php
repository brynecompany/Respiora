<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

/* $routes->get('/', 'Role::index');
$routes->get('login/(:segment)', 'Auth::login/$1');
$routes->get('myhome', 'Home::index'); */
$routes->get('/role', 'Role::index');
$routes->get('login/(:segment)', 'Auth::login/$1');
$routes->post('auth/proses-login', 'Auth::prosesLogin');
/*$routes->get('dashboard', 'Home::index');*/
/*$routes->get('sidebar_layl', 'Home::sidebarLayl');
$routes->get('profil', 'Home::sidebarLayl/profil');*/
$routes->get('logout', 'Auth::logout');
// Forgot password
$routes->get('forgot-password/(:segment)', 'Auth::forgotPassword/$1');
$routes->post('forgot-password/send', 'Auth::sendResetLink');
// Reset password
$routes->get('reset-password/(:segment)', 'Auth::resetPassword/$1');
$routes->post('reset-password/update', 'Auth::updatePassword');

// $routes->get('sidebar_layl', 'Home::sidebarLayl');
// $routes->get('profil', 'Home::sidebarLayl/profil');

/*$routes->get('/', 'Home::index');*/
/*$routes->get('/peta_view', 'Peta::index'); */ /**hal peta sebaran*/ 

// =====================
// DASHBOARD (SETELAH LOGIN)
// =====================
$routes->get('dashboard', 'Dashboard::index');
$routes->get('dashboard/getByYear/(:num)', 'Dashboard::getByYear/$1');


// =====================
// FITUR
// =====================
$routes->get('/peta_view', 'Peta::index');
// $routes->get('kasus', 'Kasus::index');
$routes->get('user', 'User::index');
$routes->get('user/create', 'User::create'); // untuk tampilkan form input user
$routes->post('user/store', 'User::store');  // untuk simpan data user
$routes->get('user/edit/(:num)', 'User::edit/$1');
$routes->post('user/update/(:num)', 'User::update/$1');
$routes->get('user/view/(:num)', 'User::view/$1');
$routes->post('user/delete/(:num)', 'User::delete/$1');


// =====================
// GRAFIK
// =====================

// $routes->get('/', 'Home::index');


// =====================
// KASUS (DASHBOARD)
// =====================
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// GRAFIK KASUS
// $routes->get('/', 'Home::index');
//$routes->get('grafik/kasus', 'Grafik\Kasus::index');
//$routes->get('kasus/getBulan/(:num)', 'Grafik\Kasus::getBulan/$1');  
$routes->get('grafik/kasus', 'Kasus::index');
$routes->get('kasus/getBulan/(:num)', 'Kasus::getBulan/$1');


// =====================
// MANAJEMEN DATA
// =====================
$routes->get('pasien', 'Pasien::index');
$routes->post('profil/update-pass', 'Profil::updatePassword');


// =====================
// INFORMASI
// =====================
$routes->get('artikel', 'Artikel::index');
$routes->get('berita', 'Berita::index');
$routes->get('profil', 'Profil::index');


// =====================
// OPTIONAL (kalau masih mau akses lama)
// =====================
/*$routes->get('sidebar_layl', 'Home::sidebarLayl');*/

//$routes->get('/', 'Home::index');

$routes->get('admin/data-pasien', 'Admin\Pasien::index');
$routes->get('admin/data-pasien/(:num)', 'Admin\Pasien::detailDiri/$1');
$routes->get('admin/data-pasien/(:num)/wilayah', 'Admin\Pasien::detailWilayah/$1');
$routes->get('admin/data-pasien/edit/(:num)', 'Admin\Pasien::editDiri/$1');
$routes->post('admin/data-pasien/edit/(:num)/wilayah', 'Admin\Pasien::editWilayah/$1');
$routes->get('admin/data-pasien/edit/(:num)/wilayah', 'Admin\Pasien::editWilayah/$1');
$routes->post('admin/data-pasien/update/(:num)', 'Admin\Pasien::update/$1');
$routes->get('api/wilayah/provinsi', 'Admin\Wilayah::provinsi');
$routes->get('api/wilayah/kabupaten/(:any)', 'Admin\Wilayah::kabupaten/$1');
$routes->get('api/wilayah/kecamatan/(:any)', 'Admin\Wilayah::kecamatan/$1');
$routes->get('api/wilayah/kelurahan/(:any)', 'Admin\Wilayah::kelurahan/$1');
$routes->post('admin/data-pasien/update-wilayah/(:num)', 'Admin\Pasien::updateWilayah/$1');
$routes->post('/admin/data-pasien/delete/(:num)', 'Admin\Pasien::delete/$1');
$routes->get('/admin/data-pasien/create', 'Admin\Pasien::createDiri');
$routes->post('/admin/data-pasien/store-temp', 'Admin\Pasien::storeDiriTemp');
$routes->get('/admin/data-pasien/create/wilayah', 'Admin\Pasien::createWilayah');
$routes->post('admin/data-pasien/store-final', 'Admin\Pasien::storeFinal');
$routes->post('/admin/data-pasien/update/(:num)/wilayah', 'Admin\Pasien::updateWilayah/$1');

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

$routes->get('/skrining', 'Skrining::step1');
$routes->post('/skrining/step2', 'Skrining::step2');
$routes->post('/Skrining/proses', 'Skrining::proses');
$routes->get('/', 'Skrining::step1');
$routes->get('/skrining_data', 'Skrining::step1');
$routes->get('/getKodePos', 'Skrining::getKodePos');
$routes->get('Skrining/cetak/(:num)', 'Skrining::cetak/$1');

