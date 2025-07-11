<?php
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::login');
$routes->get('logout', 'AuthController::logout');
$routes->get('auth/googleLogin', 'AuthController::googleLogin');
$routes->get('auth/googleCallback', 'AuthController::googleCallback');


$routes->get('produk', 'ProdukController::index', ['filter' => 'auth']);
$routes->get('keranjang', 'TransaksiController::index');

$routes->group('produk', ['filter' => 'auth'], function ($routes) {
    $routes->get('', 'ProdukController::index');
    $routes->post('', 'ProdukController::create');
    $routes->post('edit/(:any)', 'ProdukController::edit/$1');
    $routes->get('delete/(:any)', 'ProdukController::delete/$1');
    $routes->get('download', 'ProdukController::download');
});

$routes->group('keranjang', function ($routes) {
    $routes->get('', 'TransaksiController::index');
    $routes->post('', 'TransaksiController::cart_add');
    $routes->post('edit', 'TransaksiController::cart_edit');
    $routes->get('delete/(:any)', 'TransaksiController::cart_delete/$1');
    $routes->get('clear', 'TransaksiController::cart_clear');
});

$routes->get('checkout', 'TransaksiController::checkout', ['filter' => 'auth']);
$routes->post('buy', 'TransaksiController::buy', ['filter' => 'auth']);
$routes->get('pesanan', 'Home::pesanan', ['filter' => 'auth']);
$routes->get('get-location', 'TransaksiController::getLocation', ['filter' => 'auth']);
$routes->get('get-cost', 'TransaksiController::getCost', ['filter' => 'auth']);
$routes->resource('api', ['controller' => 'apiController']);
$routes->get('produk/search', 'ProdukController::search');

// // Profil user (dengan filter auth supaya hanya yang login bisa akses)
$routes->group('', ['filter' => 'auth'], function($routes) {
    $routes->get('profile', 'User::index');
    $routes->post('profile/update', 'User::update');
    $routes->post('profile/change-password', 'User::changePassword');
});


// TAMBAHAN ROUTE YANG BELUM ADA:
// Admin routes
$routes->get('admin/dashboard', 'Admin\DashboardController::index', ['filter' => 'auth']);
$routes->group('admin', function($routes) {
$routes->get('order', 'Admin\OrderController::index');
});

$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
    $routes->get('konsumen', 'KonsumenController::index');
    $routes->get('konsumen/create', 'KonsumenController::create');
    $routes->post('konsumen/store', 'KonsumenController::store');
    $routes->get('konsumen/edit/(:num)', 'KonsumenController::edit/$1');
    $routes->post('konsumen/update/(:num)', 'KonsumenController::update/$1');
    $routes->get('konsumen/delete/(:num)', 'KonsumenController::delete/$1');
});


// Laporan routes
// routes.php
$routes->get('admin/laporan/global', 'Admin\LaporanController::penjualanGlobal');
$routes->get('admin/laporan/penjualan', 'Admin\LaporanController::penjualanPeriodik');
$routes->get('admin/laporan/pendapatan', 'Admin\LaporanController::pendapatanPeriodik');

$routes->get('admin/laporan/pendapatan/pdf', 'Admin\LaporanController::exportPendapatanPDF');
$routes->get('admin/laporan/penjualan/global/pdf', 'Admin\LaporanController::exportPenjualanGlobalPDF');
$routes->get('admin/laporan/penjualan/periodik/pdf', 'Admin\LaporanController::exportPenjualanPeriodikPDF');



$routes->group('admin', function($routes) {
    $routes->get('konsumen', 'Admin\KonsumenController::index');
    $routes->post('konsumen/store', 'Admin\KonsumenController::store');
    $routes->get('konsumen/delete/(:num)', 'Admin\KonsumenController::delete/$1');
});

$routes->post('admin/order/diterima/(:num)', 'Admin\OrderController::diterima/$1');

$routes->post('admin/order/update_status/(:num)', 'Admin\OrderController::update_status/$1');
// Tambahkan route ini di bagian admin routes (sebelum route detail yang sudah ada)
$routes->get('admin/order/get_detail/(:num)', 'Admin\OrderController::getDetail/$1');

