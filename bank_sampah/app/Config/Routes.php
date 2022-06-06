<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index', ['filter' => 'role:admin']);
$routes->get('/barang', 'barang::index', ['filter' => 'role:admin']);
$routes->get('/kategori', 'kategori::index', ['filter' => 'role:admin']);
$routes->get('/tranksaksi', 'tranksaksi::index', ['filter' => 'role:admin']);
$routes->get('/admin', 'admin::index', ['filter' => 'role:admin']);
$routes->get('/nasabah', 'nasabah::index', ['filter' => 'role:admin']);

$routes->delete('/kategori/(:num)', 'kategori::delete/$1');
$routes->delete('/barang/(:num)', 'barang::delete/$1');
$routes->delete('/tranksaksi/(:num)', 'tranksaksi::delete/$1');
$routes->delete('/admin/(:num)', 'admin::delete/$1');
$routes->delete('/nasabah/(:num)', 'nasabah::delete/$1');

// $routes->get('barang', 'barang::index', ['filter' => 'role:admin']);
$routes->group('barang', ['filter' => 'role:admin'], function ($routes) {
    $routes->add('index', 'barang::index');
    $routes->add('create', 'barang::create');
    $routes->add('edit/(:any)', 'barang::edit/$1');
});

$routes->group('kategori', ['filter' => 'role:admin'], function ($routes) {
    $routes->add('index', 'kategori::index');
    $routes->add('create', 'kategori::create');
    $routes->add('edit/(:any)', 'kategori::edit/$1');
});

$routes->group('admin', ['filter' => 'role:admin'], function ($routes) {
    $routes->add('index', 'admin::index');
    $routes->add('create', 'admin::create');
    $routes->add('edit/(:num)', 'admin::edit/$1');
    $routes->add('reset/(:num)', 'admin::reset/$1');
});

$routes->group('nasabah', ['filter' => 'role:admin'], function ($routes) {
    $routes->add('index', 'nasabah::index');
    $routes->add('create', 'nasabah::create');
    $routes->add('hist', 'nasabah::hist');
});

$routes->group('tranksaksi', ['filter' => 'role:admin'], function ($routes) {
    $routes->add('index', 'tranksaksi::index');
    $routes->add('create', 'tranksaksi::create');
    $routes->add('detailmasuk/(:num)', 'tranksaksi::detailmasuk/$1');
    $routes->add('detailkeluar/(:num)', 'tranksaksi::detailkeluar/$1');
    $routes->add('hist', 'tranksaksi::hist');
    $routes->add('keluar', 'tranksaksi::keluar');
    $routes->add('keluars', 'tranksaksi::keluars');
});


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
