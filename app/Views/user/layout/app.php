<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= esc($title ?? 'Ima Catering') ?></title>
    <meta name="title" content="<?= esc($meta_title ?? 'Ima Catering - Solusi Catering Terbaik') ?>">
    <meta name="description" content="<?= esc($meta_description ?? 'Layanan catering terpercaya di Banyuwangi') ?>">

    <link rel="icon" href="<?= base_url('img/' . ($setting['logo_navbar'] ?? 'favicon.ico')) ?>" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<style>
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
        padding: 15px 40px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

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

    .nav-link.active {
        font-weight: bold;
        color: #ffcc00 !important;
        position: relative;
    }

    .nav-link.active::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: -3px;
        height: 2px;
        width: 100%;
        background-color: #ffcc00;
        border-radius: 2px;
    }

    .btn-custom {
        border-radius: 5px;
        transition: transform 0.2s ease-in-out;
    }

    .btn-custom:hover {
        transform: scale(1.05);
    }

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

    .footer-bottom {
        margin-top: 20px;
        border-top: 1px solid #555;
        padding-top: 10px;
        font-size: 0.9rem;
        color: #bbb;
    }

    .produk-btn {
        background: #333;
        color: #fff;
        border: 2px solid #333;
        padding: 8px 15px;
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }

    .dropdown-menu .dropdown-item:hover {
        background-color: #ffcc00;
        color: #000;
    }

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
    <div class="top-header">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="info">
                        <?php if (!empty($setting)): ?>
                            <span><i class="bi bi-envelope"></i> <?= esc($setting['email_header'] ?? '-') ?></span>
                            <span><i class="bi bi-telephone"></i> <?= esc($setting['phone_header'] ?? '-') ?></span>
                            <span><i class="bi bi-geo-alt"></i> <?= esc($setting['address_header'] ?? '-') ?></span>
                        <?php else: ?>
                            <span class="text-muted">Header tidak tersedia</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url() ?>">
                <img src="<?= base_url('img/' . ($setting['logo_navbar'] ?? 'catering-logo.png')) ?>" alt="Logo" style="height: 50px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link <?= active('index') ?>" href="<?= base_url('index') ?>">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= active('tentang-kami') ?>" href="<?= base_url('tentang-kami') ?>">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= active('produk-regular') ?>" href="<?= base_url('produk-regular') ?>">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= active('kalender') ?>" href="<?= base_url('kalender') ?>">Kalender</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= active('riwayat') ?>" href="<?= base_url('riwayat') ?>">Riwayat</a>
                    </li>
                </ul>
                <?php $session = session(); ?>
                <div class="ms-lg-3 mt-2 mt-lg-0">
                    <?php if ($session->get('isLoggedIn')) : ?>
                        <div class="dropdown">
                            <button class="btn btn-warning dropdown-toggle produk-btn" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <?= session('username') ?>
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

    <footer class="footer">
        <div class="container">
            <div class="footer-row">
                <div class="footer-col">
                    <h3>Ima Catering</h3>
                    <p> <?= esc($setting['footer_text'] ?? 'Default footer text') ?></p>
                </div>
                <div class="footer-col">
                    <h4>Menu</h4>
                    <ul>
                        <li><a href="<?= base_url('index'); ?>">Beranda</a></li>
                        <li><a href="<?= base_url('tentang-kami'); ?>">Tentang Kami</a></li>
                        <li><a href="<?= base_url('produk-regular'); ?>">Produk</a></li>
                        <li><a href="<?= base_url('kalender'); ?>">Kalender</a></li>
                        <li><a href="<?= base_url('riwayat'); ?>">Riwayat</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Kontak Kami</h4>
                    <p><i class="fas fa-map-marker-alt"></i> <?= esc($setting['footer_contact_address'] ?? 'Banyuwangi, Jawa Timur') ?></p>
                    <p><i class="fas fa-phone"></i> <?= esc($setting['footer_contact_phone'] ?? '+62 812-3456-7890') ?></p>
                    <p><i class="fas fa-envelope"></i> <?= esc($setting['footer_contact_email'] ?? 'imacatering@gmail.com') ?></p>
                </div>
                <div class="footer-col">
                    <h4>Ikuti Kami</h4>
                    <div class="social-icons">
                        <?php if (!empty($setting['social_facebook'])): ?>
                            <a href="<?= esc($setting['social_facebook']) ?>" class="text-light"><i class="fab fa-facebook fa-lg"></i></a>
                        <?php endif; ?>
                        <?php if (!empty($setting['social_whatsapp'])): ?>
                            <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $setting['social_whatsapp']) ?>" class="text-light"><i class="fab fa-whatsapp fa-lg"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <span id="year"></span> Ima Catering. All Rights Reserved.</p>
            </div>
        </div>
    </footer>
</body>

<script>
    window.addEventListener("scroll", function() {
        var navbar = document.querySelector(".navbar");
        if (window.scrollY > 50) {
            navbar.classList.add("scrolled");
        } else {
            navbar.classList.remove("scrolled");
        }
    });
</script>

</html>