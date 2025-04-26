<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="container mt-4">
    <h2>Edit Produk</h2>
    <form action="<?= base_url('update-produk/' . $produk['id']) ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar Produk</label>
            <input type="file" class="form-control" name="gambar">
            <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar.</small>
            <br>
            <img src="<?= base_url('uploads/produk/' . $produk['gambar']) ?>" alt="Gambar Produk" width="100">
        </div>

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Produk</label>
            <input type="text" class="form-control" name="nama" value="<?= $produk['nama'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi Produk</label>
            <textarea class="form-control" name="deskripsi" rows="4" required><?= $produk['deskripsi'] ?></textarea>
        </div>

        <div class="mb-3">
            <label for="kategori" class="form-label">Kategori</label>
            <select class="form-select" name="kategori" required>
                <option value="regular" <?= ($produk['kategori'] == 'regular') ? 'selected' : '' ?>>Regular</option>
                <option value="khusus" <?= ($produk['kategori'] == 'khusus') ? 'selected' : '' ?>>Khusus</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="<?= base_url('data-produk') ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>