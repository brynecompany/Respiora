<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/skrining', 'Skrining::step1');
$routes->post('/skrining/step2', 'Skrining::step2');
$routes->post('/Skrining/proses', 'Skrining::proses');
$routes->get('/', 'Skrining::step1');
$routes->get('/skrining_data', 'Skrining::step1');
$routes->get('/getKodePos', 'Skrining::getKodePos');
$routes->get('Skrining/cetak/(:num)', 'Skrining::cetak/$1');