<?= $this->extend('admin/layout/app'); ?>
<?= $this->section('content'); ?>

<style>
    table td,
    table th {
        padding: 1rem !important;
        vertical-align: middle !important;
        font-size: 1rem;
        white-space: nowrap;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <main class="col-md-9 col-lg-12 px-md-4 main-content">
            <div class="bg-white border rounded-3 shadow-sm p-4 mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="fw-bold text-dark mb-0">Pemesanan Khusus</h2>
                </div>
            </div>
            <form method="GET" class="mb-4 p-3 bg-white rounded shadow-sm border">
                <div class="row g-2 align-items-end">
                    <!-- Search -->
                    <div class="col-md-4">
                        <label for="search" class="form-label fw-semibold">🔍 Cari Nama/Acara/Produk</label>
                        <input type="text" id="search" name="search" class="form-control" placeholder="Masukkan kata kunci..." value="<?= isset($_GET['search']) ? esc($_GET['search']) : '' ?>">
                    </div>

                    <div class="col-md-4">
                        <label for="date_from" class="form-label fw-semibold">📅 Tanggal Mulai</label>
                        <input type="date" id="date_from" name="date_from" class="form-control" value="<?= isset($_GET['date_from']) ? esc($_GET['date_from']) : '' ?>">
                    </div>

                    <div class="col-md-4">
                        <label for="date_to" class="form-label fw-semibold">📅 Tanggal Sampai</label>
                        <input type="date" id="date_to" name="date_to" class="form-control" value="<?= isset($_GET['date_to']) ? esc($_GET['date_to']) : '' ?>">
                    </div>

                    <div class="col-md-3 mt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-funnel"></i> Filter
                        </button>
                        <a href="<?= base_url('pemesanan-khusus') ?>" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-clockwise"></i> Reset
                        </a>
                    </div>
                </div>
            </form>
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <div class="table-responsive">
                <table class="table table-bordered table-hover shadow-sm">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Nama</th>
                            <th>Nomor HP</th>
                            <th>Nama Acara</th>
                            <th>Produk</th>
                            <th>Tanggal Pemesanan</th>
                            <th>Waktu Pengiriman</th>
                            <th>Catatan</th>
                            <th>Jumlah Tamu</th>
                            <th>Pembayaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($pemesanan as $order): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $order['username']; ?></td>
                                <td><?= $order['nama']; ?></td>
                                <td><?= $order['nomor_hp']; ?></td>
                                <td><?= $order['nama_acara']; ?></td>
                                <td><?= $order['produk']; ?></td>
                                <td><?= date('d-m-Y', strtotime($order['tanggal_pemesanan'])); ?></td>
                                <td><?= date('H:i', strtotime($order['waktu_pemesanan'])); ?></td>
                                <td><?= $order['catatan']; ?></td>
                                <td><?= $order['jumlah_tamu']; ?></td>
                                <td><?= ucfirst($order['pembayaran']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>

<?= $this->endSection(); ?>