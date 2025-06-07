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
                    <h2 class="fw-bold text-dark mb-0">Data Pemesanan Khusus</h2>
                </div>
            </div>

            <!-- Notifikasi -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php elseif (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <!-- Pencarian -->
            <div class="card mb-4">
                <div class="card-body">
                    <form method="get" action="<?= base_url('macam') ?>">
                        <div class="row align-items-end">
                            <div class="col-md-3">
                                <label for="search" class="form-label">
                                    <i class="bi bi-search"></i> Cari Nama
                                </label>
                                <input type="text" class="form-control" id="search" name="search" value="<?= esc($search) ?>" placeholder="Masukkan nama macam produk...">
                            </div>

                            <div class="col-md-3">
                                <label for="produk_id" class="form-label">
                                    <i class="bi bi-tags"></i> Produk
                                </label>
                                <select class="form-select" id="produk_id" name="produk_id">
                                    <option value="">-- Semua Produk --</option>
                                    <?php foreach ($produkList as $item): ?>
                                        <option value="<?= $item['id'] ?>" <?= $item['id'] == $produk_id ? 'selected' : '' ?>>
                                            <?= esc($item['nama']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label for="date_from" class="form-label">
                                    <i class="bi bi-calendar-date"></i> Dari Tanggal
                                </label>
                                <input type="date" class="form-control" id="date_from" name="date_from" value="<?= esc($date_from) ?>">
                            </div>

                            <div class="col-md-3">
                                <label for="date_to" class="form-label">
                                    <i class="bi bi-calendar-date-fill"></i> Sampai Tanggal
                                </label>
                                <input type="date" class="form-control" id="date_to" name="date_to" value="<?= esc($date_to) ?>">
                            </div>

                            <div class="col-md-2 gap-3 mt-3">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-funnel"></i> Filter
                                </button>
                                <a href="<?= base_url('macam') ?>" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-clockwise"></i> Reset
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <a href="<?= site_url('macam/create/' . $produk_id) ?>" class="btn btn-success mb-3 mt-3">
                <i class="bi bi-tags"></i> Tambah Macam Produk
            </a>

            <!-- Tabel Macam Produk -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover shadow-sm">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Nama Macam Produk</th>
                            <th>Deskripsi</th>
                            <th>Harga</th>
                            <th>Tanggal Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($macamProduk) > 0): ?>
                            <?php $no = 1;
                            foreach ($macamProduk as $produk): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td>
                                        <?php if ($produk['gambar']): ?>
                                            <img src="<?= base_url('uploads/macam-produk/' . $produk['gambar']) ?>" alt="Gambar Produk" class="img-thumbnail" width="80">
                                        <?php else: ?>
                                            <p class="text-muted">Tidak ada gambar</p>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= esc($produk['nama']) ?></td>
                                    <td><?= esc($produk['deskripsi']) ?></td>
                                    <td>Rp <?= number_format($produk['harga'], 0, ',', '.') ?></td>
                                    <td><?= esc($produk['created_at']); ?></td>
                                    <td>
                                        <a href="<?= base_url('/macam/edit/' . $produk['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="<?= base_url('/macam/delete/' . $produk['id']) ?>" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>

<?= $this->endSection(); ?>