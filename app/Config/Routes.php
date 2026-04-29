<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/skrining', 'Dashboard::step1');
$routes->post('/skrining/step2', 'Dashboard::step2');
$routes->post('/dashboard/proses', 'Dashboard::proses');
$routes->get('/', 'Dashboard::step1');
$routes->get('/skrining_data', 'Dashboard::step1');
$routes->get('/getKodePos', 'Dashboard::getKodePos');
$routes->get('dashboard/cetak/(:num)', 'Dashboard::cetak/$1');