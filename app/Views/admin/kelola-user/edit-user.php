<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h2>Edit Pengguna</h2>

        <form action="<?= base_url('/kelola-user/update/' . $user['id']); ?>" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" name="name" id="name" class="form-control" value="<?= esc($user['name']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" id="username" class="form-control" value="<?= esc($user['username']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Nomor Telepon</label>
                <input type="text" name="phone" id="phone" class="form-control" value="<?= esc($user['phone']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password (Opsional)</label>
                <input type="password" name="password" id="password" class="form-control">
                <small class="form-text text-danger">Kosongkan jika tidak ingin mengganti password.</small>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="<?= base_url('/kelola-user'); ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>

</html>