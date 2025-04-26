<?= $this->extend('layout/app'); ?>
<?= $this->section('content'); ?>

<style>
    /* Slider */
    .carousel {
        width: 100%;
    }

    .carousel-item {
        height: 500px;
    }

    .carousel-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .carousel-caption {
        position: absolute;
        top: 52%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        color: white;
        z-index: 10;
        width: 80%;
    }

    .carousel-caption h2 {
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .carousel-caption p {
        font-size: 1.2rem;
    }

    /* Responsiveness */
    @media (max-width: 768px) {
        .carousel-item {
            height: 400px;
        }

        .carousel-caption h2 {
            font-size: 2rem;
        }

        .carousel-caption p {
            font-size: 1rem;
        }
    }

    @media (max-width: 576px) {
        .carousel-item {
            height: 350px;
        }

        .carousel-caption h2 {
            font-size: 1.8rem;
        }

        .carousel-caption p {
            font-size: 0.9rem;
        }
    }
</style>

<!-- Slider -->
<div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="<?= base_url('img/beranda.jpeg'); ?>" alt="Slider 1">
            <div class="carousel-caption">
                <h2>Riwayat Transaksi</h2>
                <p>Lihat Semua Transaksi Anda</p>
            </div>
        </div>
    </div>
</div>

<!-- riwayat -->
<?php $session = session(); ?>
<div class="container mt-5 mb-5">
    <h2 class="text-center fw-bold">Riwayat Transaksi</h2>
    <hr>

    <!-- Filter -->
    <div class=" d-flex justify-content-between mb-3">
        <div class="col-md-4 col-6">
            <label for="filterTanggal" class="form-label">Filter Tanggal</label>
            <input type="date" class="form-control" id="filterTanggal">
        </div>
    </div>

    <!-- Tabel Riwayat Transaksi -->
    <div class="table-responsive">
        <table class="table table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Produk</th>
                    <th>Macam Produk</th>
                    <th>Pemesanan</th>
                    <th>Pengambilan</th>
                    <th>Harga</th>
                    <th>Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>001</td>
                    <td>Nasi Box</td>
                    <td>Ayam Goreng</td>
                    <td>01-03-2025</td>
                    <td>02-03-2025</td>
                    <td>Rp 50.000</td>
                    <td>Lunas</td>
                </tr>
                <tr>
                    <td>002</td>
                    <td>Buffet</td>
                    <td>Makan Siang</td>
                    <td>05-03-2025</td>
                    <td>06-03-2025</td>
                    <td>Rp 250.000</td>
                    <td>Belum Lunas</td>
                </tr>
                <tr>
                    <td>003</td>
                    <td>Snack Box</td>
                    <td>Roti & Teh</td>
                    <td>10-03-2025</td>
                    <td>11-03-2025</td>
                    <td>Rp 30.000</td>
                    <td>Lunas</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection(); ?>