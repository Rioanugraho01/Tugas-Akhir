<?= $this->extend('layout/app'); ?>
<?= $this->section('content'); ?>

<style>
    /* --- SLIDER --- */
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

    /* --- KALENDER --- */
    .calendar-container {
        background-color: #333;
        border-radius: 0.5rem;
        padding: 1.5rem;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        color: white;
    }

    .calendar-controls button {
        border: none;
    }

    .table-bordered {
        border: none;
    }

    .table-bordered th,
    .table-bordered td {
        width: 100px;
        height: 100px;
        border: 1px solid #dee2e6;
        position: relative;
    }

    .table-bordered th {
        height: 70px;
        border-top: 1px solid #dee2e6;
        border-bottom: 1px solid #dee2e6;
        border-left: none;
        border-right: none;
    }

    .event-rect,
    .event-rect-small,
    .event-rect-medium {
        color: white;
        padding: 5px;
        border-radius: 5px;
        text-align: center;
        position: absolute;
        width: 70%;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        cursor: pointer;
    }

    .event-rect {
        background-color: #007bff;
    }

    .event-rect-small {
        background-color: #28a745;
    }

    .event-rect-medium {
        background-color: #dc3545;
    }

    /* --- RESPONSIVE --- */
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

        .table-bordered th,
        .table-bordered td {
            height: 80px;
            width: 80px;
            font-size: 0.85rem;
        }
    }
</style>

<div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="<?= base_url('img/beranda.jpeg'); ?>" alt="Slider 1">
            <div class="carousel-caption">
                <h2>Kalender Ketersediaan</h2>
                <p>Pilihlah Jadwal Sesuai Dengan Keinginanmu</p>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5 mb-5">
    <h2 class="fw-bold text-center">Kalender Ketersediaan</h2>
    <hr>
    <div class="calendar-container mt-4">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
            <h5 class="m-0"><?= date('F Y', strtotime("$tahun-$bulan-01")); ?></h5>
            <div class="calendar-controls d-flex align-items-center mt-2 mt-md-0 gap-3">
                <a href="<?= site_url('kalender/kalender?bulan=' . (($bulan == 1) ? 12 : $bulan - 1) . '&tahun=' . (($bulan == 1) ? $tahun - 1 : $tahun)); ?>"
                    class="btn btn-outline-secondary rounded-circle d-flex align-items-center justify-content-center"
                    style="width: 40px; height: 40px;" title="Bulan Sebelumnya">
                    <i class="bi bi-chevron-left"></i>
                </a>
                <a href="<?= site_url('kalender/kalender?bulan=' . (($bulan == 12) ? 1 : $bulan + 1) . '&tahun=' . (($bulan == 12) ? $tahun + 1 : $tahun)); ?>"
                    class="btn btn-outline-secondary rounded-circle d-flex align-items-center justify-content-center"
                    style="width: 40px; height: 40px;" title="Bulan Berikutnya">
                    <i class="bi bi-chevron-right"></i>
                </a>
                <div class="input-group" style="width: auto;">
                    <span class="input-group-text bg-light border-0"><i class="bi bi-calendar-event"></i></span>
                    <select class="form-select form-select-sm" onchange="window.location.href = '<?= site_url('kalender/kalender'); ?>?bulan=<?= $bulan; ?>&tahun=' + this.value;">
                        <?php for ($i = 2020; $i <= 2030; $i++): ?>
                            <option value="<?= $i; ?>" <?= $i == $tahun ? 'selected' : ''; ?>><?= $i; ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
            </div>
        </div>
        <table class="table table-bordered text-center mt-4 bg-white text-dark">
            <thead class="table-light">
                <tr>
                    <th>Minggu</th>
                    <th>Senin</th>
                    <th>Selasa</th>
                    <th>Rabu</th>
                    <th>Kamis</th>
                    <th>Jumat</th>
                    <th>Sabtu</th>
                </tr>
            </thead>
            <?php
            $tanggalStatus = [];
            foreach ($ketersediaan as $item) {
                $tanggal = date('j', strtotime($item['tanggal']));
                $tanggalStatus[$tanggal] = $item['status'];
            }
            $jumlahHari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
            $hariPertama = date('w', strtotime("$tahun-$bulan-01"));
            $namaHari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            function getStatusClass($status)
            {
                return $status === 'tersedia' ? 'event-rect-small' : 'event-rect-medium';
            }
            function getStatusLabel($status)
            {
                return $status === 'tersedia' ? 'Tersedia' : 'Penuh';
            }
            ?>
            <tbody class="text-end">
                <?php
                $tanggal = 1;
                $selesai = false;
                for ($minggu = 0; $minggu < 6; $minggu++):
                    echo "<tr>";
                    for ($hari = 0; $hari < 7; $hari++):
                        if ($minggu === 0 && $hari < $hariPertama) {
                            echo "<td></td>";
                        } elseif ($tanggal > $jumlahHari) {
                            echo "<td></td>";
                            $selesai = true;
                        } else {
                            echo "<td>$tanggal";
                            if (isset($tanggalStatus[$tanggal])) {
                                $status = $tanggalStatus[$tanggal];
                                echo '<div class="' . getStatusClass($status) . '">' . getStatusLabel($status) . '</div>';
                            }
                            echo "</td>";
                            $tanggal++;
                        }
                    endfor;
                    echo "</tr>";
                    if ($selesai) break;
                endfor;
                ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection(); ?>