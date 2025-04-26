<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= isset($title) ? $title : 'Website' ?></title>
    <meta name="title" content="<?= isset($meta_title) ? $meta_title : 'Default Title for the website.'; ?>">
    <meta name="description" content="<?= isset($meta_description) ? $meta_description : 'Default description for the website.'; ?>">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
</head>

<style>
    /* Header styling */
    .top-header {
        background: #333;
        color: white;
        padding: 8px 0;
        font-size: 14px;
    }

    .top-header i {
        margin-right: 5px;
        color: #ffcc00;
    }

    .top-header .info {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
    }

    /* Navbar styling */
    /* Sticky Navbar */
    .navbar {
        position: sticky;
        top: 0;
        z-index: 1020;
        background-color: white;
        transition: all 0.4s ease-in-out;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    .navbar-brand img {
        max-height: 50px;
    }

    .navbar.scrolled {
        background: rgba(51, 51, 51, 0.9);
        /* Warna latar belakang saat di-scroll */
        padding: 15px 40px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Animasi navbar hover dengan garis bawah */
    .nav-link {
        font-weight: 500;
        color: #333;
        position: relative;
        transition: color 0.3s;
    }

    .nav-link:hover {
        color: #ffcc00;
    }

    .nav-link::after {
        content: '';
        display: block;
        width: 0;
        height: 2px;
        background: #ffcc00;
        transition: width 0.3s;
        position: absolute;
        bottom: -3px;
        left: 0;
    }

    .nav-link:hover::after {
        width: 100%;
    }

    /* Button Styling */
    .btn-custom {
        border-radius: 5px;
        transition: transform 0.2s ease-in-out;
    }

    .btn-custom:hover {
        transform: scale(1.05);
    }

    /* Footer */
    .footer {
        background-color: #333;
        color: #fff;
        padding: 50px 0;
        text-align: center;
    }

    .footer-row {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 20px;
    }

    .footer-col {
        flex: 1;
        min-width: 200px;
    }

    .footer h3,
    .footer h4 {
        font-size: 1.5rem;
        margin-bottom: 15px;
        color: #ffcc00;
    }

    .footer p,
    .footer ul {
        font-size: 1rem;
        color: #ccc;
    }

    .footer ul {
        list-style: none;
        padding: 0;
    }

    .footer ul li {
        margin-bottom: 8px;
    }

    .footer ul li a {
        color: #fff;
        text-decoration: none;
    }

    .footer ul li a:hover {
        color: #ffcc00;
    }

    /* Sosial Media */
    .social-icons {
        display: flex;
        gap: 10px;
        justify-content: center;
    }

    .social-icons a {
        color: #fff;
        font-size: 1.5rem;
        transition: 0.3s;
    }

    .social-icons a:hover {
        color: #ffcc00;
    }

    /* Copyright */
    .footer-bottom {
        margin-top: 20px;
        border-top: 1px solid #555;
        padding-top: 10px;
        font-size: 0.9rem;
        color: #bbb;
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

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .top-header .info {
            justify-content: center;
            text-align: center;
        }

        .top-header .text-end {
            text-align: center !important;
        }

        .footer .col-md-4 {
            text-align: center;
            margin-bottom: 20px;
        }

        .footer .social-icons {
            justify-content: center !important;
        }
    }

    @media (max-width: 576px) {
        .navbar-brand img {
            max-height: 40px;
        }
    }
</style>

<body>
    <!-- HEADER -->
    <div class="top-header">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="info">
                        <span><i class="bi bi-envelope"></i> imacatering@gmail.com</span>
                        <span><i class="bi bi-telephone"></i> +62 812-3456-7890</span>
                        <span><i class="bi bi-geo-alt"></i> Banyuwangi, Jawa Timur</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="#">
                <img src="https://via.placeholder.com/120x50" alt="Logo">
            </a>

            <!-- Navbar Toggler (Hamburger Menu) -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Links -->
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tentang-kami">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="produk-regular">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kalender">Kalender</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="riwayat">Riwayat</a>
                    </li>
                </ul>
                <?php $session = session(); ?>
                <div class="ms-lg-3 mt-2 mt-lg-0">
                    <?php if ($session->get('isLoggedIn')) : ?>
                        <div class="dropdown">
                            <button class="btn btn-warning dropdown-toggle produk-btn" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <?= esc($session->get('username')) ?>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="<?= base_url('edit-profile'); ?>">Edit Profile</a></li>
                                <li><a class="dropdown-item text-danger" href="<?= base_url('logout'); ?>">Logout</a></li>
                            </ul>
                        </div>
                    <?php else : ?>
                        <a href="<?= base_url('register'); ?>" class="btn btn-outline-warning me-2 btn-custom">Register</a>
                        <a href="<?= base_url('login'); ?>" class="btn btn-warning btn-custom">Login</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <div>
        <?= $this->renderSection('content'); ?>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-row">
                <!-- Kolom 1: Logo & Deskripsi -->
                <div class="footer-col">
                    <h3>Ima Catering</h3>
                    <p>Menyediakan makanan berkualitas dengan layanan terbaik untuk berbagai acara.</p>
                </div>

                <!-- Kolom 2: Navigasi -->
                <div class="footer-col">
                    <h4>Menu</h4>
                    <ul>
                        <li><a href="index">Beranda</a></li>
                        <li><a href="tentang-kami">Tentang Kami</a></li>
                        <li><a href="produk-regular">Produk</a></li>
                        <li><a href="kalender">Kalender</a></li>
                        <li><a href="riwayat">Riwayat</a></li>
                    </ul>
                </div>

                <!-- Kolom 3: Kontak -->
                <div class="footer-col">
                    <h4>Kontak Kami</h4>
                    <p><i class="fas fa-map-marker-alt"></i> Banyuwangi, Jawa Timur</p>
                    <p><i class="fas fa-phone"></i> +62 812-3456-7890</p>
                    <p><i class="fas fa-envelope"></i> imacatering@gmail.com</p>
                </div>

                <!-- Kolom 4: Sosial Media -->
                <div class="footer-col">
                    <h4>Ikuti Kami</h4>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
            </div>

            <!-- Copyright -->
            <div class="footer-bottom">
                <p>&copy; <span id="year"></span> Ima Catering. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

</body>

<script>
    // sticky navbar
    window.addEventListener("scroll", function() {
        var navbar = document.querySelector(".navbar");
        if (window.scrollY > 50) {
            navbar.classList.add("scrolled");
        } else {
            navbar.classList.remove("scrolled");
        }
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>