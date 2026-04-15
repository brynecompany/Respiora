<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/peta_view', 'Peta::index'); /**hal peta sebaran*/
$routes->get('/testdb', 'Peta::testdb'); /**TEST DB AJA*/