<?= $this->extend('admin/layout/app') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="bg-white border rounded-3 shadow-sm p-4 mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="fw-bold text-dark mb-0">Laporan Transaksi</h2>
        </div>
    </div>

    <!-- Filter Form -->
    <form method="get" class="row g-3 align-items-end mb-4 mt-3">
        <div class="col-md-3">
            <label for="tahun" class="form-label">Pilih Tahun</label>
            <select name="tahun" id="tahun" class="form-select" onchange="this.form.submit()">
                <?php foreach ($tahunList as $tahun): ?>
                    <option value="<?= $tahun ?>" <?= $tahun == $tahunDipilih ? 'selected' : '' ?>>
                        <?= $tahun ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="col-md-3">
            <label for="bulan" class="form-label">Pilih Bulan</label>
            <select name="bulan" id="bulan" class="form-select" onchange="this.form.submit()">
                <?php foreach ($bulanList as $key => $namaBulan): ?>
                    <option value="<?= $key ?>" <?= $key == $bulanDipilih ? 'selected' : '' ?>>
                        <?= $namaBulan ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>
    </form>

    <!-- Perbandingan Pemasukan dan Laba -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title text-primary mb-3">Perbandingan Pemasukan</h5>
                    <p><strong><?= $bulanKemarin ?>:</strong> Rp <?= number_format($pemasukanKemarin, 0, ',', '.') ?></p>
                    <p><strong><?= $bulanSekarang ?>:</strong> Rp <?= number_format($pemasukanSekarang, 0, ',', '.') ?></p>
                    <p><strong>Selisih:</strong> Rp <?= number_format($selisihPemasukan, 0, ',', '.') ?>
                        (<span class="<?= $selisihPemasukan >= 0 ? 'text-success' : 'text-danger' ?>">
                            <?= $selisihPemasukan >= 0 ? 'Naik' : 'Turun' ?>
                        </span>)
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title text-success mb-3">Perbandingan Laba</h5>
                    <p><strong><?= $bulanKemarin ?>:</strong> Rp <?= number_format($labaKemarin, 0, ',', '.') ?></p>
                    <p><strong><?= $bulanSekarang ?>:</strong> Rp <?= number_format($labaSekarang, 0, ',', '.') ?></p>
                    <p><strong>Selisih:</strong> Rp <?= number_format($selisihLaba, 0, ',', '.') ?>
                        (<span class="<?= $selisihLaba >= 0 ? 'text-success' : 'text-danger' ?>">
                            <?= $selisihLaba >= 0 ? 'Naik' : 'Turun' ?>
                        </span>)
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Section -->
    <div class="row mb-4">
        <div class="col-md-6 mb-4 mb-md-0">
            <div class="card shadow-sm p-3">
                <h6 class="mb-3">Grafik Pemasukan Bulanan</h6>
                <canvas id="pemasukanChart"></canvas>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm p-3">
                <h6 class="mb-3">Grafik Laba Bulanan</h6>
                <canvas id="labaChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Pie Chart -->
    <div>
        <div class="card p-3 shadow-sm" style="max-width: 400px; width: 100%;">
            <h6 class="text-center mb-2">Total Pemesanan</h6>
            <canvas id="pieChart" style="max-height: 300px;"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = <?= json_encode($pemasukan_labels) ?>;

    const pemasukanRegulerData = <?= json_encode($pemasukan_reguler_array) ?>;
    const pemasukanKhususData = <?= json_encode($pemasukan_khusus_array) ?>;
    const labaRegulerData = <?= json_encode($laba_reguler_array) ?>;
    const labaKhususData = <?= json_encode($laba_khusus_array) ?>;

    new Chart(document.getElementById('pemasukanChart'), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                    label: 'Pemasukan Reguler',
                    data: pemasukanRegulerData,
                    backgroundColor: 'rgba(54, 162, 235, 0.7)'
                },
                {
                    label: 'Pemasukan Khusus',
                    data: pemasukanKhususData,
                    backgroundColor: 'rgba(255, 206, 86, 0.7)'
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true
                },
                title: {
                    display: true,
                    text: 'Pemasukan Bulanan (Reguler vs Khusus)'
                }
            }
        }
    });

    new Chart(document.getElementById('labaChart'), {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                    label: 'Laba Reguler',
                    data: labaRegulerData,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    fill: false,
                    tension: 0.4
                },
                {
                    label: 'Laba Khusus',
                    data: labaKhususData,
                    borderColor: 'rgba(153, 102, 255, 1)',
                    fill: false,
                    tension: 0.4
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true
                },
                title: {
                    display: true,
                    text: 'Laba Bulanan (Reguler vs Khusus)'
                }
            }
        }
    });

    new Chart(document.getElementById('pieChart'), {
        type: 'pie',
        data: {
            labels: ['Pemesanan Reguler', 'Pemesanan Khusus'],
            datasets: [{
                data: [<?= $totalPemesanan['reguler'] ?>, <?= $totalPemesanan['khusus'] ?>],
                backgroundColor: ['#36A2EB', '#FF6384'],
                borderColor: ['#fff', '#fff'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>

<?= $this->endSection() ?>