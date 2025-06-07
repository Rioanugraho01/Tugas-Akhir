<?= $this->extend('user/layout/app'); ?>
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

    table td, table th {
        padding: 1rem !important;
        vertical-align: middle !important;
        font-size: 1rem;
        white-space: nowrap;
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
            <img src="<?= base_url('img/' . $setting['slider_image']) ?>" alt="Slider 1">
            <div class="carousel-caption">
                <h2>Riwayat Transaksi</h2>
                <p>Lihat Semua Transaksi Anda</p>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="text-center">
        <h2 class="fw-bold">Riwayat Transaksi</h2>
    </div>

    <hr class="mt-3">

    <!-- Filter -->
    <form method="get" class="row gx-3 gy-2 align-items-end mb-4 p-3 bg-light rounded shadow-sm">
        <div class="col-auto">
            <label for="filter_tanggal" class="form-label fw-semibold">Filter Tanggal</label>
            <input
                type="date"
                class="form-control"
                id="filter_tanggal"
                name="filter_tanggal"
                value="<?= esc($filterTanggal) ?>"
                placeholder="Pilih tanggal" />
        </div>

        <div class="col-auto">
            <label for="filter_jenis" class="form-label fw-semibold">Jenis Produk</label>
            <select class="form-select" id="filter_jenis" name="filter_jenis">
                <option value="reguler" <?= ($filterJenis === 'reguler') ? 'selected' : '' ?>>Produk Reguler</option>
                <option value="khusus" <?= ($filterJenis === 'khusus') ? 'selected' : '' ?>>Produk Khusus</option>
                <option value="semua" <?= ($filterJenis === 'semua') ? 'selected' : '' ?>>Semua Produk</option>
            </select>
        </div>

        <div class="col-auto d-flex gap-2">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="<?= current_url() ?>" class="btn btn-outline-secondary">Reset</a>
        </div>
    </form>

    <!-- Produk Reguler -->
    <?php if ($filterJenis === 'reguler' || $filterJenis === 'semua'): ?>
        <div class="mb-5">
            <h4 class="mb-3">Produk Reguler</h4>
            <div class="table-responsive">
                <table class="table table-bordered table-hover shadow-sm align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>No HP</th>
                            <th>Produk</th>
                            <th>Macam Produk</th>
                            <th>Tgl Pesan</th>
                            <th>Tgl Ambil</th>
                            <th>Waktu Pengambilan</th>
                            <th>Catatan</th>
                            <th>Total</th>
                            <th>Metode</th>
                            <th>DP</th>
                            <th>Sisa</th>
                            <th>% DP</th>
                            <th>Status Pemesanan</th>
                            <th>Status Pembayaran</th>
                            <th>Progress</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($riwayat_reguler)): ?>
                            <tr>
                                <td colspan="18" class="text-center">Tidak ada data.</td>
                            </tr>
                        <?php else: ?>
                            <?php $no = 1;
                            foreach ($riwayat_reguler as $row): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= esc($row['nama']) ?></td>
                                    <td><?= esc($row['no_hp']) ?></td>
                                    <td><?= esc($row['produk_id']) ?></td>
                                    <td><?= esc($row['macam_produk']) ?></td>
                                    <td><?= esc($row['tanggal_pemesanan']) ?></td>
                                    <td><?= esc($row['tanggal_pengambilan']) ?></td>
                                    <td><?= esc($row['waktu_pengambilan']) ?></td>
                                    <td><?= esc($row['catatan']) ?></td>
                                    <td>Rp<?= number_format($row['total_harga'], 0, ',', '.') ?></td>
                                    <td><?= esc($row['jenis_pembayaran']) ?></td>
                                    <td>Rp<?= number_format($row['jumlah_dp'], 0, ',', '.') ?></td>
                                    <td>Rp<?= number_format($row['sisa_pembayaran'], 0, ',', '.') ?></td>
                                    <td><?= esc($row['persentase_dp']) ?>%</td>
                                    <td><span class="badge bg-info"><?= esc($row['status_pemesanan']) ?></span></td>
                                    <td><span class="badge bg-warning"><?= esc($row['status_pembayaran']) ?></span></td>
                                    <td><span class="badge bg-success"><?= esc($row['status_progress']) ?></span></td>
                                </tr>
                            <?php endforeach ?>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>

    <!-- Produk Khusus -->
    <?php if ($filterJenis === 'khusus' || $filterJenis === 'semua'): ?>
        <div class="mb-5">
            <h4 class="mb-3">Produk Khusus</h4>
            <div class="table-responsive">
                <table class="table table-bordered table-hover shadow-sm align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Nomor HP</th>
                            <th>Nama Acara</th>
                            <th>Produk</th>
                            <th>Tanggal</th>
                            <th>Waktu Pemesanan</th>
                            <th>Catatan</th>
                            <th>Jumlah Tamu</th>
                            <th>Pembayaran</th>
                            <th>Total Harga</th>
                            <th>Status Pemesanan</th>
                            <th>Status Pembayaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($pemesanan_khusus)): ?>
                            <tr>
                                <td colspan="13" class="text-center">Tidak ada data.</td>
                            </tr>
                        <?php else: ?>
                            <?php $no = 1;
                            foreach ($pemesanan_khusus as $row): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= esc($row['nama']) ?></td>
                                    <td><?= esc($row['nomor_hp']) ?></td>
                                    <td><?= esc($row['nama_acara']) ?></td>
                                    <td><?= esc($row['produk']) ?></td>
                                    <td><?= esc($row['tanggal_pemesanan']) ?></td>
                                    <td><?= esc($row['waktu_pemesanan']) ?></td>
                                    <td><?= esc($row['catatan']) ?></td>
                                    <td><?= esc($row['jumlah_tamu']) ?></td>
                                    <td><?= esc($row['pembayaran']) ?>%</td>
                                    <td>Rp<?= number_format($row['total_harga'], 0, ',', '.') ?></td>
                                    <td><span class="badge bg-info px-3 py-2 rounded-pill"><?= esc($row['status_pemesanan']) ?></span></td>
                                    <td><span class="badge bg-warning px-3 py-2 rounded-pill"><?= esc($row['status_pembayaran']) ?></span></td>
                                </tr>
                            <?php endforeach ?>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection(); ?>