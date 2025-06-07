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
                    <h2 class="fw-bold text-dark mb-0">Data Pemesanan Khusus</h2>
                </div>
            </div>

            <!-- Filter Form -->
            <form method="GET" class="mb-4 p-3 bg-white rounded shadow-sm border">
                <div class="row g-2 align-items-end">
                    <div class="col-md-4">
                        <label for="search" class="form-label fw-semibold">🔍 Cari Nama/Acara/Produk</label>
                        <input type="text" id="search" name="search" class="form-control" placeholder="Masukkan kata kunci..." value="<?= esc($_GET['search'] ?? '') ?>">
                    </div>
                    <div class="col-md-4">
                        <label for="date_from" class="form-label fw-semibold">📅 Tanggal Mulai</label>
                        <input type="date" id="date_from" name="date_from" class="form-control" value="<?= esc($_GET['date_from'] ?? '') ?>">
                    </div>
                    <div class="col-md-4">
                        <label for="date_to" class="form-label fw-semibold">📅 Tanggal Sampai</label>
                        <input type="date" id="date_to" name="date_to" class="form-control" value="<?= esc($_GET['date_to'] ?? '') ?>">
                    </div>
                    <div class="col-md-2 gap-3 mt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-funnel"></i> Filter
                        </button>
                        <a href="<?= base_url('data-pemesanan-khusus') ?>" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-clockwise"></i> Reset
                        </a>
                    </div>
                </div>
            </form>

            <!-- Tambah Data Button -->
            <a href="<?= site_url('data-pemesanan-khusus/create') ?>" class="btn btn-success mb-3">+ Tambah Data</a>

            <!-- Flash Message -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover shadow-sm mt-2">
                    <thead class="table-dark text-center align-middle">
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Nama</th>
                            <th>Nomor HP</th>
                            <th>Nama Acara</th>
                            <th>Produk</th>
                            <th>Tanggal</th>
                            <th>Waktu Pengiriman</th>
                            <th>Catatan</th>
                            <th>Jumlah Tamu</th>
                            <th>Pembayaran</th>
                            <th>Total Harga</th>
                            <th>Status Pemesanan</th>
                            <th>Status Pembayaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($pemesanan)): ?>
                            <?php foreach ($pemesanan as $key => $data): ?>
                                <tr>
                                    <td class="text-center"><?= $key + 1 ?></td>
                                    <td><?= esc($data['username'] ?? '-') ?></td>
                                    <td><?= esc($data['nama'] ?? '-') ?></td>
                                    <td><?= esc($data['nomor_hp'] ?? '-') ?></td>
                                    <td><?= esc($data['nama_acara'] ?? '-') ?></td>
                                    <td><?= esc($data['produk'] ?? '-') ?></td>
                                    <td><?= esc($data['tanggal_pemesanan'] ?? '-') ?></td>
                                    <td><?= esc($data['waktu_pemesanan'] ?? '-') ?></td>
                                    <td><?= esc($data['catatan'] ?? '-') ?></td>
                                    <td><?= esc($data['jumlah_tamu'] ?? 0) ?></td>
                                    <td><?= esc($data['pembayaran'] ?? 0) ?>%</td>
                                    <td>Rp<?= number_format($data['total_harga'] ?? 0, 0, ',', '.') ?></td>
                                    <td><span class="badge bg-info text-dark px-3 py-2 rounded-pill"><?= esc($data['status_pemesanan'] ?? '-') ?></span></td>
                                    <td><span class="badge bg-warning text-dark px-3 py-2 rounded-pill"><?= esc($data['status_pembayaran'] ?? '-') ?></span></td>
                                    <td class="text-center">
                                        <div class="d-flex flex-row gap-1 justify-content-center">
                                            <a href="<?= site_url('data-pemesanan-khusus/edit/' . $data['id_pemesanan']) ?>" class="btn btn-sm btn-warning">Edit</a>
                                            <a href="<?= site_url('data-pemesanan-khusus/delete/' . $data['id_pemesanan']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="15" class="text-center text-muted">Tidak ada data pemesanan khusus ditemukan.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>

<?= $this->endSection(); ?>