<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// API routes
$routes->get('health', 'Api\Health::index');

// User management API
$routes->group('users', function ($routes) {
    $routes->get('/', 'Api\Users::index');
    $routes->get('active', 'Api\Users::active');
    $routes->get('(:num)', 'Api\Users::show/$1');
    $routes->post('/', 'Api\Users::create');
    $routes->put('(:num)', 'Api\Users::update/$1');
    $routes->delete('(:num)', 'Api\Users::delete/$1');
});

// Example API endpoints
$routes->group('api', function ($routes) {
    $routes->get('status', function () {
        return $this->response->setJSON([
            'status' => 'ok',
            'timestamp' => date('Y-m-d H:i:s'),
            'version' => '1.0.0'
        ]);
    });
});