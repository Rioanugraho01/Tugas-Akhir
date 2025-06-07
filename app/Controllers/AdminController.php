<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PemesananModel;
use App\Models\PemesananKhususModel;

class AdminController extends BaseController
{

    public function admin()
    {
        $pemesananModel = new PemesananModel();
        $pemesananKhususModel = new PemesananKhususModel();

        $totalPemesanan = $pemesananModel->countAll() + $pemesananKhususModel->countAll();

        $pemesananSelesaiReguler = $pemesananModel->where('status_progress', 'selesai')->countAllResults();

        $totalPemesananKhusus = $pemesananKhususModel->countAllResults();
        $pemesananSelesai = $pemesananSelesaiReguler + $totalPemesananKhusus;

        $pemesananProsesReguler = $pemesananModel
            ->where('status_progress !=', 'selesai')
            ->where('status_pemesanan !=', 'ditolak')
            ->countAllResults();
        $pemesananProses = $pemesananProsesReguler;

        $pemesananProsesKhusus = $pemesananKhususModel
            ->groupStart()
            ->where('status_pemesanan !=', 'selesai')
            ->orWhereIn('status_pemesanan', ['diterima', 'diproses'])
            ->groupEnd()
            ->whereIn('status_pembayaran', ['dp', 'terverifikasi - belum lunas'])
            ->countAllResults();
        $pemesananProses = $pemesananProsesReguler + $pemesananProsesKhusus;

        $pemesananDitolak = $pemesananModel
            ->where('status_pemesanan', 'ditolak')
            ->countAllResults();

        $totalReguler = $pemesananModel
            ->selectSum('total_harga')
            ->whereIn('status_pembayaran', ['lunas', 'terverifikasi - lunas'])
            ->first()['total_harga'] ?? 0;

        $totalKhusus = $pemesananKhususModel
            ->selectSum('total_harga')
            ->where('status_pemesanan', 'selesai')
            ->where('status_pembayaran', 'lunas')
            ->first()['total_harga'] ?? 0;

        $totalPendapatan = $totalReguler + $totalKhusus;

        $bulanIni = date('m');
        $tahunIni = date('Y');

        $getWeekOfMonth = function ($day) {
            if ($day >= 1 && $day <= 7) return 'Minggu 1';
            if ($day >= 8 && $day <= 14) return 'Minggu 2';
            if ($day >= 15 && $day <= 21) return 'Minggu 3';
            return 'Minggu 4';
        };

        $regulerMingguanRaw = $pemesananModel
            ->select("DAY(created_at) as hari, COUNT(*) as jumlah")
            ->where('MONTH(created_at)', $bulanIni)
            ->where('YEAR(created_at)', $tahunIni)
            ->groupBy('hari')
            ->findAll();

        $khususMingguanRaw = $pemesananKhususModel
            ->select("DAY(created_at) as hari, COUNT(*) as jumlah")
            ->where('MONTH(created_at)', $bulanIni)
            ->where('YEAR(created_at)', $tahunIni)
            ->groupBy('hari')
            ->findAll();

        $mingguanData = [
            'Minggu 1' => 0,
            'Minggu 2' => 0,
            'Minggu 3' => 0,
            'Minggu 4' => 0,
        ];

        foreach (array_merge($regulerMingguanRaw, $khususMingguanRaw) as $item) {
            $minggu = $getWeekOfMonth((int)$item['hari']);
            $mingguanData[$minggu] += (int)$item['jumlah'];
        }

        $regulerBulananRaw = $pemesananModel
            ->select("MONTH(created_at) as bulan, COUNT(*) as jumlah")
            ->where('YEAR(created_at)', $tahunIni)
            ->groupBy('bulan')
            ->findAll();

        $khususBulananRaw = $pemesananKhususModel
            ->select("MONTH(created_at) as bulan, COUNT(*) as jumlah")
            ->where('YEAR(created_at)', $tahunIni)
            ->groupBy('bulan')
            ->findAll();

        $bulananData = array_fill(1, 12, 0);

        foreach (array_merge($regulerBulananRaw, $khususBulananRaw) as $item) {
            $bulan = (int)$item['bulan'];
            $bulananData[$bulan] += (int)$item['jumlah'];
        }

        $tahunMulai = 2025;
        $tahunSelesai = 2030;

        $regulerTahunanRaw = $pemesananModel
            ->select("YEAR(created_at) as tahun, COUNT(*) as jumlah")
            ->where('YEAR(created_at) >=', $tahunMulai)
            ->where('YEAR(created_at) <=', $tahunSelesai)
            ->groupBy('tahun')
            ->findAll();

        $khususTahunanRaw = $pemesananKhususModel
            ->select("YEAR(created_at) as tahun, COUNT(*) as jumlah")
            ->where('YEAR(created_at) >=', $tahunMulai)
            ->where('YEAR(created_at) <=', $tahunSelesai)
            ->groupBy('tahun')
            ->findAll();

        $tahunanData = [];
        for ($year = $tahunMulai; $year <= $tahunSelesai; $year++) {
            $tahunanData[$year] = 0;
        }

        foreach (array_merge($regulerTahunanRaw, $khususTahunanRaw) as $item) {
            $year = (int)$item['tahun'];
            $tahunanData[$year] += (int)$item['jumlah'];
        }

        return view('admin/dashboard/index', [
            'totalPemesanan' => $totalPemesanan,
            'pemesananSelesai' => $pemesananSelesai,
            'pemesananProses' => $pemesananProses,
            'totalPendapatan' => $totalPendapatan,
            'pemesananDitolak' => $pemesananDitolak,
            'mingguanData' => $mingguanData,
            'bulananData' => $bulananData,
            'tahunanData' => $tahunanData,
        ]);
    }

    private function gabungkanDataBerdasarkanTanggal($data1, $data2, $key, $valueKey = 'jumlah')
    {
        $gabungan = [];

        foreach ($data1 as $item) {
            $gabungan[$item[$key]] = $item[$valueKey];
        }

        foreach ($data2 as $item) {
            if (isset($gabungan[$item[$key]])) {
                $gabungan[$item[$key]] += $item[$valueKey];
            } else {
                $gabungan[$item[$key]] = $item[$valueKey];
            }
        }

        ksort($gabungan);

        $hasil = [];
        foreach ($gabungan as $tgl => $jumlah) {
            $hasil[] = [$key => $tgl, $valueKey => $jumlah];
        }

        return $hasil;
    }
}
