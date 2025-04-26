<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalender Ketersediaan - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
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
</head>

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

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <h2 class="mt-3">Kalender Ketersediaan</h2>
                <!-- Filter & Search -->
                <form method="get" class="mb-4 p-3 bg-white rounded shadow-sm border">
                    <div class="row g-2 align-items-end">
                        <!-- Search -->
                        <div class="col-md-3">
                            <label for="search" class="form-label fw-semibold">🔍 Cari Tanggal</label>
                            <input type="text" id="search" name="search" class="form-control" placeholder="tanggal">
                        </div>

                        <div class="col-md-3">
                            <label for="status" class="form-label fw-semibold">📂 Status</label>
                            <select name="status" id="status" class="form-select">
                                <option value="">-- Semua --</option>
                                <option value="tersedia" <?= (isset($_GET['status']) && $_GET['status'] == 'tersedia') ? 'selected' : '' ?>>Tersedia</option>
                                <option value="penuh" <?= (isset($_GET['status']) && $_GET['status'] == 'penuh') ? 'selected' : '' ?>>Penuh</option>
                            </select>
                        </div>

                        <!-- Filter Tanggal -->
                        <div class="col-md-3">
                            <label for="date_from" class="form-label fw-semibold">📅 Dari</label>
                            <input type="date" id="date_from" name="date_from" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="date_to" class="form-label fw-semibold">📅 Hingga</label>
                            <input type="date" id="date_to" name="date_to" class="form-control">
                        </div>

                        <!-- Tombol Filter & Reset -->
                        <div class="col-md-3 gap-3 mt-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-funnel"></i> Filter
                            </button>
                            <a href="/kalender-ketersediaan" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-clockwise"></i> Reset
                            </a>
                        </div>
                    </div>
                </form>

                <a href="/kalender-ketersediaan/create" class="btn btn-success mb-3 mt-3">
                    <i class="bi bi-calendar-plus"></i> Tambah Tanggal
                </a>

                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($ketersediaan as $k): ?>
                            <tr>
                                <td><?= $k['id']; ?></td>
                                <td><?= $k['tanggal']; ?></td>
                                <td>
                                    <?php if ($k['status'] === 'tersedia'): ?>
                                        <span class="btn btn-sm btn-success">Tersedia</span>
                                    <?php else: ?>
                                        <span class="btn btn-sm btn-danger">Penuh</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="/kalender-ketersediaan/edit/<?= $k['id']; ?>" class="btn btn-warning">Edit</a>
                                    <a href="/kalender-ketersediaan/delete/<?= $k['id']; ?>" class="btn btn-danger"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus tanggal ini?')">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>