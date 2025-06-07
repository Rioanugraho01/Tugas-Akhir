<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Detail Website Settings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" />
    <style>
        body {
            background-color: #eef2f7;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 3rem 1rem;
            color: #2c3e50;
        }

        .container-form {
            max-width: 900px;
            margin: 0 auto;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 10px 25px rgb(0 0 0 / 0.1);
            background: #ffffff;
            transition: box-shadow 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 15px 35px rgb(0 0 0 / 0.15);
        }

        .card-header {
            background-color: #0056b3;
            color: white;
            font-weight: 700;
            font-size: 1.6rem;
            border-radius: 15px 15px 0 0;
            text-align: center;
            padding: 1.3rem 2rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            box-shadow: inset 0 -3px 5px rgb(0 0 0 / 0.1);
        }

        ul.list-group {
            margin-bottom: 2rem;
        }

        .list-group-item {
            border: none;
            padding-left: 0;
            padding-right: 0;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            gap: 0.7rem;
            color: #34495e;
        }

        .list-group-item strong {
            min-width: 180px;
            color: black;
            display: flex;
            align-items: center;
            gap: 0.4rem;
            font-weight: 600;
        }

        .list-group-item strong i {
            font-size: 1.1rem;
            color: black;
        }

        .section-title {
            font-weight: 700;
            margin-top: 3rem;
            margin-bottom: 1.2rem;
            color: #222f3e;
            border-bottom: 3px solid #0056b3;
            padding-bottom: 0.3rem;
            font-size: 1.3rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .icon-text {
            font-style: italic;
            color: #627d98;
            font-size: 1rem;
        }

        a {
            color: #1e90ff;
            text-decoration: none;
            transition: color 0.25s ease;
        }

        a:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        code {
            background-color: #f1f3f5;
            color: #495057;
            padding: 0.25em 0.5em;
            border-radius: 5px;
            font-size: 0.95rem;
            font-family: 'Courier New', Courier, monospace;
        }

        .map-embed {
            background-color: #f8f9fa;
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 1rem;
            overflow-x: auto;
            box-shadow: inset 0 0 5px rgb(0 0 0 / 0.05);
            min-height: 150px;
        }

        @media (max-width: 576px) {
            .list-group-item strong {
                min-width: 120px;
                font-size: 0.95rem;
            }

            .section-title {
                font-size: 1.1rem;
            }

            .list-group-item {
                font-size: 1rem;
            }
        }
    </style>
</head>

<body>
    <div class="container-form">
        <div class="card">
            <div class="card-header">
                Detail Pengaturan Website
            </div>
            <div class="card-body px-4 py-4">

                <!-- Header Info -->
                <ul class="list-group list-group-flush mb-4">
                    <li class="list-group-item">
                        <strong><i class="bi bi-envelope-fill"></i> Email Header:</strong>
                        <?= esc($setting['email_header']) ?>
                    </li>
                    <li class="list-group-item">
                        <strong><i class="bi bi-telephone-fill"></i> Telepon Header:</strong>
                        <?= esc($setting['phone_header']) ?>
                    </li>
                    <li class="list-group-item">
                        <strong><i class="bi bi-geo-alt-fill"></i> Alamat Header:</strong>
                        <?= esc($setting['address_header']) ?>
                    </li>
                </ul>

                <!-- Branding Images -->
                <ul class="list-group list-group-flush mb-4">
                    <li class="list-group-item">
                        <strong><i class="bi bi-image-fill"></i> Logo Navbar:</strong>
                        <code><?= esc($setting['logo_navbar']) ?></code>
                    </li>
                    <li class="list-group-item">
                        <strong><i class="bi bi-images"></i> Slider Image:</strong>
                        <code><?= esc($setting['slider_image']) ?></code>
                    </li>
                </ul>

                <!-- Tentang Kami Text -->
                <h5 class="section-title">Tentang Kami</h5>
                <p class="mb-4"><?= nl2br(esc($setting['tentang_kami_text'])) ?></p>

                <!-- Teks Icon -->
                <h5 class="section-title">Teks Icon</h5>
                <ul class="list-group list-group-flush mb-4">
                    <?php for ($i = 1; $i <= 4; $i++): ?>
                        <li class="list-group-item">
                            <strong><i class="bi bi-pin-angle-fill"></i> Icon <?= $i ?>:</strong>
                            <span class="icon-text"><?= esc($setting["icon{$i}_text"]) ?></span>
                        </li>
                    <?php endfor; ?>
                </ul>

                <!-- Lokasi Map -->
                <h5 class="section-title">Lokasi Kami</h5>
                <div class="map-embed mb-4">
                    <?= $setting['lokasi_embed_map'] ?>
                </div>

                <!-- Footer Kontak -->
                <h5 class="section-title">Kontak Footer</h5>
                <ul class="list-group list-group-flush mb-4">
                    <li class="list-group-item">
                        <strong><i class="bi bi-building"></i> Alamat:</strong>
                        <?= esc($setting['footer_contact_address']) ?>
                    </li>
                    <li class="list-group-item">
                        <strong><i class="bi bi-telephone"></i> Telepon:</strong>
                        <?= esc($setting['footer_contact_phone']) ?>
                    </li>
                    <li class="list-group-item">
                        <strong><i class="bi bi-envelope"></i> Email:</strong>
                        <?= esc($setting['footer_contact_email']) ?>
                    </li>
                </ul>

                <!-- Footer Text -->
                <h5 class="section-title">Footer Text</h5>
                <p><?= nl2br(esc($setting['footer_text'])) ?></p>

                <!-- Sosial Media -->
                <h5 class="section-title">Sosial Media</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <strong><i class="bi bi-facebook"></i> Facebook:</strong>
                        <a href="<?= esc($setting['social_facebook']) ?>" target="_blank">
                            <?= esc($setting['social_facebook']) ?>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <strong><i class="bi bi-whatsapp"></i> WhatsApp:</strong>
                        <a href="<?= esc($setting['social_whatsapp']) ?>" target="_blank">
                            <?= esc($setting['social_whatsapp']) ?>
                        </a>
                    </li>
                </ul>

            </div>
        </div>
    </div>
</body>

</html>
