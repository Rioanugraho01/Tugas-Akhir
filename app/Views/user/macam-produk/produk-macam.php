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

    /* card terbaru */
    .produk-card {
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease-in-out;
        text-align: left;
        padding: 20px;
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

    .produk-harga {
        font-size: 1.2rem;
        font-weight: bold;
        color: #ff0000;
    }

    .produk-body h5,
    .produk-body p {
        text-align: left;
    }

    .produk-divider {
        border-top: 1px solid #ddd;
        margin: 15px 0;
    }

    .produk-qty {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .produk-btn {
        background: #333;
        color: #fff;
        border: 2px solid #333;
        padding: 8px 15px;
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
        width: 100%;
    }

    .produk-btn:hover {
        background: #ffcc00;
        color: #333;
        border-color: #ffcc00;
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
    }

    .pesan-sekarang-btn i {
        font-size: 1rem;
        transition: 0.3s;
    }

    .pesan-sekarang-btn:hover {
        transform: translateY(-3px);
        background: linear-gradient(135deg, #ffdb4d, #ffcc00);
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
                <h2>Macam Produk Ima Catering</h2>
                <p>Macam Produk Yang Tersedia Untuk Anda</p>
            </div>
        </div>
    </div>
</div>

<section class="produk-section">
    <div class="container">
        <h2 class="produk-title">Macam Produk <?= esc($produk['nama']) ?></h2>
        <hr>
        <div class="row">
            <?php if (!empty($macamProduk)): ?>
                <?php foreach ($macamProduk as $produk): ?>
                    <div class="col-md-4 mt-4">
                        <div class="produk-card">
                            <img src="<?= base_url('uploads/macam-produk/' . $produk['gambar']) ?>" class="produk-img" alt="<?= $produk['nama'] ?>">
                            <div class="produk-body">
                                <h5><?= esc($produk['nama']); ?></h5>
                                <p><?= esc($produk['deskripsi']); ?></p>
                                <p><strong>Rp <?= number_format($produk['harga'], 0, ',', '.') ?></strong></p>
                                <input type="number" class="produk-qty" placeholder="Jumlah">
                                <button class="produk-btn">Add</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">Belum ada macam produk untuk <?= esc($produk['nama']) ?>.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<script>
    let cart = [];
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', function() {
            let id = this.getAttribute('data-id');
            let qtyInput = document.querySelector(`.produk-qty[data-id='${id}']`);
            let nama = qtyInput.getAttribute('data-nama');
            let harga = parseInt(qtyInput.getAttribute('data-harga'));
            let qty = parseInt(qtyInput.value);
            let existingProduct = cart.find(item => item.id === id);
            if (existingProduct) {
                existingProduct.qty += qty;
            } else {
                cart.push({
                    id,
                    nama,
                    harga,
                    qty
                });
            }
            updateTotal();
        });
    });
    function updateTotal() {
        let total = 0;
        let detailHTML = '<h5>Detail Pemesanan:</h5><ul>';
        cart.forEach(item => {
            let subtotal = item.harga * item.qty;
            total += subtotal;
            detailHTML += `<li>${item.nama} - ${item.qty} x Rp ${item.harga.toLocaleString()} = Rp ${subtotal.toLocaleString()}</li>`;
        });
        detailHTML += '</ul>';
        document.getElementById('total-harga').innerText = `Rp ${total.toLocaleString()}`;
        document.getElementById('detail-pemesanan').innerHTML = detailHTML;
    }
</script>


<?= $this->endSection(); ?>