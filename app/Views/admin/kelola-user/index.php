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
                    <h2 class="fw-bold text-dark mb-0">Kelola User</h2>
                </div>
            </div>
            <!-- Filter & Search -->
            <form method="GET" action="<?= base_url('/kelola-user'); ?>" class="mb-4 p-3 bg-white rounded shadow-sm border">
                <div class="row g-2 align-items-end">
                    <!-- Search -->
                    <div class="col-md-4">
                        <label for="search" class="form-label fw-semibold">🔍 Cari Pengguna</label>
                        <input type="text" id="search" name="search" class="form-control" placeholder="Nama, username, atau nomor..." value="<?= esc($search ?? '') ?>">
                    </div>

                    <!-- Filter Tanggal -->
                    <div class="col-md-4">
                        <label for="date_from" class="form-label fw-semibold">📅 Dari</label>
                        <input type="date" id="date_from" name="date_from" class="form-control" value="<?= esc($date_from ?? '') ?>">
                    </div>
                    <div class="col-md-4">
                        <label for="date_to" class="form-label fw-semibold">📅 Hingga</label>
                        <input type="date" id="date_to" name="date_to" class="form-control" value="<?= esc($date_to ?? '') ?>">
                    </div>

                    <!-- Tombol Filter & Reset -->
                    <div class="col-md-3 gap-3 mt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-funnel"></i> Filter
                        </button>
                        <a href="<?= base_url('/kelola-user'); ?>" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-clockwise"></i> Reset
                        </a>
                    </div>
                </div>
            </form>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success mt-3"><?= session()->getFlashdata('success'); ?></div>
            <?php endif; ?>

            <!-- Tombol Tambah User -->
            <a href="<?= base_url('/kelola-user/create'); ?>" class="btn btn-success mt-3 mb-3">
                <i class="bi bi-person-plus"></i> Tambah User
            </a>

            <table class="table table-bordered table-hover shadow-sm">
                <thead class="table-dark text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Nomor Telepon</th>
                        <th>Tanggal Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($users)): ?>
                        <?php foreach ($users as $key => $user): ?>
                            <tr>
                                <td><?= $key + 1; ?></td>
                                <td><?= esc($user['name']); ?></td>
                                <td><?= esc($user['username']); ?></td>
                                <td><?= esc($user['phone']); ?></td>
                                <td><?= esc($user['created_at']); ?></td>
                                <td>
                                    <a href="<?= base_url('/kelola-user/edit/' . $user['id']); ?>" class="btn btn-warning">Edit</a>
                                    <form action="<?= base_url('/kelola-user/delete/' . $user['id']); ?>" method="POST" class="d-inline">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="_method" value="post">
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus user ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data pengguna.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </main>
    </div>
</div>

<?= $this->endSection(); ?>