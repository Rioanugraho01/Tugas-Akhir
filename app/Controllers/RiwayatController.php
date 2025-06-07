<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PemesananModel;
use App\Models\PemesananKhususModel;
use App\Models\MacamProdukModel;

class RiwayatController extends BaseController
{
    protected $pemesananModel;
    protected $pemesananKhususModel;

    public function __construct()
    {
        $this->pemesananModel = new PemesananModel();
        $this->pemesananKhususModel = new PemesananKhususModel();
    }

    public function riwayat()
    {
        $userId = session()->get('user_id');
        $filterJenis = $this->request->getGet('filter_jenis') ?? 'reguler';
        $filterTanggal = $this->request->getGet('filter_tanggal');

        $pemesananModel = new \App\Models\PemesananModel();
        $riwayat_reguler = $pemesananModel
            ->where('user_id', $userId);

        if ($filterTanggal) {
            $riwayat_reguler->where('DATE(tanggal_pemesanan)', $filterTanggal);
        }

        $riwayat_reguler = $riwayat_reguler
            ->orderBy('id', 'ASC')
            ->findAll();

        $pemesananKhususModel = new \App\Models\PemesananKhususModel();
        $pemesanan_khusus = $pemesananKhususModel
            ->where('user_id', $userId);

        if ($filterTanggal) {
            $pemesanan_khusus->where('DATE(tanggal_pemesanan)', $filterTanggal);
        }

        $pemesanan_khusus = $pemesanan_khusus
            ->orderBy('id_pemesanan', 'ASC')
            ->findAll();

        $macamProdukModel = new MacamProdukModel();

        $macamProdukIds = $this->request->getPost('macam_produk');
        $jumlahProduk = $this->request->getPost('jumlah');

        $macamProdukStrings = [];

        if (is_array($macamProdukIds) && is_array($jumlahProduk)) {
            foreach ($macamProdukIds as $index => $id) {
                $produk = $macamProdukModel->find($id);
                if ($produk) {
                    $nama = $produk['nama'];
                    $qty = isset($jumlahProduk[$index]) ? intval($jumlahProduk[$index]) : 0;
                    if ($qty > 0) {
                        $macamProdukStrings[] = $nama . " x" . $qty;
                    }
                }
            }
        }

        $macamProdukString = implode(", ", $macamProdukStrings);

        return view('user/history-transaksi/riwayat', [
            'riwayat_reguler' => $riwayat_reguler,
            'pemesanan_khusus' => $pemesanan_khusus,
            'filterJenis' => $filterJenis,
            'filterTanggal' => $filterTanggal,
        ]);
    }
}
