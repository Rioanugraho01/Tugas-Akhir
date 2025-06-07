<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Website Settings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" />
    <style>
        body {
            background-color: #f5f7fa;
            padding: 2rem 1rem;
        }

        .container-form {
            max-width: 900px;
            margin: 0 auto;
            background: #ffffff;
            padding: 2.5rem 3rem;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
        }

        .container-form:hover {
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        }

        h2 {
            font-weight: 700;
            color: #222;
            margin-bottom: 2rem;
            text-align: center;
            letter-spacing: 0.05em;
        }

        label {
            font-weight: 600;
            font-size: 0.95rem;
            margin-bottom: 0.3rem;
            color: #444;
        }

        input.form-control,
        textarea.form-control {
            border-radius: 6px;
            border: 1.5px solid #ced4da;
            font-size: 1rem;
            padding: 0.5rem 0.75rem;
            transition: border-color 0.3s ease;
        }

        input.form-control:focus,
        textarea.form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 5px rgba(13, 110, 253, 0.25);
        }

        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }

        .form-text-placeholder {
            color: #6c757d;
            font-style: italic;
            font-size: 0.85rem;
        }

        .btn-submit-container {
            margin-top: 2rem;
            text-align: center;
        }

        .btn-primary {
            font-weight: 600;
            padding: 0.65rem 2.5rem;
            font-size: 1.1rem;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
            box-shadow: 0 6px 16px rgba(11, 94, 215, 0.5);
        }
    </style>
</head>

<body>
    <div class="container-form">
        <h2>Edit Pengaturan Website</h2>

        <form action="<?= base_url('/admin/settings/update') ?>" method="post" class="row g-4 needs-validation" novalidate>
            <input type="hidden" name="id" value="<?= esc($settings['id']) ?>" />
            <?= csrf_field() ?>

            <!-- Baris 1 -->
            <div class="col-md-6">
                <label for="email_header">Email Header
                    <small class="form-text-placeholder">(contoh: info@domain.com)</small>
                </label>
                <input type="email" class="form-control" id="email_header" name="email_header"
                    value="<?= esc($settings['email_header']) ?>" required />
                <div class="invalid-feedback">Mohon masukkan email yang valid.</div>
            </div>

            <div class="col-md-6">
                <label for="phone_header">Telepon Header
                    <small class="form-text-placeholder">(contoh: 08123456789)</small>
                </label>
                <input type="tel" class="form-control" id="phone_header" name="phone_header"
                    value="<?= esc($settings['phone_header']) ?>" required />
                <div class="invalid-feedback">Mohon masukkan nomor telepon.</div>
            </div>

            <!-- Baris 2 -->
            <div class="col-12">
                <label for="address_header">Alamat Header</label>
                <input type="text" class="form-control" id="address_header" name="address_header"
                    value="<?= esc($settings['address_header']) ?>" required />
                <div class="invalid-feedback">Alamat tidak boleh kosong.</div>
            </div>

            <!-- Baris 3 -->
            <div class="col-md-6">
                <label for="logo_navbar">Logo Navbar (path)</label>
                <input type="text" class="form-control" id="logo_navbar" name="logo_navbar"
                    value="<?= esc($settings['logo_navbar']) ?>"
                    placeholder="contoh: images/logo.png" />
            </div>
            <div class="col-md-6">
                <label for="slider_image">Slider Image (path)</label>
                <input type="text" class="form-control" id="slider_image" name="slider_image"
                    value="<?= esc($settings['slider_image']) ?>"
                    placeholder="contoh: images/slider1.jpg" />
            </div>

            <!-- Baris 4: Icon Texts -->
            <?php for ($i = 1; $i <= 4; $i++): ?>
                <div class="col-md-3">
                    <label for="icon<?= $i ?>_text">Icon <?= $i ?> Text</label>
                    <input type="text" class="form-control" id="icon<?= $i ?>_text" name="icon<?= $i ?>_text"
                        value="<?= esc($settings["icon{$i}_text"]) ?>"
                        placeholder="Teks icon <?= $i ?>" />
                </div>
            <?php endfor; ?>

            <!-- Baris 5: Tentang Kami Text & Image -->
            <div class="col-12">
                <label for="tentang_kami_text">Tentang Kami Text</label>
                <textarea class="form-control" id="tentang_kami_text" name="tentang_kami_text"
                    placeholder="Deskripsi singkat tentang kami"><?= esc($settings['tentang_kami_text']) ?></textarea>
            </div>
            <div class="col-12">
                <label for="tentang_kami_image">Gambar Tentang Kami (path)</label>
                <input type="text" class="form-control" id="tentang_kami_image" name="tentang_kami_image"
                    value="<?= esc($settings['tentang_kami_image']) ?>"
                    placeholder="contoh: images/tentang-kami.jpg" />
            </div>

            <!-- Baris 6: Lokasi Map -->
            <div class="col-12">
                <label for="lokasi_embed_map">Embed Lokasi Map (iframe)</label>
                <textarea class="form-control" id="lokasi_embed_map" name="lokasi_embed_map"
                    placeholder="Tempelkan kode iframe Google Maps di sini"><?= esc($settings['lokasi_embed_map']) ?></textarea>
            </div>

            <!-- Baris 7: Footer Contact -->
            <div class="col-md-4">
                <label for="footer_contact_address">Footer Alamat</label>
                <input type="text" class="form-control" id="footer_contact_address" name="footer_contact_address"
                    value="<?= esc($settings['footer_contact_address']) ?>" />
            </div>
            <div class="col-md-4">
                <label for="footer_contact_phone">Footer Telepon</label>
                <input type="text" class="form-control" id="footer_contact_phone" name="footer_contact_phone"
                    value="<?= esc($settings['footer_contact_phone']) ?>" />
            </div>
            <div class="col-md-4">
                <label for="footer_contact_email">Footer Email</label>
                <input type="email" class="form-control" id="footer_contact_email" name="footer_contact_email"
                    value="<?= esc($settings['footer_contact_email']) ?>" />
            </div>

            <!-- Baris 8: Footer Text -->
            <div class="col-12">
                <label for="footer_text">Footer Text</label>
                <textarea class="form-control" id="footer_text" name="footer_text"
                    placeholder="Teks singkat di footer"><?= esc($settings['footer_text']) ?></textarea>
            </div>

            <!-- Baris 9: Sosial Media -->
            <div class="col-md-6">
                <label for="social_facebook">Link Facebook</label>
                <input type="url" class="form-control" id="social_facebook" name="social_facebook"
                    value="<?= esc($settings['social_facebook']) ?>" placeholder="https://facebook.com/username" />
            </div>
            <div class="col-md-6">
                <label for="social_whatsapp">Link WhatsApp</label>
                <input type="url" class="form-control" id="social_whatsapp" name="social_whatsapp"
                    value="<?= esc($settings['social_whatsapp']) ?>" placeholder="https://wa.me/628123456789" />
            </div>

            <!-- Tombol Submit -->
            <div class="col-12 btn-submit-container">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-2"></i>Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</body>

</html>