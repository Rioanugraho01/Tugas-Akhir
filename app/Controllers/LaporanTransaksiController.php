<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LaporanModel;

class LaporanTransaksiController extends BaseController
{
    public function laporan_transaksi()
    {
        $model = new LaporanModel();

        $tahunList = $model->getListTahun();
        $bulanList = [
            '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
            '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
            '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
        ];

        $tahunDipilih = $this->request->getGet('tahun') ?? date('Y');
        $bulanDipilih = $this->request->getGet('bulan') ?? date('m');

        $pemasukanReguler = $model->getPemasukanBulanan();
        $pemasukanKhusus = $model->getPemasukanBulananKhusus();
        $labaReguler = $model->getLabaBulanan();
        $labaKhusus = $model->getLabaBulananKhusus();
        $totalPemesanan = $model->getTotalPemesanan();

        $bulanTahunArray = [];
        for ($i = 1; $i <= 12; $i++) {
            $bulanKey = $tahunDipilih . '-' . str_pad($i, 2, '0', STR_PAD_LEFT);
            $bulanTahunArray[$bulanKey] = 0;
        }

        $pemasukanRegulerData = $bulanTahunArray;
        foreach ($pemasukanReguler as $row) {
            $pemasukanRegulerData[$row['bulan']] = (int) $row['total'];
        }

        $pemasukanKhususData = $bulanTahunArray;
        foreach ($pemasukanKhusus as $row) {
            $pemasukanKhususData[$row['bulan']] = (int) $row['total'];
        }

        $labaRegulerData = $bulanTahunArray;
        foreach ($labaReguler as $row) {
            $labaRegulerData[$row['bulan']] = (int) $row['laba'];
        }

        $labaKhususData = $bulanTahunArray;
        foreach ($labaKhusus as $row) {
            $labaKhususData[$row['bulan']] = (int) $row['laba'];
        }

        foreach ($bulanTahunArray as $bulan => $val) {
            $pemasukanGabungan[$bulan] = ($pemasukanRegulerData[$bulan] ?? 0) + ($pemasukanKhususData[$bulan] ?? 0);
            $labaGabungan[$bulan] = ($labaRegulerData[$bulan] ?? 0) + ($labaKhususData[$bulan] ?? 0);
        }        

        $bulanSekarang = $tahunDipilih . '-' . $bulanDipilih;
        $bulanKemarin = date('Y-m', strtotime("-1 month", strtotime($bulanSekarang . "-01")));

        $pemasukanSekarang = $pemasukanGabungan[$bulanSekarang] ?? 0;
        $pemasukanKemarin = $pemasukanGabungan[$bulanKemarin] ?? 0;
        $selisihPemasukan = $pemasukanSekarang - $pemasukanKemarin;

        $labaSekarang = $labaGabungan[$bulanSekarang] ?? 0;
        $labaKemarin = $labaGabungan[$bulanKemarin] ?? 0;
        $selisihLaba = $labaSekarang - $labaKemarin;

        $data = [
            'tahunList' => $tahunList,
            'bulanList' => $bulanList,
            'tahunDipilih' => $tahunDipilih,
            'bulanDipilih' => $bulanDipilih,
            'pemasukan' => $pemasukanGabungan,
            'laba' => $labaGabungan,
            'pemasukan_reguler_array' => array_values($pemasukanRegulerData),
            'pemasukan_khusus_array' => array_values($pemasukanKhususData),
            'laba_reguler_array' => array_values($labaRegulerData),
            'laba_khusus_array' => array_values($labaKhususData),
            'bulanSekarang' => $bulanList[$bulanDipilih] . " " . $tahunDipilih,
            'bulanKemarin' => $bulanList[date('m', strtotime($bulanKemarin . "-01"))] . " " . date('Y', strtotime($bulanKemarin . "-01")),
            'pemasukanSekarang' => $pemasukanSekarang,
            'pemasukanKemarin' => $pemasukanKemarin,
            'selisihPemasukan' => $selisihPemasukan,
            'labaSekarang' => $labaSekarang,
            'labaKemarin' => $labaKemarin,
            'selisihLaba' => $selisihLaba,
            'pemasukan_labels' => array_keys($pemasukanGabungan),
            'laba_labels' => array_keys($labaGabungan),
            'totalPemesanan' => $totalPemesanan,

        ];

        return view('admin/laporan-transaksi/index', $data);
    }
}
