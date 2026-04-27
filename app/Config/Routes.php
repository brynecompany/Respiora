<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
/* $routes->get('/', 'Role::index');
$routes->get('login/(:segment)', 'Auth::login/$1');
$routes->get('myhome', 'Home::index'); */
$routes->get('/', 'Role::index');
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


// =====================
// FITUR
// =====================
$routes->get('/peta_view', 'Peta::index');
$routes->get('kasus', 'Kasus::index');
$routes->get('user', 'User::index');

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
