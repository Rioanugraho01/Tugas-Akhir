<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Pemesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <h2 class="text-center mt-5">Detail Pemesanan</h2>
    <div class="container py-4">
        <div class="card shadow-lg border-1 rounded-4 px-4 py-4" style="background-color: #fefefe;">
            <div class="row g-4">
                <!-- Kolom 1: Info Pemesan -->
                <div class="col-md-4">
                    <div class="card border-1 shadow-sm rounded-3 h-100">
                        <div class="card-body">
                            <h5 class="card-title text-primary"><i class="bi bi-person-circle me-2"></i>Pemesan</h5>
                            <hr>
                            <p><strong>Username:</strong><br> <?= esc($pemesanan['username']) ?></p>
                            <p><strong>Nama:</strong><br> <?= esc($pemesanan['nama']) ?></p>
                            <p><strong>Nomor HP:</strong><br> <?= esc($pemesanan['no_hp']) ?></p>
                            <p><strong>Catatan:</strong><br> <?= esc($pemesanan['catatan'] ?? '-') ?></p>
                        </div>
                    </div>
                </div>

                <!-- Kolom 2: Info Produk -->
                <div class="col-md-4">
                    <div class="card border-1 shadow-sm rounded-3 h-100">
                        <div class="card-body">
                            <h5 class="card-title text-success"><i class="bi bi-box-seam me-2"></i>Produk</h5>
                            <hr>
                            <p><strong>Macam Produk:</strong><br> <?= esc($pemesanan['macam_produk']) ?></p>
                            <p><strong>Tanggal Pesan:</strong><br> <?= esc($pemesanan['tanggal_pemesanan']) ?></p>
                            <p><strong>Tanggal Ambil:</strong><br> <?= esc($pemesanan['tanggal_pengambilan']) ?></p>
                            <p><strong>Waktu Pengambilan:</strong><br> <?= esc($pemesanan['waktu_pengambilan']) ?></p>
                        </div>
                    </div>
                </div>

                <!-- Kolom 3: Pembayaran -->
                <div class="col-md-4">
                    <div class="card border-1 shadow-sm rounded-3 h-100">
                        <div class="card-body">
                            <h5 class="card-title text-dark"><i class="bi bi-cash-stack me-2"></i>Pembayaran</h5>
                            <hr>
                            <p><strong>Total:</strong><br> Rp <?= number_format($pemesanan['total_harga'], 0, ',', '.') ?></p>
                            <p><strong>Metode:</strong><br> <?= esc($pemesanan['jenis_pembayaran']) ?></p>
                            <p><strong>DP:</strong><br> Rp <?= number_format($pemesanan['jumlah_dp'], 0, ',', '.') ?> (<?= $pemesanan['persentase_dp'] ?>%)</p>
                            <p><strong>Sisa:</strong><br> Rp <?= number_format($pemesanan['sisa_pembayaran'], 0, ',', '.') ?></p>
                        </div>
                    </div>
                </div>

                <!-- Status -->
                <div class="col-md-6">
                    <div class="card border-1 shadow-sm rounded-3 h-100">
                        <div class="card-body">
                            <h5 class="card-title"><i class="bi bi-flag me-2"></i>Status</h5>
                            <hr>
                            <p><strong>Status Pemesanan:</strong><br>
                                <span class="badge bg-dark"><?= esc($pemesanan['status_pemesanan']) ?></span>
                            </p>
                            <p><strong>Status Pembayaran:</strong><br>
                                <?php if (strpos($pemesanan['status_pembayaran'], 'lunas') !== false) : ?>
                                    <span class="badge bg-success"><i class="bi bi-check-circle-fill me-1"></i> <?= esc($pemesanan['status_pembayaran']) ?></span>
                                <?php elseif (strpos($pemesanan['status_pembayaran'], 'belum lunas') !== false) : ?>
                                    <span class="badge bg-warning text-dark"><i class="bi bi-exclamation-circle-fill me-1"></i> <?= esc($pemesanan['status_pembayaran']) ?></span>
                                <?php else : ?>
                                    <span class="badge bg-secondary"><?= esc($pemesanan['status_pembayaran']) ?></span>
                                <?php endif; ?>
                            </p>
                            <p><strong>Status Progress:</strong><br>
                                <span class="badge bg-info text-dark"><i class="bi bi-truck me-1"></i> <?= esc($pemesanan['status_progress']) ?></span>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Bukti Pembayaran -->
                <div class="col-md-6">
                    <div class="card border-1 shadow-sm rounded-3 h-100">
                        <div class="card-body">
                            <h5 class="card-title"><i class="bi bi-file-earmark-image me-2"></i>Bukti Pembayaran</h5>
                            <hr>
                            <?php if (!empty($pemesanan['bukti_pembayaran'])) : ?>
                                <a href="<?= base_url('uploads/bukti/' . $pemesanan['bukti_pembayaran']) ?>" target="_blank">
                                    <img src="<?= base_url('uploads/bukti/' . $pemesanan['bukti_pembayaran']) ?>" alt="Bukti" class="img-fluid rounded shadow-sm border">
                                </a>
                            <?php else : ?>
                                <p class="text-muted">Tidak tersedia.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <!-- Tombol -->
                <div class="col-12 text-end mt-4">
                    <a href="<?= base_url('data-pemesanan') ?>" class="btn btn-outline-primary">
                        <i class="bi bi-arrow-left-circle me-1"></i> Kembali ke Data Pemesanan
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>