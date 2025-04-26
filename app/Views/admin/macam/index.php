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
                <a href="macam"><i class="bi bi-box"></i> Macam Produk</a>
                <a href="riwayat-pemesanan"><i class="bi bi-clock-history"></i> Riwayat Pemesanan</a>
                <a href="laporan-transaksi"><i class="bi bi-receipt"></i> Laporan Transaksi</a>
            </nav>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <h2 class="mt-4">Daftar Macam Produk</h2>

                <!-- Notifikasi -->
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                <?php elseif (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <!-- Pencarian -->
                <div class="card mb-4">
                    <div class="card-body">
                        <form method="get" action="<?= base_url('macam') ?>">
                            <div class="row align-items-end">
                                <div class="col-md-3">
                                    <label for="search" class="form-label">
                                        <i class="bi bi-search"></i> Cari Nama
                                    </label>
                                    <input type="text" class="form-control" id="search" name="search" value="<?= esc($search) ?>" placeholder="Masukkan nama macam produk...">
                                </div>

                                <div class="col-md-3">
                                    <label for="produk_id" class="form-label">
                                        <i class="bi bi-tags"></i> Produk
                                    </label>
                                    <select class="form-select" id="produk_id" name="produk_id">
                                        <option value="">-- Semua Produk --</option>
                                        <?php foreach ($produkList as $item): ?>
                                            <option value="<?= $item['id'] ?>" <?= $item['id'] == $produk_id ? 'selected' : '' ?>>
                                                <?= esc($item['nama']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label for="date_from" class="form-label">
                                        <i class="bi bi-calendar-date"></i> Dari Tanggal
                                    </label>
                                    <input type="date" class="form-control" id="date_from" name="date_from" value="<?= esc($date_from) ?>">
                                </div>

                                <div class="col-md-3">
                                    <label for="date_to" class="form-label">
                                        <i class="bi bi-calendar-date-fill"></i> Sampai Tanggal
                                    </label>
                                    <input type="date" class="form-control" id="date_to" name="date_to" value="<?= esc($date_to) ?>">
                                </div>

                                <div class="col-md-2 gap-3 mt-3">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-funnel"></i> Filter
                                    </button>
                                    <a href="<?= base_url('macam') ?>" class="btn btn-outline-secondary">
                                        <i class="bi bi-arrow-clockwise"></i> Reset
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <a href="<?= site_url('macam/create/' . $produk_id) ?>" class="btn btn-success mb-3 mt-3">
                    <i class="bi bi-tags"></i> Tambah Macam Produk
                </a>

                <!-- Tabel Macam Produk -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Nama Macam Produk</th>
                                <th>Deskripsi</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($macamProduk) > 0): ?>
                                <?php $no = 1;
                                foreach ($macamProduk as $produk): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td>
                                            <?php if ($produk['gambar']): ?>
                                                <img src="<?= base_url('uploads/macam-produk/' . $produk['gambar']) ?>" alt="Gambar Produk" class="img-thumbnail" width="80">
                                            <?php else: ?>
                                                <p class="text-muted">Tidak ada gambar</p>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= esc($produk['nama']) ?></td>
                                        <td><?= esc($produk['deskripsi']) ?></td>
                                        <td>Rp <?= number_format($produk['harga'], 0, ',', '.') ?></td>
                                        <td>
                                            <a href="<?= base_url('/macam/edit/' . $produk['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="<?= base_url('/macam/delete/' . $produk['id']) ?>" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                                <?= csrf_field() ?>
                                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
</body>

</html>