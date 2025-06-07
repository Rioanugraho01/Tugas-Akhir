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
        <!-- Main Content -->
        <main class="col-md-9 col-lg-12 px-md-4 main-content">
            <div class="bg-white border rounded-3 shadow-sm p-4 mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="fw-bold text-dark mb-0">Kalender Ketersediaan</h2>
                </div>
            </div>
            <!-- Filter & Search -->
            <form method="get" class="mb-4 p-3 bg-white rounded shadow-sm border">
                <div class="row g-2 align-items-end">
                    <!-- Search -->
                    <div class="col-md-3">
                        <label for="search" class="form-label fw-semibold">🔍 Cari Tanggal</label>
                        <input type="text" id="search" name="search" class="form-control" placeholder="tanggal">
                    </div>

                    <div class="col-md-3">
                        <label for="status" class="form-label fw-semibold">📂 Status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="">-- Semua --</option>
                            <option value="tersedia" <?= (isset($_GET['status']) && $_GET['status'] == 'tersedia') ? 'selected' : '' ?>>Tersedia</option>
                            <option value="penuh" <?= (isset($_GET['status']) && $_GET['status'] == 'penuh') ? 'selected' : '' ?>>Penuh</option>
                        </select>
                    </div>

                    <!-- Filter Tanggal -->
                    <div class="col-md-3">
                        <label for="date_from" class="form-label fw-semibold">📅 Dari</label>
                        <input type="date" id="date_from" name="date_from" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label for="date_to" class="form-label fw-semibold">📅 Hingga</label>
                        <input type="date" id="date_to" name="date_to" class="form-control">
                    </div>

                    <!-- Tombol Filter & Reset -->
                    <div class="col-md-3 gap-3 mt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-funnel"></i> Filter
                        </button>
                        <a href="/kalender-ketersediaan" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-clockwise"></i> Reset
                        </a>
                    </div>
                </div>
            </form>

            <a href="/kalender-ketersediaan/create" class="btn btn-success mb-3 mt-3">
                <i class="bi bi-calendar-plus"></i> Tambah Tanggal
            </a>

            <table class="table table-bordered table-hover shadow-sm">
                <thead class="table-dark text-center">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ketersediaan as $k): ?>
                        <tr>
                            <td><?= $k['id']; ?></td>
                            <td><?= $k['tanggal']; ?></td>
                            <td>
                                <?php if ($k['status'] === 'tersedia'): ?>
                                    <span class="btn btn-sm btn-success">Tersedia</span>
                                <?php else: ?>
                                    <span class="btn btn-sm btn-danger">Penuh</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="/kalender-ketersediaan/edit/<?= $k['id']; ?>" class="btn btn-warning">Edit</a>
                                <a href="/kalender-ketersediaan/delete/<?= $k['id']; ?>" class="btn btn-danger"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus tanggal ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </main>
    </div>
</div>

<?= $this->endSection(); ?>