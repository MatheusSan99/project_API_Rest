<?php

namespace Config;

// Create a new instance of our RouteCollection class.
use App\Controllers\OrdersController;

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
$routes->get('/products', 'ProductsController::productsList');
$routes->post('/clients/create', 'ClientsController::create');
$routes->post('/login', 'Auth::login');
$routes->post('/new/', 'ClientsController::newOrder');
$routes->post('products/create', 'ProductsController::create');

//Clients Natural Crud
$routes->group('api', function ($routes) {
    $routes->get('products/edit/(:num)', 'ProductsController::editProduct/$1');
    $routes->put('products/update/(:num)', 'ProductsController::updateProduct/$1');
    $routes->delete('products/delete/(:num)','ProductsController::delete/$1');

    //Clients Natural Crud
    $routes->get('clients', 'ClientsController::clientsList');
    $routes->get('clients/edit/(:num)', 'ClientsController::editClient/$1');
    $routes->put('clients/update/(:num)', 'ClientsController::updateClient/$1');
    $routes->delete('clients/delete/(:num)', 'ClientsController::delete/$1');

});
    $routes->get('orders','OrdersController::ordersList');
    $routes->post('orders/create','OrdersController::create');
    $routes->get('orders/clients/(:num)','OrdersController::clientOrdersList/$1');



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
