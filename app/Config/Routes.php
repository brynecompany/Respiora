<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/kasus', 'Kasus::index');
$routes->get('/kasus/getBulan/(:num)', 'Kasus::getBulan/$1');