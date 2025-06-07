<?= $this->extend('user/layout/app'); ?>
<?= $this->section('content') ?>

<style>
    .btn-custom2 {
        background: linear-gradient(135deg, #ffcc00, #ffdb4d);
        color: white;
        border: none;
        font-size: 1rem;
        padding: 10px 16px;
        border-radius: 10px;
        cursor: pointer;
        transition: 0.3s ease-in-out;
        box-shadow: 0px 3px 8px rgba(255, 105, 0, 0.3);
    }

    .btn-custom2:hover {
        background: linear-gradient(135deg, #ffb700, #ffcc33);
    }
</style>

<div class="container py-5">
    <div class="card shadow rounded">
        <div class="card-body">
            <h3 class="mb-4 text-center">Edit Profile</h3>

            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('errors')) : ?>
                <div class="alert alert-danger">
                    <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                        <div><?= $error ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form method="post" action="<?= base_url('/update-profile'); ?>">
                <?= csrf_field(); ?>
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" name="name" class="form-control" value="<?= esc($user['name']) ?>">
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" value="<?= esc($user['username']) ?>">
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Nomor Telepon</label>
                    <input type="text" name="phone" class="form-control" value="<?= esc($user['phone']) ?>">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password Baru (Opsional)</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Konfirmasi Password (Opsional)</label>
                    <input type="password" name="confirm_password" class="form-control">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-custom2">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>