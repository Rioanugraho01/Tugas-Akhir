<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Produk - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
                <a href="kalender-ketersediaan"><i class="bi bi-calendar-check"></i> Kalender Ketersediaan</a>
                <a href="data-pemesanan"><i class="bi bi-cart"></i> Pemesanan</a>
                <a href="data-produk"><i class="bi bi-box"></i> Produk</a>
                <a href="macam-produk"><i class="bi bi-box"></i> Macam Produk</a>
                <a href="riwayat-pemesanan"><i class="bi bi-clock-history"></i> Riwayat Pemesanan</a>
                <a href="laporan-transaksi"><i class="bi bi-receipt"></i> Laporan Transaksi</a>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                <h2>Data Produk</h2>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <input type="date" class="form-control" placeholder="Filter Tanggal">
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" placeholder="Cari Produk...">
                    </div>
                </div>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Produk</th>
                            <th>Macam Produk</th>
                            <th>Tanggal Pemesanan</th>
                            <th>Tanggal Pengambilan</th>
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
                            <td>Katering A</td>
                            <td>Paket Lengkap</td>
                            <td>2025-03-05</td>
                            <td>2025-03-06</td>
                            <td>Rp 500.000</td>
                            <td>Transfer Bank</td>
                            <td>
                                <button class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></button>
                                <button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </main>
        </div>
    </div>
</body>

</html>