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

    /* Section Tentang Kami */
    .about-container {
        display: flex;
        align-items: center;
        justify-content: center;
        max-width: 1100px;
        margin: 50px auto;
        padding: 40px;
        background: #f8f9fa;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    .about-content {
        flex: 1;
        padding: 20px;
        text-align: left;
    }

    .about-content h2 {
        font-size: 2rem;
        font-weight: bold;
        color: #333;
    }

    .about-content p {
        font-size: 1.2rem;
        color: #555;
        line-height: 1.8;
    }

    .about-image {
        flex: 1;
        text-align: center;
    }

    .about-image img {
        max-width: 90%;
        border-radius: 10px;
    }

    /* Keunggulan Kami */
    .features {
        display: flex;
        justify-content: center;
        text-align: center;
        margin: 40px 0;
        gap: 30px;
    }

    .feature-item {
        max-width: 300px;
        padding: 15px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    .feature-item i {
        font-size: 3rem;
        color: #ffcc00;
        margin-bottom: 10px;
    }

    .feature-item h3 {
        font-size: 1.1rem;
        margin-bottom: 10px;
    }

    /* Responsive */
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

        .about-container {
            flex-direction: column;
            text-align: center;
        }

        .about-content,
        .about-image {
            width: 100%;
        }
        
        .features {
            flex-direction: column;
            align-items: center;
        }

        .feature-item {
            width: 80%;
            margin-bottom: 20px;
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

        .about-section h2 {
            font-size: 1.6rem;
        }
    }

    @media (max-width: 425px) {
        .carousel-item {
            height: 300px;
        }

        .carousel-caption h2 {
            font-size: 1.5rem;
        }

        .carousel-caption p {
            font-size: 0.8rem;
        }

        .about-section h2 {
            font-size: 1.4rem;
        }
    }

    @media (max-width: 375px) {
        .carousel-item {
            height: 280px;
        }

        .carousel-caption h2 {
            font-size: 1.4rem;
        }

        .carousel-caption p {
            font-size: 0.75rem;
        }

        .about-section h2 {
            font-size: 1.3rem;
        }
    }

    @media (max-width: 320px) {
        .carousel-item {
            height: 250px;
        }

        .carousel-caption h2 {
            font-size: 1.2rem;
        }

        .carousel-caption p {
            font-size: 0.7rem;
        }

        .about-section h2 {
            font-size: 1.2rem;
        }

        .typing-text {
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
                <h2>Tentang Kami</h2>
                <p>Apa Kamu Sudah Tau?</p>
            </div>
        </div>
    </div>
</div>

<!-- Tentang Kami -->
<div class="about-container">
    <div class="about-content">
        <h2>Siapa Kami?</h2>
        <p>
        Ima Catering merupakan suatu usaha rumahan makanan, minuman dan kue rumahan yang sudah dijalankan oleh Ibu Ima sejak tahun 2015 hingga sekarang yang bertempat di Kecamatan Giri Kabupaten Banyuwangi. Ima Catering telah menawarkan beragam macam produk seperti Nasi Tumpeng, Nasi Kotak, Es Campur, Kue Kering dan Kue Basah.
        </p>
    </div>
    <div class="about-image">
        <img src="<?= base_url('img/slider-1.png'); ?>" alt="Tim Kami">
    </div>
</div>

<!-- Keunggulan Kami -->
<div class="features">
    <div class="feature-item">
        <i class="fas fa-utensils"></i>
        <h3>Makanan Berkualitas</h3>
    </div>
    <div class="feature-item">
        <i class="fas fa-tags"></i>
        <h3>Harga Terjangkau</h3>
    </div>
    <div class="feature-item">
        <i class="fas fa-users"></i>
        <h3>Pelayanan Profesional</h3>
    </div>
    <div class="feature-item">
        <i class="fas fa-star"></i>
        <h3>Pengalaman Terpercaya</h3>
    </div>
</div>

<?= $this->endSection(); ?>