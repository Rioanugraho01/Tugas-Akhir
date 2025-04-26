<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// index atau halaman awa;
$routes->get('/index', 'TugasAkhir::index');
$routes->get('/', 'TugasAkhir::index');
// end

// admin
$routes->get('/admin', 'AdminController::admin');
$routes->get('/data-pemesanan', 'DataPemesananController::data_pemesanan');
$routes->get('/riwayat-pemesanan', 'RiwayatPemesananController::riwayat_pemesanan');
$routes->get('/laporan-transaksi', 'LaporanTransaksiController::laporan_transaksi');

$routes->group('kalender-ketersediaan', function($routes) {
    $routes->get('/', 'KalenderKetersediaanController::index');
    $routes->get('create', 'KalenderKetersediaanController::create');
    $routes->post('store', 'KalenderKetersediaanController::store');
    $routes->get('edit/(:num)', 'KalenderKetersediaanController::edit/$1');
    $routes->post('update/(:num)', 'KalenderKetersediaanController::update/$1');
    $routes->get('delete/(:num)', 'KalenderKetersediaanController::delete/$1');
});

$routes->get('kalender/kalender', 'KalenderController::kalender');

$routes->get('/data-produk', 'DataProdukController::data_produk');
$routes->get('/data-produk/create-produk', 'DataProdukController::create_produk');
$routes->post('/store-produk', 'DataProdukController::store_produk');
$routes->get('/data-produk/edit-produk/(:num)', 'DataProdukController::edit_produk/$1');
$routes->post('/update-produk/(:num)', 'DataProdukController::update_produk/$1');
$routes->get('/delete-produk/(:num)', 'DataProdukController::delete_produk/$1');


// admin - kelola-user
$routes->get('/kelola-user', 'KelolaUserController::kelola_user');
$routes->get('/kelola-user/create', 'KelolaUserController::create_user');
$routes->post('/kelola-user/store', 'KelolaUserController::store_user');
$routes->get('/kelola-user/edit/(:num)', 'KelolaUserController::edit_user/$1');
$routes->post('/kelola-user/update/(:num)', 'KelolaUserController::update_user/$1');
$routes->post('/kelola-user/delete/(:num)', 'KelolaUserController::delete_user/$1');
// end

$routes->get('/macam', 'MacamProdukController::macam_produk');
$routes->get('/macam/create', 'MacamProdukController::create_macam_produk');
$routes->post('/macam/store', 'MacamProdukController::store_macam_produk');
$routes->get('/macam/edit/(:num)', 'MacamProdukController::edit_macam_produk/$1');
$routes->post('/macam/update/(:num)', 'MacamProdukController::update_macam_produk/$1');
$routes->get('/macam/delete/(:num)', 'MacamProdukController::delete_macam_produk/$1');

// end - admin


// user

// user autentikasi-user
$routes->get('/register', 'AuthController::register');
$routes->post('/register', 'AuthController::store');
$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::attemptLogin');
$routes->get('/logout', 'AuthController::logout');
// end
$routes->get('/tentang-kami', 'TentangKamiController::tentang');
$routes->get('/produk-regular', 'ProdukRegularController::produk_regular');
$routes->get('/produk-khusus', 'ProdukKhususController::produk_khusus');
$routes->get('/kalender', 'KalenderController::kalender');
$routes->get('/riwayat', 'RiwayatController::riwayat');
$routes->get('/form-pemesanan', 'FormPemesananController::form_pemesanan');
$routes->get('/pemesanan', 'PemesananController::pemesanan');
$routes->get('macam-produk/(:num)', 'DetailProdukController::detail_produk/$1');
$routes->get('/edit-profile', 'ProfileController::edit');
$routes->post('/update-profile', 'ProfileController::update');


// end - user
