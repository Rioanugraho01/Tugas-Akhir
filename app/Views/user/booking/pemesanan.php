<?= $this->extend('layout/app'); ?>
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
    /* tracking progress - versi lebih besar */
    .progress-container {
        display: flex;
        justify-content: space-around;
        align-items: center;
        text-align: center;
        gap: 30px;
        /* Tambahkan jarak antar elemen */
        flex-wrap: wrap;
        padding: 20px 0;
    }

    .progress-step {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        flex: 1;
        min-width: 120px;
    }

    .progress-step::before {
        content: "";
        position: absolute;
        top: 50%;
        left: 50%;
        width: 100%;
        height: 6px;
        background: #ddd;
        z-index: -1;
        transform: translateY(-50%);
    }

    .progress-step:first-child::before {
        width: 50%;
        left: 50%;
    }

    .progress-step:last-child::before {
        width: 50%;
        left: 0;
    }

    .progress-step .icon {
        width: 80px;
        height: 80px;
        background: #ddd;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 36px;
        font-weight: bold;
        margin-bottom: 10px;
        transition: 0.3s;
    }

    .progress-step.completed .icon {
        background: #4CAF50;
        color: white;
    }

    .progress-step.active .icon {
        background: #ffcc00;
        color: white;
    }

    .progress-step p {
        font-size: 1.1rem;
        font-weight: 500;
        margin: 0;
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

                <!-- Content -->
                <div class="card-body">
                    <div class="tab-content" id="nav-tabContent">
                        <!-- FORM PEMESANAN -->
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel">
                            <h3 class="text-center mb-4">Form Pemesanan</h3>
                            <form>
                                <div class="mb-3">
                                    <label class="form-label">Nama</label>
                                    <input type="text" class="form-control" placeholder="Masukkan nama Anda">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nomor HP</label>
                                    <input type="text" class="form-control" placeholder="Masukkan nomor HP">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Produk</label>
                                    <input type="text" class="form-control" placeholder="Contoh: Nasi Tumpeng, Kue Basah, Es Campur">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Pemesanan</label>
                                    <input type="date" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Pengambilan</label>
                                    <input type="date" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="pembayaran" class="form-label">Pembayaran</label>
                                    <select class="form-control" id="pembayaran" name="pembayaran" required>
                                        <option value="" disabled selected>Pilih metode pembayaran</option>
                                        <option value="bayar_nanti">Bayar Nanti</option>
                                        <option value="dp">DP (10% - 30%)</option>
                                        <option value="bayar_langsung">Bayar Langsung</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Catatan Tambahan</label>
                                    <textarea class="form-control" rows="3" placeholder="Masukkan catatan tambahan (opsional)"></textarea>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-custom2">Konfirmasi</button>
                                </div>
                            </form>
                        </div>

                        <!-- Pembayaran -->
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel">
                            <h3 class="text-center mb-4">Metode Pembayaran</h3>

                            <!-- Status Pembayaran -->
                            <div id="statusPembayaran" class="alert text-center alert-warning">
                                <strong>Status:</strong> Menunggu Konfirmasi
                            </div>

                            <!-- Pilihan Bank -->
                            <div class="card shadow-sm p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/51/Bank_Central_Asia.svg/800px-Bank_Central_Asia.svg.png" alt="Logo Bank" width="80">
                                    <div class="ms-3">
                                        <h5 class="mb-0">Bank BCA</h5>
                                        <p class="mb-0">123-456-789</p>
                                        <small>a/n John Doe</small>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-3">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Bank_Mandiri_logo.svg/800px-Bank_Mandiri_logo.svg.png" alt="Logo Bank" width="80">
                                    <div class="ms-3">
                                        <h5 class="mb-0">Bank Mandiri</h5>
                                        <p class="mb-0">987-654-321</p>
                                        <small>a/n John Doe</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Upload Bukti Transfer -->
                            <div class="mt-4">
                                <label class="form-label">Upload Bukti Transfer</label>
                                <input type="file" class="form-control">
                            </div>

                            <!-- Tombol WhatsApp -->
                            <div class="text-center mt-4">
                                <a href="https://wa.me/628123456789" class="btn btn-success">
                                    <i class="bi bi-whatsapp"></i> Konfirmasi via WhatsApp
                                </a>
                            </div>
                        </div>

                        <!-- DETAIL PEMESANAN -->
                        <div class="tab-pane fade" id="nav-contact" role="tabpanel">
                            <h3 class="text-center mb-4">Detail Pemesanan</h3>

                            <form>
                                <div class="mb-3">
                                    <label class="form-label">Nama</label>
                                    <input type="text" class="form-control" value="John Doe" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nomor HP</label>
                                    <input type="text" class="form-control" value="08123456789" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Produk</label>
                                    <input type="text" class="form-control" value="Nasi Tumpeng" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Pemesanan</label>
                                    <input type="text" class="form-control" value="01 Maret 2025" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Pengambilan</label>
                                    <input type="text" class="form-control" value="03 Maret 2025" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Pembayaran</label>
                                    <input type="text" class="form-control" value="DP 20%" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Catatan Tambahan</label>
                                    <textarea class="form-control" rows="3" readonly>Tolong kirim sebelum jam 12 siang.</textarea>
                                </div>
                            </form>

                            <!-- Tracking Progress -->
                            <div class="mt-5">
                                <h5 class="text-center">Status Pemesanan</h5>
                                <div class="progress-container d-flex justify-content-between mt-3">
                                    <!-- Step 1: Proses Pembuatan -->
                                    <div class="progress-step completed">
                                        <div class="icon">
                                            <i class="bi bi-gear-fill"></i> <!-- Ikon gear: proses produksi -->
                                        </div>
                                        <p>Proses Pembuatan</p>
                                    </div>

                                    <!-- Step 2: Proses Packing -->
                                    <div class="progress-step active">
                                        <div class="icon">
                                            <i class="bi bi-box-seam"></i> <!-- Ikon box: proses packing -->
                                        </div>
                                        <p>Proses Packing</p>
                                    </div>

                                    <!-- Step 3: Pesanan Selesai -->
                                    <div class="progress-step">
                                        <div class="icon">
                                            <i class="bi bi-check-circle-fill"></i> <!-- Ikon check: selesai -->
                                        </div>
                                        <p>Pesanan Selesai</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Estimasi Waktu Selesai -->
                            <div class="text-center mt-4">
                                <p><strong>Estimasi Penyelesaian:</strong> 03 Maret 2025, 11:00 WIB</p>
                            </div>

                            <!-- Tombol Pesanan Selesai -->
                            <div class="text-center mt-4">
                                <button class="btn btn-success btn-lg">Pesanan Selesai</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>