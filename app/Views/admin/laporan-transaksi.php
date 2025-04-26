<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
                <a href="kalender-ketersediaan"><i class="bi bi-calendar-check"></i> Kalender Ketersediaan</a>
                <a href="data-pemesanan"><i class="bi bi-cart"></i> Pemesanan</a>
                <a href="data-produk"><i class="bi bi-box"></i> Produk</a>
                <a href="macam-produk"><i class="bi bi-box"></i> Macam Produk</a>
                <a href="riwayat-pemesanan"><i class="bi bi-clock-history"></i> Riwayat Pemesanan</a>
                <a href="laporan-transaksi"><i class="bi bi-receipt"></i> Laporan Transaksi</a>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
            <h2 class="mb-3">Laporan Transaksi</h2>
                <!-- Filter & Search -->
            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="filterTanggal" class="form-label">Filter Tanggal</label>
                    <input type="date" id="filterTanggal" class="form-control">
                </div>
                <div class="col-md-3">
                    <label for="searchData" class="form-label">Search</label>
                    <input type="text" id="searchData" class="form-control" placeholder="Cari transaksi...">
                </div>
            </div>

            <!-- Perbandingan Pemasukan / Laba -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <canvas id="pemasukanChart"></canvas>
                </div>
                <div class="col-md-6">
                    <canvas id="labaChart"></canvas>
                </div>
            </div>

            <!-- Analisis Catering -->
            <h4 class="mb-3">Analisis Catering</h4>
            <div class="row">
                <div class="col-md-6">
                    <canvas id="analisisCateringChart"></canvas>
                </div>
            </div>

            <!-- Tabel Laporan Transaksi -->
            <div class="table-responsive mt-4">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Produk</th>
                            <th>Macam Produk</th>
                            <th>Tanggal Pemesanan</th>
                            <th>Tanggal Pembayaran</th>
                            <th>Harga</th>
                            <th>Metode Pembayaran</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>John Doe</td>
                            <td>Paket Catering A</td>
                            <td>Nasi Kotak</td>
                            <td>2024-03-01</td>
                            <td>2024-03-02</td>
                            <td>Rp 500.000</td>
                            <td>Transfer Bank</td>
                            <td>Lunas</td>
                            <td>
                                <button class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i> Edit</button>
                                <button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Hapus</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            </main>
        </div>
    </div>

    <script>
        // Grafik Pemasukan
        new Chart(document.getElementById('pemasukanChart'), {
            type: 'bar',
            data: {
                labels: ['Januari', 'Februari', 'Maret', 'April'],
                datasets: [{
                    label: 'Pemasukan (Rp)',
                    data: [5000000, 7000000, 8000000, 6000000],
                    backgroundColor: 'rgba(54, 162, 235, 0.6)'
                }]
            }
        });

        // Grafik Laba
        new Chart(document.getElementById('labaChart'), {
            type: 'line',
            data: {
                labels: ['Januari', 'Februari', 'Maret', 'April'],
                datasets: [{
                    label: 'Laba (Rp)',
                    data: [2000000, 3000000, 3500000, 2500000],
                    borderColor: 'rgba(255, 99, 132, 1)',
                    fill: false
                }]
            }
        });

        // Grafik Analisis Catering
        new Chart(document.getElementById('analisisCateringChart'), {
            type: 'pie',
            data: {
                labels: ['Nasi Kotak', 'Buffet', 'Snack Box'],
                datasets: [{
                    data: [40, 35, 25],
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56']
                }]
            }
        });
    </script>
</body>

</html>