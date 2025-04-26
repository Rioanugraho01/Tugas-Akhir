<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        .main-content {
            padding: 20px;
        }
        .card-custom {
            border-left: 5px solid #ffcc00;
            transition: 0.3s;
        }
        .card-custom:hover {
            transform: translateY(-5px);
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar">
                <h4 class="text-center mb-4">Admin Ima Catering</h4>
                <a href="#"><i class="bi bi-speedometer2"></i> Dashboard</a>
                <a href="kelola-user"><i class="bi bi-people"></i> Data Kelola User</a>
                <a href="#"><i class="bi bi-calendar-check"></i> Kalender Ketersediaan</a>
                <a href="#"><i class="bi bi-cart"></i> Pemesanan</a>
                <a href="#"><i class="bi bi-box"></i> Produk</a>
                <a href="macam-produk"><i class="bi bi-box"></i> Macam Produk</a>
                <a href="#"><i class="bi bi-clock-history"></i> Riwayat Pemesanan</a>
                <a href="#"><i class="bi bi-receipt"></i> Laporan Transaksi</a>
            </nav>
            
            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <h2 class="mb-4">Dashboard Admin</h2>
                
                <!-- Statistik Kartu -->
                <div class="row">
                    <div class="col-md-3">
                        <div class="card card-custom p-3">
                            <h5>Total Pemesanan</h5>
                            <h3>150</h3>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-custom p-3">
                            <h5>Pemesanan Selesai</h5>
                            <h3>120</h3>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-custom p-3">
                            <h5>Pemesanan Dalam Proses</h5>
                            <h3>30</h3>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-custom p-3">
                            <h5>Total Pendapatan</h5>
                            <h3>Rp 50.000.000</h3>
                        </div>
                    </div>
                </div>

                <!-- Grafik -->
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card p-3">
                            <h5>Pemesanan Per Minggu</h5>
                            <canvas id="chartWeekly"></canvas>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card p-3">
                            <h5>Pemesanan Per Tahun</h5>
                            <canvas id="chartYearly"></canvas>
                        </div>
                    </div>
                    <div class="col-md-12 mt-4">
                        <div class="card p-3">
                            <h5>Grafik Per Bulan</h5>
                            <canvas id="chartPemesanan"></canvas>
                        </div>
                    </div>
                </div>
                <!-- Tabel Pemesanan Terbaru -->
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="card p-3">
                            <h5>Pemesanan Terbaru</h5>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Produk</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Ahmad</td>
                                        <td>Nasi Tumpeng</td>
                                        <td>2025-03-01</td>
                                        <td><span class="badge bg-warning">Diproses</span></td>
                                    </tr>
                                    <tr>
                                        <td>Siti</td>
                                        <td>Kue Basah</td>
                                        <td>2025-03-02</td>
                                        <td><span class="badge bg-success">Selesai</span></td>
                                    </tr>
                                    <tr>
                                        <td>Joko</td>
                                        <td>Es Campur</td>
                                        <td>2025-03-03</td>
                                        <td><span class="badge bg-danger">Dibatalkan</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    
    <script>
        // Grafik Pemesanan Mingguan
        var ctxWeekly = document.getElementById('chartWeekly').getContext('2d');
        new Chart(ctxWeekly, {
            type: 'line',
            data: {
                labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                datasets: [{
                    label: 'Pemesanan',
                    data: [12, 15, 10, 8, 18, 20, 25],
                    borderColor: 'rgba(255, 204, 0, 1)',
                    backgroundColor: 'rgba(255, 204, 0, 0.2)',
                    fill: true
                }]
            }
        });

        // Grafik Pemesanan Bulanan
        const ctx = document.getElementById('chartPemesanan').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Jumlah Pemesanan',
                    data: [12, 19, 10, 15, 22, 30, 25, 18, 24, 28, 35, 40],
                    backgroundColor: 'rgba(255, 204, 0, 0.7)',
                    borderColor: '#ffcc00',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        
        // Grafik Pemesanan Tahunan
        var ctxYearly = document.getElementById('chartYearly').getContext('2d');
        new Chart(ctxYearly, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Pemesanan',
                    data: [200, 220, 250, 280, 320, 350, 400, 420, 450, 470, 500, 520],
                    backgroundColor: 'rgba(255, 204, 0, 1)'
                }]
            }
        });
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>