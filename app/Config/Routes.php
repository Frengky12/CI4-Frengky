<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Admin\DashboardController::index');

// router Dashboard
$routes->get('dashboard', 'Admin\DashboardController::index');


// routes Data produk
$routes->get('data-produk', 'Admin\ProdukController::index');
$routes->get('data-produk/tambah', 'Admin\ProdukController::form_tambah');
$routes->post('data-produk/tambah-produk', 'Admin\ProdukController::tambah_produk');
$routes->delete('data-produk/delete-produk(:num)','Admin\ProdukController::delete_produk/$1');
$routes->get('data-produk/detail-produk/(:num)','Admin\ProdukController::detail_produk/$1');
$routes->put('data-produk/update-produk/(:num)','Admin\ProdukController::update_produk/$1');

// routes download laporan 
$routes->get('data-produk/export', 'Admin\ProdukController::export');

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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
