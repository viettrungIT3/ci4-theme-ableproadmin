<?php

use CodeIgniter\Router\RouteCollection;

/*
 * Web Routes
 * @var RouteCollection $routes
 */

// Home route
$routes->get('/', 'Home::index');

// Test routes
$routes->get('/test-theme', 'Web\Admin\Test::theme');
$routes->get('/test-toast', 'Web\Admin\Test::toast');
$routes->get('/test-toast-simple', 'Web\Admin\Test::toastSimple');

// Dashboard routes
$routes->group('dashboard', function ($routes) {
    $routes->get('/', 'Web\Admin\Dashboard::index');
    $routes->get('/analytics', 'Web\Admin\Dashboard::analytics');
    $routes->get('/finance', 'Web\Admin\Dashboard::finance');

    // Demo theme
    $routes->get('/demo-theme', 'Web\Admin\DashboardDemo::index');

    // User management routes (view only - actions handled via API)
    $routes->group('users', function ($routes) {
        $routes->get('/', 'Web\Admin\Users::index');
        $routes->get('create', 'Web\Admin\Users::create');
        $routes->get('show/(:num)', 'Web\Admin\Users::show/$1');
        $routes->get('edit/(:num)', 'Web\Admin\Users::edit/$1');
        $routes->get('search', 'Web\Admin\Users::search');
    });
});

// Auth routes
$routes->group('auth', function ($routes) {
    $routes->get('login', 'Web\Auth\Login::index');
    $routes->post('login', 'Web\Auth\Login::process');
    $routes->get('register', 'Web\Auth\Register::index');
    $routes->post('register', 'Web\Auth\Register::process');
    $routes->get('logout', 'Web\Auth\Login::logout');
});

// Demo routes
$routes->get('/form-demo', 'Web\Admin\FormDemo::index');
$routes->get('/advanced-ui-demo', 'Web\Admin\AdvancedUiDemo::index');
$routes->get('/sample-page', 'Web\Admin\SamplePage::index');