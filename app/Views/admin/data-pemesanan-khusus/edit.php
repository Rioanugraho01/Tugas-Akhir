<?php
$isLocked = ($pemesanan['status_pemesanan'] === 'selesai' && $pemesanan['status_pembayaran'] === 'lunas');
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Edit Pemesanan Khusus</h2>
        <form action="<?= base_url('data-pemesanan-khusus/update/' . $pemesanan['id_pemesanan']) ?>" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label>Username</label>
                <select name="user_id" class="form-control" required>
                    <option value="">-- Pilih User --</option>
                    <?php foreach ($users as $user): ?>
                        <option value="<?= $user['id'] ?>" <?= $user['id'] == $pemesanan['user_id'] ? 'selected' : '' ?>>
                            <?= esc($user['username']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" value="<?= esc($pemesanan['nama']) ?>" required>
            </div>
            <div class="mb-3">
                <label>Nomor HP</label>
                <input type="text" name="nomor_hp" class="form-control" value="<?= esc($pemesanan['nomor_hp']) ?>" required>
            </div>
            <div class="mb-3">
                <label>Nama Acara</label>
                <input type="text" name="nama_acara" class="form-control" value="<?= esc($pemesanan['nama_acara']) ?>" required>
            </div>
            <div class="mb-3">
                <label>Produk</label>
                <input type="text" name="produk" class="form-control" value="<?= esc($pemesanan['produk']) ?>" required>
            </div>
            <div class="mb-3">
                <label>Tanggal Pemesanan</label>
                <input type="date" name="tanggal_pemesanan" class="form-control" value="<?= esc($pemesanan['tanggal_pemesanan']) ?>" required>
            </div>
            <div class="mb-3">
                <label>Waktu Pemesanan</label>
                <input type="datetime-local" name="waktu_pemesanan" class="form-control"
                    value="<?= isset($pemesanan['waktu_pemesanan']) ? date('Y-m-d\TH:i', strtotime($pemesanan['waktu_pemesanan'])) : '' ?>">
            </div>
            <div class="mb-3">
                <label>Jumlah Tamu</label>
                <input type="number" name="jumlah_tamu" class="form-control" value="<?= esc($pemesanan['jumlah_tamu']) ?>" required>
            </div>
            <div class="mb-3">
                <label>Pembayaran (%)</label>
                <select name="pembayaran" class="form-control" required>
                    <option value="">-- Pilih Persentase --</option>
                    <option value="10" <?= $pemesanan['pembayaran'] == 10 ? 'selected' : '' ?>>10%</option>
                    <option value="20" <?= $pemesanan['pembayaran'] == 20 ? 'selected' : '' ?>>20%</option>
                    <option value="30" <?= $pemesanan['pembayaran'] == 30 ? 'selected' : '' ?>>30%</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Total Harga</label>
                <input type="number" name="total_harga" class="form-control" value="<?= esc($pemesanan['total_harga']) ?>" required>
            </div>
            <div class="mb-3">
                <label>Status Pemesanan</label>
                <select name="status_pemesanan" class="form-control" <?= $isLocked ? 'disabled' : '' ?> required>
                    <option value="">-- Pilih Status Pemesanan --</option>
                    <option value="diterima" <?= $pemesanan['status_pemesanan'] == 'diterima' ? 'selected' : '' ?>>Diterima</option>
                    <option value="proses" <?= $pemesanan['status_pemesanan'] == 'proses' ? 'selected' : '' ?>>Proses</option>
                    <option value="selesai" <?= $pemesanan['status_pemesanan'] == 'selesai' ? 'selected' : '' ?>>Selesai</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Status Pembayaran</label>
                <select name="status_pembayaran" class="form-control" <?= $isLocked ? 'disabled' : '' ?> required>
                    <option value="">-- Pilih Status Pembayaran --</option>
                    <option value="dp" <?= $pemesanan['status_pembayaran'] == 'dp' ? 'selected' : '' ?>>DP</option>
                    <option value="lunas" <?= $pemesanan['status_pembayaran'] == 'lunas' ? 'selected' : '' ?>>Lunas</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Catatan</label>
                <textarea name="catatan" class="form-control"><?= esc($pemesanan['catatan']) ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="<?= base_url('/data-pemesanan-khusus') ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>

</html>