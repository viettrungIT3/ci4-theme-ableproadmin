<?php

use CodeIgniter\Router\RouteCollection;

/**
 * Web Routes
 * @var RouteCollection $routes
 */

// Home route
$routes->get('/', 'Home::index');

// User management routes
$routes->group('users', function ($routes) {
    $routes->get('/', 'Users::index');
    $routes->get('create', 'Users::create');
    $routes->post('store', 'Users::store');
    $routes->get('show/(:num)', 'Users::show/$1');
    $routes->get('edit/(:num)', 'Users::edit/$1');
    $routes->post('update/(:num)', 'Users::update/$1');
    $routes->get('delete/(:num)', 'Users::delete/$1');
    $routes->get('search', 'Users::search');
    $routes->get('toggle-status/(:num)', 'Users::toggleStatus/$1');
});

// Admin dashboard routes
$routes->group('dashboard', function ($routes) {
    $routes->get('/', 'Dashboard::index');
});
