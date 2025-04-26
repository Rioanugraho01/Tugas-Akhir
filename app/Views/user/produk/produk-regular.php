<?= $this->extend('layout/app'); ?>
<?= $this->section('content'); ?>

<style>
    /* Slider */
    .carousel {
        width: 100%;
    }

    .carousel-item {
        height: 500px;
    }

    .carousel-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Posisi teks di tengah gambar */
    .carousel-caption {
        position: absolute;
        top: 52%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        color: white;
        z-index: 10;
        width: 80%;
    }

    .carousel-caption h2 {
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .carousel-caption p {
        font-size: 1.2rem;
    }

    /* Bagian Produk Kami */
    .produk-section {
        padding: 80px 0;
        text-align: center;
    }

    .produk-title {
        font-size: 2.3rem;
        font-weight: bold;
        color: black;
    }

    /* Kartu Produk */
    .produk-card {
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease-in-out;
    }

    .produk-card:hover {
        transform: translateY(-5px);
    }

    /* Gambar Produk */
    .produk-img {
        width: 100%;
        aspect-ratio: 4 / 3;
        object-fit: contain;
        background-color: #f9f9f9;
        border-bottom: 3px solid #ffcc00;
        padding: 10px;
    }


    /* Konten Produk */
    .produk-body {
        padding: 20px;
    }

    .produk-body h5 {
        font-size: 1.2rem;
        font-weight: bold;
        color: #333;
    }

    .produk-body p {
        font-size: 1rem;
        color: #666;
    }

    /* Tombol Produk */
    .produk-btn {
        background: #333;
        color: #fff;
        border: 2px solid #333;
        padding: 8px 15px;
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }

    .produk-btn:hover {
        background: #ffcc00;
        color: #333;
        border-color: #ffcc00;
    }

    /* Tombol Lihat Lainnya */
    .lihat-lainnya {
        border: 2px solid #333;
        padding: 12px 25px;
        font-size: 1rem;
        font-weight: bold;
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }

    .lihat-lainnya:hover {
        background: #ffcc00;
        color: #333;
        border-color: #ffcc00;
    }

    /* dropdown */
    .dropdown-toggle {
        background: #333;
        color: #fff;
        border: 2px solid #333;
        padding: 8px 15px;
        border-radius: 5px;
        transition: 0.3s;
    }

    .dropdown-toggle:hover {
        background: #ffcc00;
        color: #333;
        border-color: #ffcc00;
    }

    .dropdown-menu {
        border-radius: 5px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    }

    .dropdown-item {
        transition: 0.3s;
    }

    .dropdown-item:hover {
        background: #ffcc00;
        color: #333;
    }

    /* total */
    .produk-footer {
        background: #ffffff;
        padding: 12px;
        margin-top: 10px;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        transition: 0.3s ease-in-out;
    }

    .harga-container {
        background: #f9f9f9;
        padding: 8px;
        border-radius: 6px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 1rem;
        font-weight: bold;
        color: #444;
        margin-bottom: 10px;
    }

    .label-harga {
        color: #666;
        font-weight: bold;
    }

    .harga-text {
        color: #ffcc00;
        font-size: 1.2rem;
    }

    .pesan-sekarang-btn {
        background: linear-gradient(135deg, #ffcc00, #ffdb4d);
        color: white;
        border: none;
        font-size: 0.95rem;
        font-weight: bold;
        padding: 10px 16px;
        border-radius: 30px;
        cursor: pointer;
        transition: 0.3s ease-in-out;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        box-shadow: 0px 3px 8px rgba(255, 105, 0, 0.3);
        width: 100%;
        text-decoration: none;
        /* Menghilangkan garis bawah */
        text-align: center;
    }

    .pesan-sekarang-btn:hover {
        transform: translateY(-3px);
        background: linear-gradient(135deg, #ffdb4d, #ffcc00);
        color: black;
    }

    .pesan-sekarang-btn i {
        font-size: 1rem;
        transition: 0.3s;
    }

    .pesan-sekarang-btn:hover i {
        transform: translateX(4px);
    }

    /* Responsiveness */
    @media (max-width: 768px) {
        .carousel-item {
            height: 400px;
        }

        .carousel-caption h2 {
            font-size: 2rem;
        }

        .carousel-caption p {
            font-size: 1rem;
        }
    }

    @media (max-width: 576px) {
        .carousel-item {
            height: 350px;
        }

        .carousel-caption h2 {
            font-size: 1.8rem;
        }

        .carousel-caption p {
            font-size: 0.9rem;
        }
    }
</style>

<!-- Slider -->
<div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="<?= base_url('img/beranda.jpeg'); ?>" alt="Slider 1">
            <div class="carousel-caption">
                <h2>Produk Ima Catering</h2>
                <p>Pilih Produk Kesukaanmu</p>
            </div>
        </div>
    </div>
</div>

<!-- Produk Kami -->
<section class="produk-section">
    <div class="container">
        <h3 class="produk-title">Produk Regular</h3>
        <hr>
        <div class="dropdown mb-4 d-flex justify-content-end gap-2">
            <?php if ($kategori == 'khusus'): ?>
                <button class="pesan-btn btn btn-primary" onclick="window.location.href='form-pemesanan'">
                    Form Pemesanan
                </button>
            <?php endif; ?>
            <button class="dropdown-toggle produk-btn btn btn-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Pilihan
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="<?= base_url('produk-khusus') ?>">Produk Khusus</a></li>
                <li><a class="dropdown-item" href="<?= base_url('produk-regular') ?>">Produk Regular</a></li>
            </ul>
        </div>
        <div class="row">
            <?php foreach ($produk as $item) : ?>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="produk-card">
                        <img src="<?= base_url('uploads/produk/' . $item['gambar']); ?>" alt="<?= $item['nama']; ?>" class="produk-img">
                        <div class="produk-body">
                            <h5><?= $item['nama']; ?></h5>
                            <p><?= $item['deskripsi']; ?></p>
                            <a href="<?= base_url('macam-produk/' . $item['id']) ?>" class="produk-btn text-decoration-none">Lihat Produk</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Tampilkan hanya jika sudah login -->
        <?php if (session()->has('user_id')) : ?>
            <div class="produk-footer">
                <div class="harga-container">
                    <span class="label-harga">Total Harga:</span>
                    <span class="harga-text">Rp 150.000</span>
                </div>
                <a href="<?= base_url('pemesanan'); ?>" class="text-decoration-none">
                    <button class="pesan-sekarang-btn">
                        <span>Pesan Sekarang</span>
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>

<?= $this->endSection(); ?>