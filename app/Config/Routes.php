<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->setAutoRoute(false);

// ROUTE PUBLIK (boleh diakses tanpa login)
$routes->get('/', 'TugasAkhirController::index');
$routes->get('/index', 'TugasAkhirController::index');
$routes->get('/tentang-kami', 'TentangKamiController::tentang');
$routes->get('/produk-regular', 'ProdukRegularController::produk_regular');
$routes->get('/produk-khusus', 'ProdukKhususController::produk_khusus');
$routes->get('/kalender', 'KalenderController::kalender');
$routes->get('/macam-produk/(:num)', 'DetailProdukController::detail_produk/$1');
$routes->get('/riwayat', 'RiwayatController::riwayat');


$routes->get('tentang-kami', 'Home::tentangKami');

// Autentikasi Admin & User
$routes->get('/register', 'AuthController::register');
$routes->post('/register', 'AuthController::store');
$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::attemptLogin');
$routes->get('/logout', 'AuthController::logout');

$routes->group('', ['filter' => 'role:admin'], function ($routes) {

    // Dashboard Admin
    $routes->get('/admin', 'AdminController::admin');

    // Cron Notifikasi WA
    $routes->get('cron/kirim-wa-hminus1', 'CronController::kirimWAHMinus1');

    // Data pemesanan reguler
    $routes->get('/data-pemesanan', 'DataPemesananController::data_pemesanan');
    $routes->get('/data-pemesanan/konfirmasi/(:num)', 'DataPemesananController::konfirmasi/$1');
    $routes->get('/data-pemesanan/tolak/(:num)', 'DataPemesananController::tolak/$1');
    $routes->get('data-pemesanan/edit/(:num)', 'DataPemesananController::edit/$1');
    $routes->post('data-pemesanan/update/(:num)', 'DataPemesananController::update/$1');
    $routes->get('data-pemesanan/verifikasi-pembayaran/(:num)', 'DataPemesananController::verifikasiPembayaran/$1');
    $routes->post('data-pemesanan/update-progress/(:num)', 'DataPemesananController::update_progress/$1');
    $routes->get('data-pemesanan/detail/(:num)', 'DataPemesananController::detail/$1');

    // riwayat pemesanan
    $routes->get('/riwayat-pemesanan', 'RiwayatPemesananController::riwayat_pemesanan');

    // Laporan
    $routes->get('/laporan-transaksi', 'LaporanTransaksiController::laporan_transaksi');

    // Setting website
    $routes->get('/settings', 'WebsiteSettingsController::index');
    $routes->get('admin/settings/edit/(:num)', 'WebsiteSettingsController::edit/$1');
    $routes->post('admin/settings/update', 'WebsiteSettingsController::update');
    $routes->get('/settings/detail/(:num)', 'WebsiteSettingsController::detail/$1');

    // Kalender Ketersediaan
    $routes->group('kalender-ketersediaan', function ($routes) {
        $routes->get('/', 'KalenderKetersediaanController::index');
        $routes->get('create', 'KalenderKetersediaanController::create');
        $routes->post('store', 'KalenderKetersediaanController::store');
        $routes->get('edit/(:num)', 'KalenderKetersediaanController::edit/$1');
        $routes->post('update/(:num)', 'KalenderKetersediaanController::update/$1');
        $routes->get('delete/(:num)', 'KalenderKetersediaanController::delete/$1');
    });

    // Data Produk
    $routes->get('/data-produk', 'DataProdukController::data_produk');
    $routes->get('/data-produk/create-produk', 'DataProdukController::create_produk');
    $routes->post('/store-produk', 'DataProdukController::store_produk');
    $routes->get('/data-produk/edit-produk/(:num)', 'DataProdukController::edit_produk/$1');
    $routes->post('/update-produk/(:num)', 'DataProdukController::update_produk/$1');
    $routes->get('/delete-produk/(:num)', 'DataProdukController::delete_produk/$1');

    //  Macam Produk
    $routes->get('/macam', 'MacamProdukController::macam_produk');
    $routes->get('/macam/create', 'MacamProdukController::create_macam_produk');
    $routes->post('/macam/store', 'MacamProdukController::store_macam_produk');
    $routes->get('/macam/edit/(:num)', 'MacamProdukController::edit_macam_produk/$1');
    $routes->post('/macam/update/(:num)', 'MacamProdukController::update_macam_produk/$1');
    $routes->get('/macam/delete/(:num)', 'MacamProdukController::delete_macam_produk/$1');

    // Kelola User
    $routes->get('/kelola-user', 'KelolaUserController::kelola_user');
    $routes->get('/kelola-user/create', 'KelolaUserController::create_user');
    $routes->post('/kelola-user/store', 'KelolaUserController::store_user');
    $routes->get('/kelola-user/edit/(:num)', 'KelolaUserController::edit_user/$1');
    $routes->post('/kelola-user/update/(:num)', 'KelolaUserController::update_user/$1');
    $routes->post('/kelola-user/delete/(:num)', 'KelolaUserController::delete_user/$1');

    // Data Pesanan Khusus
    $routes->get('data-pemesanan-khusus', 'PesananKhususController::index');
    $routes->get('data-pemesanan-khusus/create', 'PesananKhususController::create');
    $routes->post('data-pemesanan-khusus/store', 'PesananKhususController::store');
    $routes->get('data-pemesanan-khusus/edit/(:num)', 'PesananKhususController::edit/$1');
    $routes->post('data-pemesanan-khusus/update/(:num)', 'PesananKhususController::update/$1');
    $routes->get('data-pemesanan-khusus/delete/(:num)', 'PesananKhususController::delete/$1');

    // Data Pemesanan Khusus
    $routes->get('/pemesanan-khusus', 'PemesananKhususController::index');
    $routes->get('admin/setujui/(:num)', 'PemesananKhususController::setujui/$1');

    // Admin Edit Profil
    $routes->get('/admin/edit-profile', 'AuthController::editProfileAdmin');
    $routes->post('/admin/update-profile', 'AuthController::updateProfileAdmin');
});


$routes->group('', ['filter' => 'role:user'], function ($routes) {

    // Kalender
    $routes->get('kalender/kalender', 'KalenderController::kalender');

    // Profile
    $routes->get('/edit-profile', 'ProfileController::edit');
    $routes->post('/update-profile', 'ProfileController::update');

    // Cart Macam Produk
    $routes->post('cart/add', 'CartController::add');
    $routes->get('cart/remove/(:num)', 'CartController::remove/$1');
    $routes->get('cart/get', 'CartController::getCart');

    // Pemesanan
    $routes->get('/pemesanan', 'PemesananController::pemesanan');
    $routes->get('pemesanan/produk/(:num)', 'PemesananController::form/$1');
    $routes->get('pemesanan/(:num)', 'PemesananController::index/$1');
    $routes->post('/pemesanan/konfirmasi', 'PemesananController::konfirmasi');
    $routes->get('/pemesanan/pembayaran/(:num)', 'PemesananController::pembayaran/$1');
    $routes->post('pemesanan/uploadBukti/(:num)', 'PemesananController::uploadBukti/$1');
    $routes->post('pemesanan/selesai/(:num)', 'PemesananController::selesai/$1');

    // Form Pemesanan
    $routes->get('/form-pemesanan', 'FormPemesananController::index');
    $routes->post('/form-pemesanan/simpan', 'FormPemesananController::simpan');
    $routes->get('/form-pemesanan/konfirmasi/(:num)', 'FormPemesananController::konfirmasi/$1');

});
