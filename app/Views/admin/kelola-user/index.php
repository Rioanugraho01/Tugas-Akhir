<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<style>
    body {
        background: #f4f4f4;
    }

    .sidebar {
        background: #343a40;
        min-height: 100vh;
        padding-top: 20px;
        color: white;
    }

    .sidebar a {
        color: white;
        text-decoration: none;
        display: block;
        padding: 10px;
        transition: 0.3s;
    }

    .sidebar a:hover {
        background: #ffcc00;
        color: black;
        border-radius: 5px;
    }
</style>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar">
                <h4 class="text-center mb-4">Admin Ima Catering</h4>
                <a href="admin"><i class="bi bi-speedometer2"></i> Dashboard</a>
                <a href="kelola-user"><i class="bi bi-people"></i> Data Kelola User</a>
                <a href="kalender-ketersediaan" class="active"><i class="bi bi-calendar-check"></i> Kalender Ketersediaan</a>
                <a href="data-pemesanan"><i class="bi bi-cart"></i> Pemesanan</a>
                <a href="data-produk"><i class="bi bi-box"></i> Produk</a>
                <a href="macam-produk"><i class="bi bi-box"></i> Macam Produk</a>
                <a href="riwayat-pemesanan"><i class="bi bi-clock-history"></i> Riwayat Pemesanan</a>
                <a href="laporan-transaksi"><i class="bi bi-receipt"></i> Laporan Transaksi</a>
            </nav>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success mt-3"><?= session()->getFlashdata('success'); ?></div>
                <?php endif; ?>
                <h2 class="mt-3">Data Kelola User</h2>
                <!-- Filter & Search -->
                <form method="GET" action="<?= base_url('/kelola-user'); ?>" class="mb-4 p-3 bg-white rounded shadow-sm border">
                    <div class="row g-2 align-items-end">
                        <!-- Search -->
                        <div class="col-md-4">
                            <label for="search" class="form-label fw-semibold">🔍 Cari Pengguna</label>
                            <input type="text" id="search" name="search" class="form-control" placeholder="Nama, username, atau nomor..." value="<?= esc($search ?? '') ?>">
                        </div>

                        <!-- Filter Tanggal -->
                        <div class="col-md-4">
                            <label for="date_from" class="form-label fw-semibold">📅 Dari</label>
                            <input type="date" id="date_from" name="date_from" class="form-control" value="<?= esc($date_from ?? '') ?>">
                        </div>
                        <div class="col-md-4">
                            <label for="date_to" class="form-label fw-semibold">📅 Hingga</label>
                            <input type="date" id="date_to" name="date_to" class="form-control" value="<?= esc($date_to ?? '') ?>">
                        </div>

                        <!-- Tombol Filter & Reset -->
                        <div class="col-md-3 gap-3 mt-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-funnel"></i> Filter
                            </button>
                            <a href="<?= base_url('/kelola-user'); ?>" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-clockwise"></i> Reset
                            </a>
                        </div>
                    </div>
                </form>

                <!-- Tombol Tambah User -->
                <a href="<?= base_url('/kelola-user/create'); ?>" class="btn btn-success mt-3 mb-3">
                    <i class="bi bi-person-plus"></i> Tambah User
                </a>

                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Nomor Telepon</th>
                            <th>Tanggal Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($users)): ?>
                            <?php foreach ($users as $key => $user): ?>
                                <tr>
                                    <td><?= $key + 1; ?></td>
                                    <td><?= esc($user['name']); ?></td>
                                    <td><?= esc($user['username']); ?></td>
                                    <td><?= esc($user['phone']); ?></td>
                                    <td><?= esc($user['created_at']); ?></td>
                                    <td>
                                        <a href="<?= base_url('/kelola-user/edit/' . $user['id']); ?>" class="btn btn-warning">Edit</a>
                                        <form action="<?= base_url('/kelola-user/delete/' . $user['id']); ?>" method="POST" class="d-inline">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="_method" value="post">
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus user ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data pengguna.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </main>
        </div>
    </div>
</body>

</html>