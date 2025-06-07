<?= $this->extend('user/layout/app'); ?>
<?= $this->section('content'); ?>

<style>
    .main-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .form-container {
        padding: 30px;
    }

    .form-control {
        border: 2px solid #ddd;
        border-radius: 5px;
        padding: 10px;
    }

    .form-control:focus {
        border-color: #ffcc00;
        box-shadow: 0 0 5px rgba(255, 204, 0, 0.7);
    }

    .btn-custom2 {
        background: linear-gradient(135deg, #ffcc00, #ffdb4d);
        color: white;
        border: none;
        font-size: 1rem;
        padding: 10px 16px;
        border-radius: 30px;
        cursor: pointer;
        transition: 0.3s ease-in-out;
        box-shadow: 0px 3px 8px rgba(255, 105, 0, 0.3);
    }

    .btn-custom2:hover {
        background: linear-gradient(135deg, #ffb700, #ffcc33);
    }

    .wa-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        background: #25D366;
        color: white;
        font-weight: bold;
        padding: 10px;
        border-radius: 30px;
        text-decoration: none;
        transition: 0.3s;
        box-shadow: 0px 3px 10px rgba(37, 211, 102, 0.3);
    }

    .wa-btn:hover {
        background: #1ebe5d;
    }

    .wa-btn i {
        font-size: 1.5rem;
        margin-right: 8px;
    }

    /* tracking progress */
    .stepper-wrapper {
        display: flex;
        justify-content: space-between;
        position: relative;
        margin-top: 40px;
        margin-bottom: 40px;
    }

    .stepper-item {
        position: relative;
        text-align: center;
        flex: 1;
    }

    .stepper-item:not(:last-child)::after {
        content: '';
        position: absolute;
        top: 30px;
        right: -50%;
        width: 100%;
        height: 4px;
        background-color: #dee2e6;
        z-index: 0;
        transition: background-color 0.3s;
    }

    .stepper-item.completed:not(:last-child)::after {
        background-color: #198754;
    }

    .stepper-icon {
        width: 60px;
        height: 60px;
        background-color: #dee2e6;
        color: #6c757d;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        margin-bottom: 8px;
        z-index: 1;
        position: relative;
        transition: all 0.3s;
    }

    .stepper-item.completed .stepper-icon,
    .stepper-item.active .stepper-icon {
        background-color: #198754;
        color: white;
    }

    .stepper-label {
        font-size: 0.9rem;
        font-weight: 500;
    }

    @media (max-width: 768px) {
        .stepper-wrapper {
            flex-direction: column;
            gap: 20px;
        }

        .stepper-item::after {
            display: none;
        }
    }
</style>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card main-card">
                <!-- Navbar dalam Card -->
                <nav class="card-header bg-light">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab">Pemesanan</button>
                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab">Pembayaran</button>
                        <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab">Detail Pemesanan</button>
                    </div>
                </nav>

                <div class="card-body">
                    <div class="tab-content" id="nav-tabContent">
                        <!-- FORM PEMESANAN -->
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel">
                            <h3 class="text-center mb-4">Form Pemesanan</h3>
                            <form action="/pemesanan/konfirmasi" method="post">
                                <?= csrf_field() ?>
                                <input type="hidden" name="macam_produk_id" value="<?= esc($cart[0]['id']) ?>">
                                <input type="hidden" name="produk_id" value="<?= esc($produk['id'] ?? '') ?>">
                                <input type="hidden" name="total_harga" value="<?= $total ?>">
                                <div class="mb-3">
                                    <label class="form-label">Nama</label>
                                    <input type="text" class="form-control" name="nama" placeholder="Masukkan nama Anda" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nomor HP</label>
                                    <input type="text" class="form-control" name="no_hp" placeholder="Masukkan nomor HP" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Macam Produk</label>
                                    <textarea class="form-control" name="macam_produk" readonly><?= is_array($cart) ? implode(", ", array_map(fn($c) => $c['nama'] . " (" . $c['jumlah'] . "x)", $cart)) : '' ?></textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Total Pemesanan</label>
                                    <input type="text" class="form-control" name="total_harga_display" value="<?= number_format($total, 2, ',', '.') ?>" readonly>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="tanggal_pemesanan">Tanggal Pemesanan</label>
                                    <input type="date" class="form-control" id="tanggal_pemesanan" name="tanggal_pemesanan">
                                    <small class="text-danger"> Minimal Pemesanan 2 - 5 Hari </small>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="tanggal_pengambilan">Tanggal Pengambilan</label>
                                    <input type="date" class="form-control" id="tanggal_pengambilan" name="tanggal_pengambilan">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="waktu_pengambilan">Waktu Pengambilan</label>
                                    <input type="time" class="form-control" id="waktu_pengambilan" name="waktu_pengambilan" required>
                                </div>

                                <div class="mb-3">
                                    <label for="jenis_pembayaran" class="form-label">Metode Pembayaran</label>
                                    <select name="jenis_pembayaran" id="jenis_pembayaran" class="form-select">
                                        <?php $jenis = $pemesanan['jenis_pembayaran'] ?? ''; ?>
                                        <option value="bayar_sekarang" <?= $jenis == 'bayar_sekarang' ? 'selected' : '' ?>>Bayar Sekarang</option>
                                        <option value="dp" <?= $jenis == 'dp' ? 'selected' : '' ?>>DP (30%)</option>
                                        <option value="bayar_nanti" <?= $jenis == 'bayar_nanti' ? 'selected' : '' ?>>Bayar Nanti</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Catatan Tambahan</label>
                                    <textarea class="form-control" name="catatan" rows="3" placeholder="Masukkan catatan tambahan (opsional)"></textarea>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-custom2">Konfirmasi</button>
                                </div>
                            </form>
                        </div>

                        <!-- Pembayaran -->
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel">
                            <h3 class="text-center mb-4">Metode Pembayaran</h3>
                            <?php if (($pemesanan['status_pemesanan'] ?? null) === 'pending'): ?>
                                <div class="alert alert-info text-center alert-dismissible fade show" role="alert" id="statusAlert">
                                    Pesanan Anda telah dikirim, mohon tunggu admin menerima pesanan Anda.
                                </div>

                            <?php elseif (isset($pemesanan['status_pemesanan']) && $pemesanan['status_pemesanan'] === 'ditolak'): ?>
                                <div class="alert alert-danger text-center alert-dismissible fade show" role="alert" id="statusAlert">
                                    Maaf, pesanan Anda telah ditolak oleh admin.
                                </div>

                            <?php elseif (
                                isset($pemesanan['status_pemesanan'], $pemesanan['jenis_pembayaran']) &&
                                $pemesanan['status_pemesanan'] === 'diterima' &&
                                $pemesanan['jenis_pembayaran'] !== 'bayar_nanti' &&
                                empty($pemesanan['bukti_pembayaran'])
                            ): ?>
                                <div class="alert alert-success text-center alert-dismissible fade show" role="alert" id="statusAlert">
                                    Pesanan Anda telah diterima. Silakan melakukan pembayaran sesuai metode yang Anda pilih.
                                </div>

                            <?php elseif (
                                isset($pemesanan['status_pembayaran']) &&
                                $pemesanan['status_pembayaran'] === 'menunggu_verifikasi' &&
                                !empty($pemesanan['bukti_pembayaran'])
                            ): ?>
                                <div class="alert alert-warning text-center alert-dismissible fade show" role="alert" id="statusAlert">
                                    Bukti pembayaran Anda sudah dikirim. Silakan tunggu verifikasi dari admin.
                                </div>

                            <?php elseif (
                                isset($pemesanan['jenis_pembayaran'], $pemesanan['status_pemesanan']) &&
                                $pemesanan['jenis_pembayaran'] === 'bayar_nanti' &&
                                $pemesanan['status_pemesanan'] === 'diterima'
                            ): ?>
                                <div class="alert alert-warning text-center alert-dismissible fade show" role="alert" id="statusAlert">
                                    Silakan lakukan pembayaran saat pengambilan.
                                </div>

                            <?php elseif (
                                isset($pemesanan['status_pembayaran']) &&
                                strpos($pemesanan['status_pembayaran'], 'terverifikasi - lunas') !== false
                            ): ?>
                                <div class="alert alert-success text-center alert-dismissible fade show" role="alert" id="statusAlert">
                                    Pembayaran Anda telah diverifikasi dan pesanan Anda telah lunas. Terima kasih!
                                </div>

                            <?php elseif (
                                isset($pemesanan['status_pembayaran'], $pemesanan['jenis_pembayaran']) &&
                                strpos($pemesanan['status_pembayaran'], 'terverifikasi - belum lunas') !== false &&
                                $pemesanan['jenis_pembayaran'] !== 'bayar_nanti'
                            ): ?>
                                <div class="alert alert-warning text-center alert-dismissible fade show" role="alert" id="statusAlert">
                                    Pembayaran DP Anda telah diverifikasi. Silakan lunasi sisa pembayaran saat pengambilan.
                                </div>

                            <?php endif; ?>
                            <div class="card shadow-sm p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="<?= base_url('img/bri.png') ?>" width="80">
                                    <div class="ms-3">
                                        <h5 class="mb-0">Bank BRI</h5>
                                        <p class="mb-0">5221-8402-3848-6501</p>
                                        <small>a/n Sakriman</small>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-3">
                                    <img src="<?= base_url('img/shopee.png') ?>" width="80">
                                    <div class="ms-3">
                                        <h5 class="mb-0">ShoopePay</h5>
                                        <p class="mb-0">6282143390808</p>
                                        <small>a/n sitiima675</small>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <label class="form-label">Total Pembayaran <strong>(DP 30%)</strong></label>
                                <input type="text" class="form-control" value="<?= 'Rp. ' . number_format(($pemesanan['total_harga'] ?? 0) * (($pemesanan['persentase_dp'] ?? 30) / 100), 0, ',', '.') ?>" readonly>
                            </div>
                            <?php if (!empty($pemesanan) && isset($pemesanan['id']) && $pemesanan['status_pemesanan'] == 'diterima'): ?>
                                <form action="<?= base_url('pemesanan/uploadBukti/' . $pemesanan['id']) ?>" method="post" enctype="multipart/form-data" class="mt-4">
                                    <label for="bukti_pembayaran" class="form-label">Upload Bukti Pembayaran</label>
                                    <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" class="form-control" required>
                                    <button type="submit" class="btn btn-primary mt-2">Upload</button>
                                </form>
                            <?php elseif (!empty($pemesanan) && isset($pemesanan['status_pemesanan']) && $pemesanan['status_pemesanan'] != 'diterima'): ?>
                                <div class="alert alert-warning mt-4 text-center">Upload bukti hanya tersedia jika pesanan Anda sudah diterima.</div>
                            <?php else: ?>
                                <div class="alert alert-danger mt-4">Data pemesanan tidak ditemukan.</div>
                            <?php endif; ?>
                        </div>

                        <!-- DETAIL PEMESANAN -->
                        <div class="tab-pane fade" id="nav-contact" role="tabpanel">
                            <h3 class="text-center mb-4">Detail Pemesanan</h3>
                            <?php if (!empty($pemesanan) && strpos($pemesanan['status_pembayaran'], 'terverifikasi') !== false): ?>
                                <form>
                                    <div class="mb-3">
                                        <label class="form-label">Nama</label>
                                        <input type="text" class="form-control" value="<?= esc($pemesanan['nama'] ?? '') ?>" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Nomor HP</label>
                                        <input type="text" class="form-control" value="<?= esc($pemesanan['no_hp'] ?? '') ?>" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Macam Produk</label>
                                        <textarea class="form-control" name="macam_produk" readonly><?= is_array($cart) ? implode(", ", array_map(fn($c) => $c['nama'] . " (" . $c['jumlah'] . "x)", $cart)) : '' ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Total Pemesanan</label>
                                        <input type="text" class="form-control" value="<?= 'Rp. ' . number_format($pemesanan['total_harga'] ?? 0, 0, ',', '.') ?>" readonly>
                                    </div>
                                    <?php
                                    $total = $pemesanan['total_harga'] ?? 0;
                                    $persentase_dp = $pemesanan['persentase_dp'] ?? 30;
                                    $dp = $total * ($persentase_dp / 100);
                                    $sisa = $total - $dp;
                                    ?>
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Total Pembayaran
                                            <strong>(DP <?= isset($pemesanan['persentase_dp']) ? $pemesanan['persentase_dp'] : 30 ?>%)</strong>
                                        </label>
                                        <?php if (!empty($pemesanan) && isset($pemesanan['jumlah_dp'])): ?>
                                            <input type="text" class="form-control" value="<?= 'Rp. ' . number_format($pemesanan['jumlah_dp'], 0, ',', '.') ?>" readonly>
                                        <?php else: ?>
                                            <input type="text" class="form-control" value="Rp. -" readonly>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Kekurangan Pembayaran <strong>(Berlaku Untuk DP)</strong></label>
                                        <?php if (!empty($pemesanan) && isset($pemesanan['sisa_pembayaran'])): ?>
                                            <input type="text" class="form-control" value="<?= 'Rp. ' . number_format($pemesanan['sisa_pembayaran'], 0, ',', '.') ?>" readonly>
                                        <?php else: ?>
                                            <input type="text" class="form-control" value="Rp. -" readonly>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal Pemesanan</label>
                                        <input type="text" class="form-control" value="<?= esc($pemesanan['tanggal_pemesanan'] ?? '') ?>" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal Pengambilan</label>
                                        <input type="text" class="form-control" value="<?= esc($pemesanan['tanggal_pengambilan'] ?? '') ?>" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Waktu Pengambilan</label>
                                        <input type="text" class="form-control" value="<?= esc($pemesanan['waktu_pengambilan'] ?? '') ?>" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Jenis Pembayaran</label>
                                        <input type="text" class="form-control" value="<?= esc($pemesanan['jenis_pembayaran'] ?? '') ?>" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Catatan Tambahan</label>
                                        <textarea class="form-control" rows="3" readonly><?= esc($pemesanan['catatan'] ?? '') ?></textarea>
                                    </div>
                                </form>
                            <?php else: ?>
                                <div class="alert alert-info text-center">
                                    <strong>Informasi:</strong> Detail pemesanan akan ditampilkan setelah pembayaran Anda diverifikasi oleh admin.
                                </div>
                            <?php endif; ?>

                            <?php
                            $show_progress = false;
                            $valid_status_pembayaran = ['terverifikasi - lunas', 'terverifikasi - belum lunas'];
                            if (isset($pemesanan['status_pembayaran']) && in_array($pemesanan['status_pembayaran'], $valid_status_pembayaran)) {
                                $show_progress = true;
                            }
                            ?>

                            <?php if ($show_progress): ?>
                                <div class="container my-5">
                                    <h5 class="mb-4 text-center">Progress Pemesanan</h5>
                                    <div class="stepper-wrapper">
                                        <?php
                                        $steps = [
                                            'proses pembuatan' => ['label' => 'Proses Pembuatan', 'icon' => 'bi-hammer'],
                                            'proses packing' => ['label' => 'Proses Packing', 'icon' => 'bi-box-seam'],
                                            'siap diambil' => ['label' => 'Siap Diambil', 'icon' => 'bi-truck'],
                                            'selesai' => ['label' => 'Selesai', 'icon' => 'bi-check-circle'],
                                        ];
                                        $status_progress = $pemesanan['status_progress'] ?? 'proses pembuatan';
                                        $progressIndex = array_search($status_progress, array_keys($steps));
                                        $i = 0;
                                        foreach ($steps as $key => $step) {
                                            $status = '';
                                            if ($i < $progressIndex) $status = 'completed';
                                            elseif ($i == $progressIndex) $status = 'active';
                                            echo '<div class="stepper-item ' . $status . '">';
                                            echo '<div class="stepper-icon"><i class="bi ' . $step['icon'] . '"></i></div>';
                                            echo '<div class="stepper-label">' . $step['label'] . '</div>';
                                            echo '</div>';
                                            $i++;
                                        }
                                        ?>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="alert alert-info text-center">
                                    Progress pemesanan akan muncul setelah pembayaran diverifikasi.
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function hitungTotal() {
        const select = document.querySelector('select[name="macam_produk_id"]');
        const harga = parseInt(select.options[select.selectedIndex].getAttribute('data-harga'));
        const jumlah = parseInt(document.querySelector('input[name="jumlah"]').value);
        const total = harga * jumlah;
        document.getElementById('total_harga').value = total;
    }

    function previewBukti(input) {
        if (input.files && input.files[0]) {
            document.getElementById('preview-nama-bukti').innerText = "File: " + input.files[0].name;
        }
    }
    document.addEventListener("DOMContentLoaded", function() {
        const urlParams = new URLSearchParams(window.location.search);
        const tab = urlParams.get('tab');
        if (tab) {
            const triggerEl = document.querySelector(`#nav-${tab}-tab`);
            if (triggerEl) {
                new bootstrap.Tab(triggerEl).show();
            }
        }
    });

    document.getElementById('tanggal_pemesanan').addEventListener('change', function() {
        const pemesananDate = new Date(this.value);
        if (!this.value) return;
        const minPengambilan = new Date(pemesananDate);
        minPengambilan.setDate(minPengambilan.getDate() + 2);
        const maxPengambilan = new Date(pemesananDate);
        maxPengambilan.setDate(maxPengambilan.getDate() + 5);
        const pengambilanInput = document.getElementById('tanggal_pengambilan');
        pengambilanInput.min = minPengambilan.toISOString().split('T')[0];
        pengambilanInput.max = maxPengambilan.toISOString().split('T')[0];
        pengambilanInput.value = '';
    });

    document.addEventListener('DOMContentLoaded', () => {
        const alertBox = document.getElementById('statusAlert');
        if (alertBox) {
            setTimeout(() => {
                alertBox.classList.remove('show');
                alertBox.classList.add('hide');
                alertBox.style.transition = "opacity 0.5s ease";
                alertBox.style.opacity = 0;
                setTimeout(() => alertBox.remove(), 500);
            }, 15000);
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<?= $this->endSection(); ?>