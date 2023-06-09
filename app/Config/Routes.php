<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

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
$routes->get('/', 'Home::index');


$routes->get('/login', 'C_Auth::index', ['filter' => 'unauthorized']);
$routes->post('/login', 'C_Auth::login', ['filter' => 'unauthorized']);

$routes->group(
    'kemeja',
    ['filter' => 'auth'],
    function ($routes) {
        $routes->get('/', 'C_Kemeja::index');
        $routes->get('create', 'C_Kemeja::create');
        $routes->post('store', 'C_Kemeja::store');
        $routes->get('show/(:num)', 'C_Kemeja::show/$1');
        $routes->get('edit/(:num)', 'C_Kemeja::edit/$1');
        $routes->post('update/(:num)', 'C_Kemeja::update/$1');
        $routes->get('delete/(:num)', 'C_Kemeja::destroy/$1');

        // cart
        $routes->get('cart', 'C_Cart::index');

        // $routes->get('cart/add/(:num)', 'C_Cart::add/$1');
        $routes->get('cart/add/(:num)', 'C_Cart::add/$1');
        $routes->get('cart/reduce/(:num)', 'C_Cart::reduce/$1');
        $routes->get('cart/destroy', 'C_Cart::destroy');
        $routes->get('cart/checkout', 'C_Cart::checkoutForm');
        $routes->post('cart/checkout', 'C_Cart::checkout');

        // get ongkir
        $routes->post('cart/getOngkir', 'C_Cart::getOngkir');

        // checkout
        $routes->get('transaksi', 'C_Transaksipjl::index');

        // penjualan
        $routes->get('penjualan', 'C_Detailjual::index');

        // logout
        $routes->get('logout', 'C_Auth::logout');
    }
);


// $routes->group(
//     'barang',
//     ['filter' => 'auth'],
//     function ($routes) {
//         $routes->get('/', 'C_Barang::index');
//         $routes->get('create', 'C_Barang::create');
//         $routes->post('store', 'C_Barang::store');
//         $routes->get('show/(:num)', 'C_Barang::show/$1');
//         $routes->get('edit/(:num)', 'C_Barang::edit/$1');
//         $routes->post('update/(:num)', 'C_Barang::update/$1');
//         $routes->get('delete/(:num)', 'C_Barang::destroy/$1');
//
//
//
//         // cart
//         $routes->get('cart', 'C_Cart::index');
//         $routes->get('cart/add/(:num)', 'C_Cart::add/$1');
//         $routes->get('cart/reduce/(:num)', 'C_Cart::reduce/$1');
//         $routes->get('cart/destroy', 'C_Cart::destroy');
//         $routes->get('cart/checkout', 'C_Cart::checkoutForm');
//         $routes->post('cart/checkout', 'C_Cart::checkout');
//
//         // checkout
//         $routes->get('transaksi', 'C_Transaksi::index');
//
//         // penjualan
//         $routes->get('penjualan', 'C_Penjualan::index');
//
//         // logout
//         $routes->get('logout', 'C_Auth::logout');
//     }
// );
//
// $routes->get('/api/barang', 'C_Api::getBarang');
// $routes->get('/api/barang/add/(:num)/(:num)', 'C_Api::addStock/$1/$2');
// $routes->get('/api/barang/reduce/(:num)', 'C_Api::reduceStock/$1');

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
    include APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
