<?= $this->extend('user/layout/app'); ?>
<?= $this->section('content'); ?>

<style>
    /* Styling Layout */
    .register-container {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 80vh;
        padding: 20px;
    }

    .register-box {
        display: flex;
        flex-wrap: wrap;
        background: #ffffff;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
        max-width: 900px;
        width: 100%;
    }

    /* Ilustrasi */
    .register-image {
        flex: 1;
        background: url('<?= base_url("img/login2.jpg"); ?>') no-repeat center center/cover;
        min-height: 450px;
    }

    /* Form Register */
    .register-form {
        flex: 1;
        padding: 40px;
        text-align: center;
    }

    .register-form h2 {
        font-size: 24px;
        font-weight: bold;
        color: #333;
        margin-bottom: 20px;
    }

    .form-group {
        position: relative;
        margin-bottom: 20px;
    }

    .form-group i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #ffcc00;
    }

    .form-control {
        width: 100%;
        padding: 12px 40px;
        border: 2px solid #ffcc00;
        border-radius: 8px;
        font-size: 16px;
        outline: none;
        transition: 0.3s;
    }

    .form-control:focus {
        border-color: #ffdb4d;
        box-shadow: 0px 0px 10px rgba(255, 204, 0, 0.4);
    }

    /* Button Styling */
    .btn-register {
        background: linear-gradient(135deg, #ffcc00, #ffdb4d);
        color: white;
        border: none;
        padding: 12px;
        border-radius: 8px;
        width: 100%;
        font-size: 16px;
        font-weight: bold;
        transition: 0.3s;
        box-shadow: 0px 5px 10px rgba(255, 204, 0, 0.3);
    }

    .btn-register:hover {
        background: linear-gradient(135deg, #ffdb4d, #ffcc00);
        box-shadow: 0px 5px 15px rgba(255, 204, 0, 0.5);
    }

    /* Link Styling */
    .login-link {
        font-size: 14px;
        color: #ffcc00;
        text-decoration: none;
        transition: 0.3s;
    }

    .login-link:hover {
        text-decoration: underline;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .register-box {
            flex-direction: column;
        }

        .register-image {
            min-height: 300px;
        }

        .register-form {
            padding: 30px;
        }
    }

    @media (max-width: 576px) {
        .register-image {
            min-height: 250px;
        }

        .register-form {
            padding: 20px;
        }
    }
</style>

<div class="register-container">
    <div class="register-box">
        <div class="register-image"></div>

        <div class="register-form">
            <h2>Daftar Akun Baru</h2>

            <!-- Tampilkan pesan error -->
            <?php if (session()->getFlashdata('errors')) : ?>
                <div class="alert alert-danger">
                    <?= implode('<br>', session()->getFlashdata('errors')) ?>
                </div>
            <?php endif; ?>

            <!-- Tampilkan pesan sukses -->
            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('register'); ?>" method="post">
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Nama Lengkap" required>
                    <i class="fas fa-user"></i>
                </div>
                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                    <i class="fas fa-user-circle"></i>
                </div>
                <div class="form-group">
                    <input type="text" name="phone" class="form-control" placeholder="Nomor Telepon" required>
                    <i class="fas fa-phone"></i>
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                    <i class="fas fa-lock"></i>
                </div>
                <div class="form-group">
                        <input type="password" name="confirm_password" class="form-control" placeholder="Konfirmasi Password" required>
                        <i class="fas fa-lock"></i>
                    </div>
                <button type="submit" class="btn btn-register">Daftar</button>
                <p class="mt-3">
                    Sudah punya akun? <a href="<?= base_url('login'); ?>" class="login-link">Masuk</a>
                </p>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
