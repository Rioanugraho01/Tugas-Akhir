<?= $this->extend('user/layout/app'); ?>
<?= $this->section('content'); ?>

<style>
    /* Login Layout */
    .login-container {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 70vh;
        padding: 20px;
    }

    .login-box {
        display: flex;
        flex-wrap: wrap;
        background: #ffffff;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
        max-width: 900px;
        width: 100%;
    }

    /* Gambar*/
    .login-image {
        flex: 1;
        background: url('<?= base_url("img/login2.jpg"); ?>') no-repeat center center/cover;
        min-height: 400px;
    }

    /* Form Login */
    .login-form {
        flex: 1;
        padding: 40px;
        text-align: center;
    }

    .login-form h2 {
        font-size: 26px;
        font-weight: bold;
        color: #333;
        margin-bottom: 20px;
    }

    .form-group {
        position: relative;
        margin-bottom: 18px;
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
        box-shadow: 0px 0px 12px rgba(255, 204, 0, 0.4);
    }

    /* Button */
    .btn-login {
        background: linear-gradient(135deg, #ffcc00, #ffdb4d);
        color: white;
        border: none;
        padding: 12px;
        border-radius: 8px;
        width: 100%;
        font-size: 16px;
        font-weight: bold;
        transition: 0.3s;
        box-shadow: 0px 5px 12px rgba(255, 204, 0, 0.3);
    }

    .btn-login:hover {
        background: linear-gradient(135deg, #ffdb4d, #ffcc00);
        box-shadow: 0px 5px 18px rgba(255, 204, 0, 0.5);
    }

    /* Link */
    .forgot-password,
    .register-link {
        font-size: 14px;
        color: #ffcc00;
        text-decoration: none;
        transition: 0.3s;
    }

    .forgot-password:hover,
    .register-link:hover {
        text-decoration: underline;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .login-box {
            flex-direction: column;
        }

        .login-image {
            min-height: 250px;
        }

        .login-form {
            padding: 30px;
        }
    }

    @media (max-width: 576px) {
        .login-image {
            min-height: 200px;
        }

        .login-form {
            padding: 20px;
        }
    }
</style>

<div class="login-container">
    <div class="login-box">
        <div class="login-image"></div>

        <div class="login-form">
            <h2>Masuk ke Akun</h2>

            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
            <?php endif; ?>

            <form action="<?= base_url('login'); ?>" method="post">
                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                    <i class="fas fa-user-circle"></i>
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                    <i class="fas fa-lock"></i>
                </div>
                <button type="submit" class="btn btn-login mt-2">Masuk</button>
                <p class="mt-3">
                    Belum punya akun? <a href="<?= base_url('register'); ?>" class="register-link">Daftar</a>
                </p>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>