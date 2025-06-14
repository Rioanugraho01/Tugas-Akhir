<?= $this->extend('user/layout/app'); ?>
<?= $this->section('content'); ?>

<style>
    /* form pemesanan */
    .form-card {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        max-width: 600px;
        margin: auto;
    }

    .form-label {
        font-weight: bold;
        color: #333;
    }

    .konfirmasi-btn {
        background: linear-gradient(135deg, #ffcc00, #ffdb4d);
        color: #fff;
        border: #ffcc00 solid;
        padding: 10px 12px;
        font-size: 1rem;
        border-radius: 5px;
        transition: 0.3s;
    }

    .konfirmasi-btn:hover {
        background: linear-gradient(135deg, #ffdb4d, #ffcc00);
        color: #333;
        border: #ffcc00 solid;
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

    select.form-control {
        appearance: none;
    }
</style>

<div class="container mt-5 mb-5">
    <h2 class="text-center mb-4 fw-bold">Form Pemesanan</h2>
    <div class="card form-card p-4">
        <form action="<?= base_url('form-pemesanan/simpan') ?>" method="POST">
            <?= csrf_field(); ?>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama Anda" required>
            </div>
            <div class="mb-3">
                <label for="nomor_hp" class="form-label">Nomor HP</label>
                <input type="text" class="form-control" id="nomor_hp" name="nomor_hp" placeholder="Contoh: 08123456789" required>
            </div>
            <div class="mb-3">
                <label for="nama_acara" class="form-label">Nama Acara</label>
                <input type="text" class="form-control" id="nama_acara" name="nama_acara" placeholder="Masukkan nama acara (contoh: Ulang Tahun)" required>
            </div>
            <div class="mb-3">
                <label for="produk" class="form-label">Produk</label>
                <input type="text" class="form-control" id="produk" name="produk" placeholder="Masukkan jumlah produk (maksimal: 100)" required>
            </div>
            <div class="mb-3">
                <label for="tanggal_pemesanan" class="form-label">Tanggal Pemesanan</label>
                <input type="date" class="form-control" id="tanggal_pemesanan" name="tanggal_pemesanan" required>
            </div>
            <div class="mb-3">
                <label for="waktu_pemesanan" class="form-label">Waktu Pemesanan</label>
                <input type="time" class="form-control" id="waktu_pemesanan" name="waktu_pemesanan" required>
            </div>
            <div class="mb-3">
                <label for="jumlah_tamu" class="form-label">Jumlah Tamu</label>
                <input type="number" class="form-control" id="jumlah_tamu" name="jumlah_tamu" placeholder="Masukkan jumlah tamu (maksimal: 100)" required>
            </div>
            <div class="mb-3">
                <label for="pembayaran" class="form-label">DP Pembayaran</label>
                <select class="form-control" id="pembayaran" name="pembayaran" required>
                    <option value="" disabled selected>Pilih besar DP</option>
                    <option value="10">10%</option>
                    <option value="20">20%</option>
                    <option value="30">30%</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="catatan" class="form-label">Catatan Tambahan</label>
                <textarea class="form-control" id="catatan" name="catatan" rows="3" placeholder="Tambahkan catatan jika diperlukan"></textarea>
            </div>
            <div class="text-center">
                <button type="submit" class="konfirmasi-btn">Konfirmasi Pemesanan</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>