<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Produk</title>
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
                <a href="kalender-ketersediaan"><i class="bi bi-calendar-check"></i> Kalender Ketersediaan</a>
                <a href="data-pemesanan"><i class="bi bi-cart"></i> Pemesanan</a>
                <a href="data-produk"><i class="bi bi-box"></i> Produk</a>
                <a href="macam"><i class="bi bi-box"></i> Macam Produk</a>
                <a href="riwayat-pemesanan"><i class="bi bi-clock-history"></i> Riwayat Pemesanan</a>
                <a href="laporan-transaksi"><i class="bi bi-receipt"></i> Laporan Transaksi</a>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content mt-3">
                <h2 class="mb-3">Data Produk</h2>

                <!-- Alert Notifikasi -->
                <?php if (session()->getFlashdata('success')) : ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <!-- Filter & Search -->
                <form method="GET" class="mb-4 p-3 bg-white rounded shadow-sm border">
                    <div class="row g-2 align-items-end">
                        <!-- Search -->
                        <div class="col-md-3">
                            <label for="search" class="form-label fw-semibold">🔍 Cari Produk</label>
                            <input type="text" id="search" name="search" class="form-control" placeholder="Masukkan kata kunci..." value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>">
                        </div>

                        <!-- Filter Kategori -->
                        <div class="col-md-3">
                            <label for="kategori" class="form-label fw-semibold">📂 Kategori</label>
                            <select id="kategori" name="kategori" class="form-select">
                                <option value="">Semua Kategori</option>
                                <option value="regular" <?= isset($_GET['kategori']) && $_GET['kategori'] == 'regular' ? 'selected' : '' ?>>Regular</option>
                                <option value="khusus" <?= isset($_GET['kategori']) && $_GET['kategori'] == 'khusus' ? 'selected' : '' ?>>Khusus</option>
                            </select>
                        </div>

                        <!-- Filter Tanggal -->
                        <div class="col-md-3">
                            <label for="date_from" class="form-label fw-semibold">📅 Tanggal Mulai</label>
                            <input type="date" id="date_from" name="date_from" class="form-control" value="<?= isset($_GET['date_from']) ? $_GET['date_from'] : '' ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="date_to" class="form-label fw-semibold">📅 Tanggal Sampai</label>
                            <input type="date" id="date_to" name="date_to" class="form-control" value="<?= isset($_GET['date_to']) ? $_GET['date_to'] : '' ?>">
                        </div>

                        <!-- Tombol Filter & Reset -->
                        <div class="col-md-2 gap-3 mt-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-funnel"></i> Filter
                            </button>
                            <a href="<?= base_url('data-produk') ?>" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-clockwise"></i> Reset
                            </a>
                        </div>
                    </div>
                </form>

                <!-- Tombol Tambah Data -->
                <a href="<?= base_url('/data-produk/create-produk') ?>" class="btn btn-success mt-3">
                    <i class="bi bi-box-seam"></i> Tambah Produk
                </a>

                <table class="table table-bordered mt-3">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($produk)) : ?>
                            <?php $no = 1;
                            foreach ($produk as $p) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><img src="<?= base_url('/uploads/produk/' . $p['gambar']) ?>" width="50"></td>
                                    <td><?= $p['nama'] ?></td>
                                    <td><?= ucfirst($p['kategori']) ?></td>
                                    <td><?= date('d M Y', strtotime($p['created_at'])) ?></td>
                                    <td>
                                        <a href="<?= base_url('/data-produk/edit-produk/' . $p['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="<?= base_url('delete-produk/' . $p['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data produk.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>