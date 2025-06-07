<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Tambah Pemesanan Khusus</h2>
        <form action="<?= base_url('data-pemesanan-khusus/store') ?>" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label for="user_id">Pilih User</label>
                <select name="user_id" class="form-control" required>
                    <option value="">-- Pilih User --</option>
                    <?php foreach ($users as $user): ?>
                        <option value="<?= $user['id'] ?>"><?= $user['name'] ?> (<?= $user['username'] ?>)</option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Nomor HP</label>
                <input type="text" name="nomor_hp" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Nama Acara</label>
                <input type="text" name="nama_acara" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Produk</label>
                <input type="text" name="produk" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Tanggal Pemesanan</label>
                <input type="date" name="tanggal_pemesanan" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Waktu Pemesanan</label>
                <input type="time" name="waktu_pemesanan" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Jumlah Tamu</label>
                <input type="number" name="jumlah_tamu" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Pembayaran (%)</label>
                <select name="pembayaran" class="form-control" required>
                    <option value="">-- Pilih Persentase --</option>
                    <option value="10">10%</option>
                    <option value="20">20%</option>
                    <option value="30">30%</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Total Harga</label>
                <input type="number" name="total_harga" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Catatan</label>
                <textarea name="catatan" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
</body>

</html>