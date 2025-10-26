<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// API routes
$routes->get('health', 'Api\Health::index');

// API v1 routes
$routes->group('v1', function ($routes) {
    // User
    $routes->group('users', function ($routes) {
        $routes->get('/', 'Api\V1\Users::index');
        $routes->get('active', 'Api\V1\Users::active');
        $routes->get('(:num)', 'Api\V1\Users::show/$1');
        $routes->post('/', 'Api\V1\Users::create');
        $routes->put('(:num)', 'Api\V1\Users::update/$1');
        $routes->delete('(:num)', 'Api\V1\Users::delete/$1');
        $routes->get('check-username', 'Api\V1\Users::checkUsername');
    });
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