<?php
$bolehEdit = ($pemesanan['status_pembayaran'] !== 'terverifikasi - lunas');
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Pemesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <div class="container mt-5">
        <h3>Edit Status Pembayaran</h3>

        <?php if ($bolehEdit): ?>
            <form method="post" action="<?= base_url('data-pemesanan/update/' . $pemesanan['id']) ?>">
                <div class="mb-3">
                    <label>Status Pembayaran</label>
                    <select name="status_pembayaran" class="form-control" required>
                        <option value="terverifikasi - belum lunas" <?= $pemesanan['status_pembayaran'] == 'terverifikasi - belum lunas' ? 'selected' : '' ?>>Belum Lunas</option>
                        <option value="lunas" <?= $pemesanan['status_pembayaran'] == 'terverifikasi - lunas' || $pemesanan['status_pembayaran'] == 'lunas' ? 'selected' : '' ?>>Lunas</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        <?php else: ?>
            <div class="alert alert-success">
                Status pembayaran sudah <strong>terverifikasi - lunas</strong>, tidak bisa diubah lagi.
            </div>
        <?php endif; ?>
    </div>
</body>

</html>
