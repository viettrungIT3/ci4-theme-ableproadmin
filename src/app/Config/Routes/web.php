<?php

use CodeIgniter\Router\RouteCollection;

/**
 * Web Routes
 * @var RouteCollection $routes
 */

// Home route
$routes->get('/', 'Dashboard::index');

// Dashboard routes
$routes->group('dashboard', function ($routes) {
    $routes->get('/', 'Dashboard::index');
    $routes->get('/analytics', 'Dashboard::analytics');
    $routes->get('/finance', 'Dashboard::finance');
});

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

// Layout routes
$routes->get('/layouts/vertical', 'Layouts::vertical');
$routes->get('/layouts/horizontal', 'Layouts::horizontal');
$routes->get('/layouts/compact', 'Layouts::compact');
$routes->get('/layouts/tab', 'Layouts::tab');

// Settings routes
$routes->get('/settings/general', 'Settings::general');
$routes->get('/settings/theme', 'Settings::theme');
$routes->get('/settings/security', 'Settings::security');

// Help route
$routes->get('/help', 'Help::index');
