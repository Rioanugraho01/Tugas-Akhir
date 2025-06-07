<?= $this->extend('admin/layout/app'); ?>
<?= $this->section('content'); ?>

<style>
    @keyframes fadeSlideUp {
        0% {
            opacity: 0;
            transform: translateY(20px);
        }

        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .card-animated {
        animation: fadeSlideUp 0.6s ease forwards;
        opacity: 0;
        transform: translateY(20px);
    }

    .card:hover {
        transform: scale(1.03);
        transition: transform 0.3s ease;
    }

    .card {
        transition: transform 0.3s ease;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <!-- Main Content -->
        <main class="col-md-9 col-lg-12 px-md-4 main-content">
            <div class="bg-white border rounded-3 shadow-sm p-4 mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="fw-bold text-dark mb-0">Dashboard Admin</h2>
                </div>
            </div>

            <!-- Statistik -->
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4 mt-1">
                <div class="col">
                    <div class="card shadow-sm border-0 text-center h-100 card-animated">
                        <div class="card-body">
                            <i class="bi bi-bar-chart-fill fs-2 text-warning"></i>
                            <h6 class="mt-2 mb-1">Total Pemesanan</h6>
                            <h4 class="fw-bold mb-0 count-up" data-target="<?= $totalPemesanan ?>"></h4>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card shadow-sm border-0 text-center h-100 card-animated">
                        <div class="card-body">
                            <i class="bi bi-check-circle-fill fs-2 text-success"></i>
                            <h6 class="mt-2 mb-1">Pemesanan Selesai</h6>
                            <h4 class="fw-bold mb-0 count-up" data-target="<?= $pemesananSelesai ?>"></h4>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card shadow-sm border-0 text-center h-100 card-animated">
                        <div class="card-body">
                            <i class="bi bi-x-circle-fill fs-2 text-secondary"></i>
                            <h6 class="mt-2 mb-1">Pemesanan Ditolak</h6>
                            <h4 class="fw-bold mb-0 text-secondary count-up" data-target="<?= $pemesananDitolak ?>"></h4>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card shadow-sm border-0 text-center h-100 card-animated">
                        <div class="card-body">
                            <i class="bi bi-hourglass-split fs-2 text-primary"></i>
                            <h6 class="mt-2 mb-1">Dalam Proses</h6>
                            <h4 class="fw-bold mb-0 count-up" data-target="<?= $pemesananProses ?>"></h4>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card shadow-sm border-0 text-center h-100 card-animated">
                        <div class="card-body">
                            <i class="bi bi-cash-stack fs-2 text-danger"></i>
                            <h6 class="mt-2 mb-1">Total Pendapatan</h6>
                            <h5 class="fw-bold mb-0 text-success count-up" data-target="<?= $totalPendapatan ?? 0 ?>"></h5>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Grafik -->
            <div class="row mt-4">
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm border-0 p-3">
                        <h5 class="text-start mb-3">Grafik Mingguan</h5>
                        <canvas id="chartMingguan"></canvas>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm border-0 p-3">
                        <h5 class="text-start mb-3">Grafik Bulanan</h5>
                        <canvas id="chartBulanan"></canvas>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card shadow-sm border-0 p-3">
                        <h5 class="text-start mb-3">Grafik Tahunan</h5>
                        <canvas id="chartTahunan"></canvas>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
    const mingguanLabels = ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'];
    const mingguanData = <?= json_encode(array_values($mingguanData)) ?>;

    const bulananLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    const bulananData = <?= json_encode(array_values($bulananData)) ?>;

    const tahunanLabels = <?= json_encode(array_keys($tahunanData)) ?>;
    const tahunanData = <?= json_encode(array_values($tahunanData)) ?>;

    // Grafik Mingguan
    const ctxMingguan = document.getElementById('chartMingguan');
    new Chart(ctxMingguan, {
        type: 'bar',
        data: {
            labels: mingguanLabels,
            datasets: [{
                label: 'Jumlah Pemesanan',
                data: mingguanData,
                backgroundColor: '#f0ad4e'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true
                },
                title: {
                    display: true,
                    text: 'Pemesanan Mingguan (bulan ini)'
                }
            }
        }
    });

    const ctxBulanan = document.getElementById('chartBulanan').getContext('2d');
    new Chart(ctxBulanan, {
        type: 'bar',
        data: {
            labels: bulananLabels,
            datasets: [{
                label: 'Jumlah Pemesanan',
                data: bulananData,
                backgroundColor: '#5bc0de'
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    min: 0,
                    max: 50,
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Pemesanan Bulanan'
                }
            }
        }
    });

    const ctxTahunan = document.getElementById('chartTahunan').getContext('2d');
    new Chart(ctxTahunan, {
        type: 'line',
        data: {
            labels: tahunanLabels,
            datasets: [{
                label: 'Jumlah Pemesanan',
                data: tahunanData,
                borderColor: '#d9534f',
                backgroundColor: 'rgba(217, 83, 79, 0.2)',
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    min: 0,
                    max: 150,
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Pemesanan Tahunan'
                }
            }
        }
    });
    document.addEventListener("DOMContentLoaded", function() {
        // Animasi fade-slide saat muncul
        const cards = document.querySelectorAll(".card-animated");
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = 1;
                    entry.target.classList.add("animate");
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1
        });

        cards.forEach(card => observer.observe(card));

        // Count-up animasi
        const counters = document.querySelectorAll(".count-up");
        counters.forEach(counter => {
            const target = +counter.getAttribute("data-target");
            let count = 0;
            const speed = 30;
            const increment = Math.ceil(target / speed);

            function updateCount() {
                count += increment;
                if (count < target) {
                    counter.innerText = count.toLocaleString('id-ID');
                    setTimeout(updateCount, 20);
                } else {
                    counter.innerText = target.toLocaleString('id-ID');
                }
            }

            updateCount();
        });
    });
</script>

<?= $this->endSection(); ?>