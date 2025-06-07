<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Ima Catering</title>
    <link rel="icon" href="<?= base_url('img/' . ($setting['logo_navbar'] ?? 'favicon.ico')) ?>" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background: #f4f4f4;
        }

        .sidebar {
            background-color: #333;
            min-height: 100vh;
            padding-top: 20px;
            color: white;
            transition: all 0.3s ease-in-out;
        }

        .sidebar .list-group-item {
            border: none;
            border-radius: 0;
            padding: 12px 20px;
            font-size: 0.95rem;
            transition: background-color 0.2s, padding-left 0.2s;
        }

        .sidebar .list-group-item:hover {
            background-color: #ffcc00;
            border-radius: 5px;
            padding-left: 25px;
        }

        .sidebar .dropdown-toggle::after {
            margin-left: auto;
        }

        .sidebar a.active {
            background-color: #ffcc00;
            border-radius: 5px;
        }

        #dropdownUser:focus {
            outline: none !important;
            box-shadow: none !important;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar">
                <div class="px-3 mb-4 mt-3">
                    <a href="<?= base_url('admin') ?>" class="d-flex align-items-center mb-3 text-white text-decoration-none brand-text">
                        <i class="bi bi-house-fill me-2 fs-4"></i>
                        <span class="fs-5 fw-bold">Admin Ima Catering</span>
                    </a>
                </div>
                <hr class="text-white mx-3" />
                <div class="list-group-flush">
                    <a href="<?= base_url('admin') ?>" class="list-group-item list-group-item-action text-white <?= active('admin') ?>">
                        <i class="bi bi-speedometer2 me-2"></i> Dashboard
                    </a>
                    <a href="<?= base_url('kelola-user') ?>" class="list-group-item list-group-item-action text-white <?= active('kelola-user') ?>">
                        <i class="bi bi-people me-2"></i> Kelola User
                    </a>
                    <a href="<?= base_url('kalender-ketersediaan') ?>" class="list-group-item list-group-item-action text-white <?= active('kalender-ketersediaan') ?>">
                        <i class="bi bi-calendar-check me-2"></i> Kalender
                    </a>
                    <a href="<?= base_url('data-pemesanan') ?>" class="list-group-item list-group-item-action text-white <?= active('data-pemesanan') ?>">
                        <i class="bi bi-cart me-2"></i> Pemesanan Reguler
                    </a>
                    <a href="<?= base_url('data-pemesanan-khusus') ?>" class="list-group-item list-group-item-action text-white <?= active('data-pemesanan-khusus') ?>">
                        <i class="bi bi-table me-2"></i> Data Pemesanan Khusus
                    </a>
                    <a href="<?= base_url('pemesanan-khusus') ?>" class="list-group-item list-group-item-action text-white <?= active('pemesanan-khusus') ?>">
                        <i class="bi bi-journal-plus me-2"></i> Pemesanan Khusus
                    </a>
                    <a href="<?= base_url('riwayat-pemesanan') ?>" class="list-group-item list-group-item-action text-white <?= active('riwayat-pemesanan') ?>">
                        <i class="bi bi-clock-history me-2"></i> Riwayat Pemesanan
                    </a>
                    <a href="<?= base_url('data-produk') ?>" class="list-group-item list-group-item-action text-white <?= active('data-produk') ?>">
                        <i class="bi bi-box me-2"></i> Produk
                    </a>
                    <a href="<?= base_url('macam') ?>" class="list-group-item list-group-item-action text-white <?= active('macam') ?>">
                        <i class="bi bi-tag me-2"></i> Macam Produk
                    </a>
                    <a href="<?= base_url('laporan-transaksi') ?>" class="list-group-item list-group-item-action text-white <?= active('laporan-transaksi') ?>">
                        <i class="bi bi-receipt me-2"></i> Laporan Transaksi
                    </a>
                    <a href="<?= base_url('settings') ?>" class="list-group-item list-group-item-action text-white <?= active('settings') ?>">
                        <i class="bi bi-gear me-2"></i> Pengaturan Website
                    </a>
                </div>
                <hr class="text-white mx-3" />
                <div class="list-group-item dropdown px-3">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle me-2 fs-5"></i> <strong><?= session('username') ?></strong>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark mt-2" aria-labelledby="dropdownUser">
                        <li><a class="dropdown-item" href="<?= base_url('/admin/edit-profile') ?>"><i class="bi bi-pencil-square me-2"></i>Edit Profil</a></li>
                        <li><a class="dropdown-item text-danger" href="<?= base_url('/logout') ?>" onclick="return confirm('Yakin ingin logout?')"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 col-lg-10 px-md-4 pt-4">
                <?= $this->renderSection('content') ?>
            </main>

        </div>
    </div>
</body>

</html>