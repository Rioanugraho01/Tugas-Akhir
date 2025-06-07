<?= $this->extend('admin/layout/app'); ?>
<?= $this->section('content'); ?>

<style>
    table td, table th {
        padding: 1rem !important;
        vertical-align: middle !important;
        font-size: 1rem;
        white-space: nowrap;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <main class="col-md-9 col-lg-12 px-md-4">
            <div class="bg-white border rounded-3 shadow-sm p-4 mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="fw-bold text-dark mb-0">Riwayat Pemesanan</h2>
                </div>
            </div>
            <!-- FORM FILTER -->
            <form method="GET" class="mb-4 p-3 bg-white rounded shadow-sm border">
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label for="search" class="form-label fw-semibold">🔍 Cari Produk</label>
                        <input type="text" name="search" id="search" class="form-control" value="<?= esc($_GET['search'] ?? '') ?>" placeholder="Ketik nama produk atau pelanggan...">
                    </div>

                    <div class="col-md-3">
                        <label for="kategori" class="form-label fw-semibold">📂 Kategori</label>
                        <select name="kategori" id="kategori" class="form-select">
                            <option value="">Semua</option>
                            <option value="regular" <?= ($_GET['kategori'] ?? '') === 'regular' ? 'selected' : '' ?>>Regular</option>
                            <option value="khusus" <?= ($_GET['kategori'] ?? '') === 'khusus' ? 'selected' : '' ?>>Khusus</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="date_from" class="form-label fw-semibold">📅 Mulai</label>
                        <input type="date" name="date_from" id="date_from" class="form-control" value="<?= esc($_GET['date_from'] ?? '') ?>">
                    </div>

                    <div class="col-md-3">
                        <label for="date_to" class="form-label fw-semibold">📅 Sampai</label>
                        <input type="date" name="date_to" id="date_to" class="form-control" value="<?= esc($_GET['date_to'] ?? '') ?>">
                    </div>

                    <div class="col-md-3 d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-funnel-fill"></i> Filter
                        </button>
                        <a href="<?= base_url('riwayat-pemesanan') ?>" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-counterclockwise"></i> Reset
                        </a>
                    </div>
                </div>
            </form>
            <!-- TABEL PEMESANAN REGULER -->
            <?php if (!empty($pemesanan_regular)): ?>
                <h5 class="mb-3">Pemesanan Regular</h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle shadow-sm">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Nama</th>
                                <th>No HP</th>
                                <th>Macam Produk</th>
                                <th>Tanggal Pesan</th>
                                <th>Tanggal Ambil</th>
                                <th>Waktu Pengambilan</th>
                                <th>Catatan</th>
                                <th>Total</th>
                                <th>Metode</th>
                                <th>DP</th>
                                <th>Sisa</th>
                                <th>Persentase DP</th>
                                <th>Status Pemesanan</th>
                                <th>Status Pembayaran</th>
                                <th>Progress</th>
                                <th>Bukti</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($pemesanan_regular as $row): ?>
                                <tr>
                                    <td class="text-center"><?= $no++ ?></td>
                                    <td><?= esc($row['username']) ?></td>
                                    <td><?= esc($row['nama']) ?></td>
                                    <td><?= esc($row['no_hp']) ?></td>
                                    <td><?= esc($row['macam_produk']) ?></td>
                                    <td><?= esc($row['tanggal_pemesanan']) ?></td>
                                    <td><?= esc($row['tanggal_pengambilan']) ?></td>
                                    <td><?= esc($row['waktu_pengambilan']) ?></td>
                                    <td><?= esc($row['catatan']) ?></td>
                                    <td class="text-end">Rp<?= number_format($row['total_harga'], 0, ',', '.') ?></td>
                                    <td><?= esc($row['jenis_pembayaran']) ?></td>
                                    <td class="text-end">Rp<?= number_format($row['jumlah_dp'], 0, ',', '.') ?></td>
                                    <td class="text-end">Rp<?= number_format($row['sisa_pembayaran'], 0, ',', '.') ?></td>
                                    <td class="text-center"><?= esc($row['persentase_dp']) ?>%</td>
                                    <td><span class="badge bg-info px-3 py-2 rounded-pill"><?= esc($row['status_pemesanan']) ?></span></td>
                                    <td><span class="badge bg-warning px-3 py-2 rounded-pill"><?= esc($row['status_pembayaran']) ?></span></td>
                                    <td><span class="badge bg-success px-3 py-2 rounded-pill"><?= esc($row['status_progress']) ?></span></td>
                                    <td>
                                        <?php if (!empty($row['bukti_pembayaran']) && file_exists(FCPATH . 'uploads/bukti/' . $row['bukti_pembayaran'])): ?>
                                            <a href="<?= base_url('uploads/bukti/' . $row['bukti_pembayaran']) ?>" target="_blank" class="btn btn-sm btn-outline-primary">Lihat</a>
                                        <?php else: ?>
                                            <span class="text-muted">Tidak Ada</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-info">Tidak ada data pemesanan reguler ditemukan.</div>
            <?php endif; ?>
            <!-- TABEL PEMESANAN KHUSUS -->
            <?php if (!empty($pemesanan_khusus)): ?>
                <h5 class="mb-3 mt-5">Pemesanan Khusus</h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle shadow-sm">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Nama</th>
                                <th>Nomor HP</th>
                                <th>Nama Acara</th>
                                <th>Produk</th>
                                <th>Tanggal Pesan</th>
                                <th>Waktu Pemesanan</th>
                                <th>Catatan</th>
                                <th>Jumlah Tamu</th>
                                <th>Total Harga</th>
                                <th>Pembayaran</th>
                                <th>Status Pemesanan</th>
                                <th>Status Pembayaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($pemesanan_khusus as $row): ?>
                                <tr>
                                    <td class="text-center"><?= $no++ ?></td>
                                    <td><?= esc($row['username']) ?></td>
                                    <td><?= esc($row['nama']) ?></td>
                                    <td><?= esc($row['nomor_hp']) ?></td>
                                    <td><?= esc($row['nama_acara']) ?></td>
                                    <td><?= esc($row['produk']) ?></td>
                                    <td><?= esc($row['tanggal_pemesanan']) ?></td>
                                    <td><?= esc($row['waktu_pemesanan']) ?></td>
                                    <td><?= esc($row['catatan']) ?></td>
                                    <td class="text-center"><?= esc($row['jumlah_tamu']) ?></td>
                                    <td class="text-end">Rp<?= number_format($row['total_harga'], 0, ',', '.') ?></td>
                                    <td class="text-center"><?= esc($row['pembayaran']) ?>%</td>
                                    <td><span class="badge bg-info px-3 py-2 rounded-pill"><?= esc($row['status_pemesanan']) ?></span></td>
                                    <td><span class="badge bg-warning px-3 py-2 rounded-pill"><?= esc($row['status_pembayaran']) ?></span></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-info">Tidak ada data pemesanan khusus ditemukan.</div>
            <?php endif; ?>
        </main>
    </div>
</div>

<?= $this->endSection(); ?>