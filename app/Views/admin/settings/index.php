<?= $this->extend('admin/layout/app'); ?>
<?= $this->section('content'); ?>

<style>
    .table thead th {
        vertical-align: middle;
        text-align: center;
    }

    .table tbody td {
        vertical-align: middle;
    }

    .thumbnail-img {
        max-width: 60px;
        max-height: 40px;
        object-fit: contain;
    }

    .action-btns a,
    .action-btns form button {
        margin-right: 5px;
    }

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
                    <h2 class="fw-bold text-dark mb-0">Pengaturan Website</h2>
                </div>
            </div>
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle shadow-sm bg-white">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Email Header</th>
                            <th>Phone Header</th>
                            <th>Alamat Header</th>
                            <th>Logo Navbar</th>
                            <th>Slider Image</th>
                            <th>Facebook</th>
                            <th>WhatsApp</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($settings as $i => $setting): ?>
                            <tr>
                                <td class="text-center"><?= ((int)$i) + 1 ?></td>
                                <td><?= esc($setting['email_header']) ?></td>
                                <td><?= esc($setting['phone_header']) ?></td>
                                <td><?= esc($setting['address_header']) ?></td>
                                <td class="text-center">
                                    <?php if (!empty($setting['logo_navbar'])): ?>
                                        <img src="<?= base_url('img/' . $setting['logo_navbar']) ?>" alt="Logo" class="thumbnail-img" />
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (!empty($setting['slider_image'])): ?>
                                        <img src="<?= base_url('img/' . $setting['slider_image']) ?>" alt="Slider" class="thumbnail-img" />
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if (!empty($setting['social_facebook'])): ?>
                                        <a href="<?= esc($setting['social_facebook']) ?>" target="_blank" class="text-decoration-none">
                                            <i class="bi bi-facebook text-primary"></i> Facebook
                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if (!empty($setting['social_whatsapp'])): ?>
                                        <a href="https://wa.me/<?= preg_replace('/\D/', '', $setting['social_whatsapp']) ?>" target="_blank" class="text-decoration-none">
                                            <i class="bi bi-whatsapp text-success"></i> WhatsApp
                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center action-btns">
                                    <a href="<?= base_url('admin/settings/edit/' . $setting['id']) ?>" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a href="<?= base_url('settings/detail/' . $setting['id']) ?>" class="btn btn-sm btn-info" title="Detail">
                                        <i class="bi bi-info-circle"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>

<?= $this->endSection(); ?>