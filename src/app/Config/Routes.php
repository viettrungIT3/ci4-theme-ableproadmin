<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Web routes
require APPPATH . 'Config/Routes/web.php';

// API routes
$routes->group('api', function ($routes) {
    require APPPATH . 'Config/Routes/api.php';
});
