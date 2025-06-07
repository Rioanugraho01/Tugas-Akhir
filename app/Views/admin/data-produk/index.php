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

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Main Content -->
            <main class="col-md-9 col-lg-12 px-md-4 main-content">
                <div class="bg-white border rounded-3 shadow-sm p-4 mb-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="fw-bold text-dark mb-0">Data Produk</h2>
                    </div>
                </div>

                <!-- Alert Notifikasi -->
                <?php if (session()->getFlashdata('success')) : ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <!-- Filter & Search -->
                <form method="GET" class="mb-4 p-3 bg-white rounded shadow-sm border">
                    <div class="row g-2 align-items-end">
                        <!-- Search -->
                        <div class="col-md-3">
                            <label for="search" class="form-label fw-semibold">🔍 Cari Produk</label>
                            <input type="text" id="search" name="search" class="form-control" placeholder="Masukkan kata kunci..." value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>">
                        </div>

                        <!-- Filter Kategori -->
                        <div class="col-md-3">
                            <label for="kategori" class="form-label fw-semibold">📂 Kategori</label>
                            <select id="kategori" name="kategori" class="form-select">
                                <option value="">Semua Kategori</option>
                                <option value="regular" <?= isset($_GET['kategori']) && $_GET['kategori'] == 'regular' ? 'selected' : '' ?>>Regular</option>
                                <option value="khusus" <?= isset($_GET['kategori']) && $_GET['kategori'] == 'khusus' ? 'selected' : '' ?>>Khusus</option>
                            </select>
                        </div>

                        <!-- Filter Tanggal -->
                        <div class="col-md-3">
                            <label for="date_from" class="form-label fw-semibold">📅 Tanggal Mulai</label>
                            <input type="date" id="date_from" name="date_from" class="form-control" value="<?= isset($_GET['date_from']) ? $_GET['date_from'] : '' ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="date_to" class="form-label fw-semibold">📅 Tanggal Sampai</label>
                            <input type="date" id="date_to" name="date_to" class="form-control" value="<?= isset($_GET['date_to']) ? $_GET['date_to'] : '' ?>">
                        </div>

                        <!-- Tombol Filter & Reset -->
                        <div class="col-md-2 gap-3 mt-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-funnel"></i> Filter
                            </button>
                            <a href="<?= base_url('data-produk') ?>" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-clockwise"></i> Reset
                            </a>
                        </div>
                    </div>
                </form>

                <!-- Tombol Tambah Data -->
                <a href="<?= base_url('/data-produk/create-produk') ?>" class="btn btn-success mt-3">
                    <i class="bi bi-box-seam"></i> Tambah Produk
                </a>

                <table class="table table-bordered table-hover shadow-sm mt-3">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($produk)) : ?>
                            <?php $no = 1;
                            foreach ($produk as $p) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><img src="<?= base_url('/uploads/produk/' . $p['gambar']) ?>" width="50"></td>
                                    <td><?= $p['nama'] ?></td>
                                    <td><?= ucfirst($p['kategori']) ?></td>
                                    <td><?= date('d M Y', strtotime($p['created_at'])) ?></td>
                                    <td>
                                        <a href="<?= base_url('/data-produk/edit-produk/' . $p['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="<?= base_url('delete-produk/' . $p['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data produk.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </main>
        </div>
    </div>

    <?= $this->endSection(); ?>