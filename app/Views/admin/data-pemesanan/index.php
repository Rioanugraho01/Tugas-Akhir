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
        <main class="col-md-9 col-lg-12 px-md-4 main-content">
            <div class="bg-white border rounded-3 shadow-sm p-4 mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="fw-bold text-dark mb-0">Pemesanan Regular</h2>
                </div>
            </div>
            <form method="GET" class="mb-4 p-3 bg-white rounded shadow-sm border">
                <div class="row g-3 align-items-end">
                    <div class="col-md-2">
                        <label for="search" class="form-label fw-semibold">🔍 Cari Nama </label>
                        <input type="text" id="search" name="search" class="form-control" placeholder="Masukkan kata kunci..." value="<?= esc($_GET['search'] ?? '') ?>">
                    </div>
                    <div class="col-md-2">
                        <label for="metode" class="form-label fw-semibold">💳 Metode Pembayaran</label>
                        <select name="metode" id="metode" class="form-select">
                            <option value="">-- Semua Metode --</option>
                            <option value="bayar_sekarang" <?= ($_GET['metode'] ?? '') == 'bayar_sekarang' ? 'selected' : '' ?>>Bayar Sekarang</option>
                            <option value="dp" <?= ($_GET['metode'] ?? '') == 'dp' ? 'selected' : '' ?>>DP</option>
                            <option value="bayar_nanti" <?= ($_GET['metode'] ?? '') == 'bayar_nanti' ? 'selected' : '' ?>>Bayar Nanti</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="status" class="form-label fw-semibold">📦 Status Pemesanan</label>
                        <select id="status" name="status" class="form-select">
                            <option value="">-- Semua Status --</option>
                            <option value="pending" <?= ($_GET['status'] ?? '') == 'pending' ? 'selected' : '' ?>>Pending</option>
                            <option value="diterima" <?= ($_GET['status'] ?? '') == 'diterima' ? 'selected' : '' ?>>Diterima</option>
                            <option value="ditolak" <?= ($_GET['status'] ?? '') == 'ditolak' ? 'selected' : '' ?>>Ditolak</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="progress" class="form-label fw-semibold">🚚 Progress Pemesanan</label>
                        <select id="progress" name="progress" class="form-select">
                            <option value="">-- Semua Progress --</option>
                            <option value="proses pembuatan" <?= ($_GET['progress'] ?? '') == 'proses pembuatan' ? 'selected' : '' ?>>Proses Pembuatan</option>
                            <option value="proses packing" <?= ($_GET['progress'] ?? '') == 'proses packing' ? 'selected' : '' ?>>Proses Packing</option>
                            <option value="siap diambil" <?= ($_GET['progress'] ?? '') == 'siap diambil' ? 'selected' : '' ?>>Siap Diambil</option>
                            <option value="selesai" <?= ($_GET['progress'] ?? '') == 'selesai' ? 'selected' : '' ?>>Selesai</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="date_from" class="form-label fw-semibold">📅 Tanggal Mulai</label>
                        <input type="date" id="date_from" name="date_from" class="form-control" value="<?= esc($_GET['date_from'] ?? '') ?>">
                    </div>
                    <div class="col-md-2">
                        <label for="date_to" class="form-label fw-semibold">📅 Tanggal Sampai</label>
                        <input type="date" id="date_to" name="date_to" class="form-control" value="<?= esc($_GET['date_to'] ?? '') ?>">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-funnel"></i> Filter
                        </button>
                        <a href="<?= base_url('data-pemesanan') ?>" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-clockwise"></i> Reset
                        </a>
                    </div>
                </div>
            </form>

            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php elseif (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php elseif (session()->getFlashdata('info')) : ?>
                <div class="alert alert-info"><?= session()->getFlashdata('info') ?></div>
            <?php endif; ?>

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle shadow-sm">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Nama</th>
                            <th>Macam Produk</th>
                            <th>Tanggal Pesan</th>
                            <th>Tanggal Ambil</th>
                            <th>Total</th>
                            <th>Metode</th>
                            <th>Status Pemesanan</th>
                            <th>Status Pembayaran</th>
                            <th>Progress</th>
                            <th>Aksi</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($pemesanan as $p) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= esc($p['username'] ?? '-') ?></td>
                                <td><?= esc($p['nama']) ?></td>
                                <td><?= esc($p['macam_produk']) ?></td>
                                <td><?= esc($p['tanggal_pemesanan']) ?></td>
                                <td><?= esc($p['tanggal_pengambilan']) ?></td>
                                <td>Rp <?= number_format($p['total_harga'], 0, ',', '.') ?></td>
                                <td><?= esc($p['jenis_pembayaran']) ?></td>
                                <td><?= esc($p['status_pemesanan']) ?></td>
                                <td class="text-center">
                                    <?php if (strpos($p['status_pembayaran'], 'terverifikasi - lunas') !== false) : ?>
                                        <span class="badge bg-success">Terverifikasi - Lunas</span>
                                    <?php elseif (strpos($p['status_pembayaran'], 'terverifikasi - belum lunas') !== false) : ?>
                                        <span class="badge bg-warning text-dark">Terverifikasi - Belum Lunas</span>
                                    <?php elseif ($p['status_pembayaran'] === 'menunggu_verifikasi') : ?>
                                        <span class="badge bg-secondary">Menunggu Verifikasi</span>
                                    <?php else : ?>
                                        <span class="badge bg-light text-dark"><?= esc($p['status_pembayaran']) ?></span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-info text-dark"><?= esc($p['status_progress'] ?? '-') ?></span><br>
                                    <?php if ($p['status_pemesanan'] == 'ditolak' || ($p['status_progress'] ?? '') == 'selesai') : ?>
                                        <button class="btn btn-sm btn-outline-primary mt-2" data-bs-toggle="modal" data-bs-target="#modalProgress<?= $p['id'] ?>">
                                            Edit
                                        </button>
                                    <?php else : ?>
                                        <button class="btn btn-sm btn-outline-primary mt-2" data-bs-toggle="modal" data-bs-target="#modalProgress<?= $p['id'] ?>">
                                            Edit
                                        </button>
                                    <?php endif; ?>
                                </td>
                                <div class="modal fade" id="modalProgress<?= $p['id'] ?>" tabindex="-1" aria-labelledby="progressLabel<?= $p['id'] ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content rounded-4 shadow">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="progressLabel<?= $p['id'] ?>"><i class="bi bi-truck me-2"></i>Ubah Progress Pemesanan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                            </div>
                                            <?php if ($p['status_pemesanan'] == 'ditolak') : ?>
                                                <div class="modal-body">
                                                    <div class="alert alert-danger mb-0" role="alert">
                                                        Progress pemesanan tidak dapat diubah karena pesanan sudah <strong>ditolak</strong>.
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                </div>
                                            <?php elseif (($p['status_progress'] ?? '') == 'selesai') : ?>
                                                <div class="modal-body">
                                                    <div class="alert alert-warning mb-0" role="alert">
                                                        Progress pemesanan sudah <strong>selesai</strong> dan tidak dapat diubah lagi.
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                </div>
                                            <?php else : ?>
                                                <form action="<?= base_url('data-pemesanan/update-progress/' . $p['id']) ?>" method="post">
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="status_progress<?= $p['id'] ?>" class="form-label">Status Progress</label>
                                                            <select name="status_progress" id="status_progress<?= $p['id'] ?>" class="form-select" required>
                                                                <option value="proses pembuatan" <?= $p['status_progress'] == 'proses pembuatan' ? 'selected' : '' ?>>Proses Pembuatan</option>
                                                                <option value="proses packing" <?= $p['status_progress'] == 'proses packing' ? 'selected' : '' ?>>Proses Packing</option>
                                                                <option value="siap diambil" <?= $p['status_progress'] == 'siap diambil' ? 'selected' : '' ?>>Siap Diambil</option>
                                                                <option value="selesai" <?= $p['status_progress'] == 'selesai' ? 'selected' : '' ?>>Selesai</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    </div>
                                                </form>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <td class="text-center">
                                    <div class="d-grid gap-2">
                                        <?php if ($p['status_pemesanan'] == 'pending') : ?>
                                            <a href="<?= base_url('data-pemesanan/konfirmasi/' . $p['id']) ?>" class="btn btn-success btn-sm">Konfirmasi</a>
                                            <a href="<?= base_url('data-pemesanan/tolak/' . $p['id']) ?>" class="btn btn-danger btn-sm">Tolak</a>
                                        <?php elseif ($p['status_pemesanan'] == 'diterima' && $p['status_pembayaran'] == 'menunggu_verifikasi' && !empty($p['bukti_pembayaran'])) : ?>
                                            <a href="<?= base_url('data-pemesanan/verifikasi-pembayaran/' . $p['id']) ?>" class="btn btn-primary btn-sm">Verifikasi</a>
                                        <?php else : ?>
                                            <span>-</span>
                                        <?php endif; ?>
                                        <a href="<?= base_url('data-pemesanan/edit/' . $p['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="d-grid gap-2">
                                        <a href="<?= base_url('data-pemesanan/detail/' . $p['id']) ?>" class="btn btn-info btn-sm">Detail</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>

<?= $this->endSection(); ?>