<?= $this->extend('layout/app'); ?>
<?= $this->section('content'); ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">

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

    /* Bagian Tentang Kami */
    .about-section {
        padding: 80px 0;
        background-color: #f8f9fa;
        text-align: center;
    }

    .about-title {
        font-size: 2.5rem;
        font-weight: bold;
        color: #333;
    }

    .about-text {
        font-size: 1.2rem;
        color: #666;
        margin-top: 10px;
    }

    /* Ikon */
    .about-icons {
        display: flex;
        justify-content: center;
        margin-top: 30px;
        gap: 40px;
    }

    .about-icons div {
        text-align: center;
    }

    .about-icons i {
        font-size: 3rem;
        color: #ffcc00;
    }

    .about-icons p {
        margin-top: 10px;
        font-size: 1rem;
        color: #333;
    }

    /* Bagian Produk Kami */
    .produk-section {
        padding: 80px 0;
        background-color: #333;
        text-align: center;
    }

    .produk-title {
        font-size: 2.5rem;
        font-weight: bold;
        color: #fff;
        margin-bottom: 30px;
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
        border: #ffcc00 solid;
        padding: 12px 25px;
        font-size: 1rem;
        font-weight: bold;
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
        color: white;
        background: linear-gradient(135deg, #ffcc00, #ffdb4d);
    }

    .lihat-lainnya:hover {
        background: linear-gradient(135deg, #ffdb4d, #ffcc00);
        color: black;
    }

    /* Bagian Maps */
    .maps-section {
        padding: 80px 0;
        background-color: #f8f9fa;
        text-align: center;
    }

    .maps-title {
        font-size: 2.5rem;
        font-weight: bold;
        color: #333;
        margin-bottom: 10px;
    }

    .maps-text {
        font-size: 1.2rem;
        color: #666;
        margin-bottom: 20px;
    }

    .maps-container {
        max-width: 100%;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
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

        .about-title {
            font-size: 2rem;
        }

        .about-text {
            font-size: 1rem;
        }

        .about-icons {
            gap: 20px;
        }

        .about-item i {
            font-size: 2.5rem;
        }

        .about-item p {
            font-size: 0.9rem;
        }

        .produk-title {
            font-size: 2rem;
        }

        .maps-title {
            font-size: 2rem;
        }

        .maps-text {
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

        .about-icons {
            flex-direction: column;
            align-items: center;
        }

        .about-item {
            max-width: 100%;
        }

        .about-item i {
            font-size: 2.2rem;
        }

        .about-item p {
            font-size: 0.85rem;
        }

        .produk-title {
            font-size: 1.8rem;
        }

        .produk-img {
            height: 150px;
        }

        .maps-title {
            font-size: 1.8rem;
        }
    }
</style>

<!-- Slider -->
<div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="<?= base_url('img/beranda.jpeg'); ?>" alt="Slider 1" data-aos="fade-down" data-aos-duration="800" data-aos-delay="100">
            <div class="carousel-caption">
                <h2 data-aos="fade-right" data-aos-duration="900" data-aos-delay="300">Ima Catering</h2>
                <p data-aos="fade-left" data-aos-duration="1000" data-aos-delay="500">Semua Yang Di Butuhkan Ada Disini</p>
            </div>
        </div>
    </div>
</div>

<!-- Tentang Kami -->
<section class="about-section">
    <div class="container">
        <h2 class="about-title" data-aos="zoom-in" data-aos-duration="1100" data-aos-delay="700">Tentang Kami</h2>
        <p class="about-text" data-aos="fade-right" data-aos-duration="1200" data-aos-delay="900">Ima Catering merupakan suatu usaha rumahan makanan, minuman dan kue rumahan yang sudah dijalankan oleh Ibu Ima sejak tahun 2015 hingga sekarang yang bertempat di Kecamatan Giri Kabupaten Banyuwangi. Ima Catering telah menawarkan beragam macam produk seperti Nasi Tumpeng, Nasi Kotak, Es Campur, Kue Kering dan Kue Basah. Seiring berjalan nya waktu, Ima Catering telah melayani berbagai acara, seperti pernikahan, khitanan, perayaan ulang tahun, hingga acara kantor di perusahaan japfa.</p>

        <div class="about-icons">
            <div>
                <i class="fas fa-utensils" data-aos="fade-down" data-aos-duration="1200" data-aos-delay="900"></i>
                <p data-aos="fade-up" data-aos-duration="1200" data-aos-delay="900">Makanan Berkualitas</p>
            </div>
            <div>
                <i class="fas fa-tags" data-aos="fade-down" data-aos-duration="1200" data-aos-delay="900"></i>
                <p data-aos="fade-up" data-aos-duration="1200" data-aos-delay="900">Harga Terjangkau</p>
            </div>
            <div>
                <i class="fas fa-users" data-aos="fade-down" data-aos-duration="1200" data-aos-delay="900"></i>
                <p data-aos="fade-up" data-aos-duration="1200" data-aos-delay="900">Pelayanan Profesional</p>
            </div>
            <div>
                <i class="fas fa-star" data-aos="fade-down" data-aos-duration="1200" data-aos-delay="900"></i>
                <p data-aos="fade-up" data-aos-duration="1200" data-aos-delay="900">Pengalaman Terpercaya</p>
            </div>
        </div>
    </div>
</section>

<!-- produk kami -->
<?php $session = session(); ?>
<section class="produk-section">
    <div class="container">
        <h2 class="produk-title" data-aos="fade-down" data-aos-duration="1300" data-aos-delay="1100">Produk Catering</h2>
        <div class="row">
            <?php foreach (array_slice($produk, 0, 3) as $item): ?>
                <div class="col-md-4 col-sm-6 mb-4" data-aos="fade-up" data-aos-duration="1400" data-aos-delay="1300">
                    <div class="produk-card">
                        <img src="<?= base_url('uploads/produk/' . $item['gambar']); ?>" alt="<?= $item['nama']; ?>" class="produk-img">
                        <div class="produk-body">
                            <h5><?= $item['nama']; ?></h5>
                            <p><?= character_limiter(strip_tags($item['deskripsi']), 80); ?></p>
                            <?php if (session()->get('isLoggedIn')) : ?>
                                <a href="<?= base_url('produk-regular') ?>"><button class="produk-btn">Lihat Produk</button></a>
                            <?php else : ?>
                                <a href="<?= base_url('login') ?>"><button class="produk-btn">Lihat Produk</button></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-4" data-aos="fade-up" data-aos-duration="1500" data-aos-delay="1500">
            <?php if ($session->get('isLoggedIn')) : ?>
                <a href="<?= site_url('produk-regular') ?>"><button class="lihat-lainnya">Lihat Lainnya</button></a>
            <?php else : ?>
                <a href="<?= site_url('login') ?>"><button class="lihat-lainnya">Lihat Lainnya</button></a>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Maps -->
<section class="maps-section">
    <div class="container">
        <h2 class="maps-title" data-aos="fade-right" data-aos-duration="1700" data-aos-delay="1800">Lokasi Kami</h2>
        <p class="maps-text" data-aos="fade-left" data-aos-duration="1800" data-aos-delay="1900">Kunjungi kami di lokasi berikut:</p>
        <div class="maps-container" data-aos="fade-up" data-aos-duration="1900" data-aos-delay="2000">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3949.6435268685854!2d114.32624967495704!3d-8.164564582261398!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd15a9963f9a4b7%3A0xaeb2f0e57e8e7e5b!2sGiri%2C%20Banyuwangi%2C%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1709399876543"
                width="100%"
                height="400"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>

<script>
    AOS.init({
        duration: 1000,
        once: true,
    });
</script>

<?= $this->endSection(); ?>