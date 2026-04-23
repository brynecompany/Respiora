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
$routes->get('sidebar_layl', 'Home::sidebarLayl');
$routes->get('profil', 'Home::sidebarLayl/profil');
$routes->get('logout', 'Auth::logout');
// Forgot password
$routes->get('forgot-password/(:segment)', 'Auth::forgotPassword/$1');
$routes->post('forgot-password/send', 'Auth::sendResetLink');
// Reset password
$routes->get('reset-password/(:segment)', 'Auth::resetPassword/$1');
$routes->post('reset-password/update', 'Auth::updatePassword');

// $routes->get('sidebar_layl', 'Home::sidebarLayl');
// $routes->get('profil', 'Home::sidebarLayl/profil');