<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<style>
    body {
        background: #f4f4f4;
    }

    .sidebar {
        background: #343a40;
        min-height: 100vh;
        padding-top: 20px;
        color: white;
    }

    .sidebar a {
        color: white;
        text-decoration: none;
        display: block;
        padding: 10px;
        transition: 0.3s;
    }

    .sidebar a:hover {
        background: #ffcc00;
        color: black;
        border-radius: 5px;
    }
</style>

<body>
    <div class="container">
        <h2 class="mt-4">Edit Macam Produk</h2>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <form action="<?= base_url('/macam/update/' . $macamProduk['id']) ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label for="gambar" class="form-label">Upload Gambar Baru</label>
                <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">
                <p class="text-danger">*Biarkan kosong jika tidak ingin mengganti gambar*</p>
            </div>

            <div class="mb-3">
                <label class="form-label">Gambar Saat Ini</label>
                <?php if ($macamProduk['gambar']): ?>
                    <br>
                    <img src="<?= base_url('uploads/macam-produk/' . $macamProduk['gambar']) ?>" alt="Gambar Produk" class="img-thumbnail" width="150">
                <?php else: ?>
                    <p class="text-muted">Tidak ada gambar.</p>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="nama" class="form-label">Nama Produk</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= esc($macamProduk['nama']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required><?= esc($macamProduk['deskripsi']) ?></textarea>
            </div>

            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" class="form-control" id="harga" name="harga" value="<?= esc($macamProduk['harga']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="produk_id" class="form-label">Pilih Produk</label>
                <select name="produk_id" id="produk_id" class="form-select" required>
                    <option value="">-- Pilih Produk --</option>
                    <?php foreach ($produkList as $produk): ?>
                        <option value="<?= $produk['id'] ?>" <?= ($macamProduk['produk_id'] == $produk['id']) ? 'selected' : '' ?>>
                            <?= esc($produk['nama']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="<?= base_url('/macam') ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>

</body>

</html>