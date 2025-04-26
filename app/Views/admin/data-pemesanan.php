<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Pemesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        body { background: #f4f4f4; }
        .sidebar { background: #343a40; min-height: 100vh; padding-top: 20px; color: white; }
        .sidebar a { color: white; text-decoration: none; display: block; padding: 10px; transition: 0.3s; }
        .sidebar a:hover { background: #ffcc00; color: black; border-radius: 5px; }
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
                <a href="macam-produk"><i class="bi bi-box"></i> Macam Produk</a>
                <a href="riwayat-pemesanan"><i class="bi bi-clock-history"></i> Riwayat Pemesanan</a>
                <a href="laporan-transaksi"><i class="bi bi-receipt"></i> Laporan Transaksi</a>
            </nav>
            
            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <h2 class="mb-3">Pemesanan</h2>
                
                <!-- Filter & Search -->
                <div class="d-flex justify-content-between mb-3">
                    <input type="date" class="form-control w-25" id="filterTanggal">
                    <input type="text" class="form-control w-50" placeholder="Cari pesanan...">
                    <button class="btn btn-primary"><i class="bi bi-plus-circle"></i> Tambah Pemesanan</button>
                </div>
                
                <!-- Tabel Data Pemesanan -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Produk</th>
                                <th>Macam Produk</th>
                                <th>Tanggal Pemesanan</th>
                                <th>Tanggal Pengembalian</th>
                                <th>Harga</th>
                                <th>Metode Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>John Doe</td>
                                <td>johndoe</td>
                                <td>Nasi Kotak</td>
                                <td>Ayam Goreng</td>
                                <td>2025-03-10</td>
                                <td>2025-03-11</td>
                                <td>Rp 50.000</td>
                                <td>Transfer Bank</td>
                                <td>
                                    <button class="btn btn-success btn-sm"><i class="bi bi-check-circle"></i></button>
                                    <button class="btn btn-danger btn-sm"><i class="bi bi-x-circle"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>