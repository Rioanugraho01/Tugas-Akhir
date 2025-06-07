<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PemesananModel;
use App\Models\PemesananKhususModel;
use App\Models\MacamProdukModel;

class RiwayatPemesananController extends BaseController
{
    public function riwayat_pemesanan()
    {
        $pemesananRegularModel = new PemesananModel();
        $pemesananKhususModel = new PemesananKhususModel();

        $keyword = $this->request->getGet('search');
        $kategori = $this->request->getGet('kategori');
        $tanggalAwal = $this->request->getGet('date_from');
        $tanggalAkhir = $this->request->getGet('date_to');

        $data['pemesanan_regular'] = [];
        $data['pemesanan_khusus'] = [];

        if ($kategori !== 'khusus') {
            $builder = $pemesananRegularModel
                ->select('pemesanan.*, produk.nama AS nama_produk, macam_produk.nama AS nama_macam, users.username')
                ->join('produk', 'produk.id = pemesanan.produk_id')
                ->join('macam_produk', 'macam_produk.id = pemesanan.macam_produk_id')
                ->join('users', 'users.id = pemesanan.user_id'); 

            if ($keyword) {
                $builder->groupStart()
                    ->like('pemesanan.nama', $keyword)
                    ->orLike('produk.nama', $keyword)
                    ->orLike('macam_produk.nama', $keyword)
                    ->orLike('users.username', $keyword)
                    ->groupEnd();
            }

            if ($tanggalAwal && $tanggalAkhir) {
                $builder->where('pemesanan.created_at >=', $tanggalAwal . ' 00:00:00')
                    ->where('pemesanan.created_at <=', $tanggalAkhir . ' 23:59:59');
            }

            $data['pemesanan_regular'] = $builder->orderBy('pemesanan.created_at', 'ASC')->findAll();
        }

        if ($kategori !== 'regular') {
            $builderKhusus = $pemesananKhususModel->builder();

            $builderKhusus->select('pemesanan_khusus.*, users.username')
                ->join('users', 'users.id = pemesanan_khusus.user_id');

            if ($keyword) {
                $builderKhusus->groupStart()
                    ->like('pemesanan_khusus.nama', $keyword)
                    ->orLike('pemesanan_khusus.produk', $keyword)
                    ->orLike('users.username', $keyword)
                    ->groupEnd();
            }

            if ($tanggalAwal && $tanggalAkhir) {
                $builderKhusus->where('pemesanan_khusus.created_at >=', $tanggalAwal . ' 00:00:00')
                    ->where('pemesanan_khusus.created_at <=', $tanggalAkhir . ' 23:59:59');
            }

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

            $data['pemesanan_khusus'] = $builderKhusus->orderBy('pemesanan_khusus.created_at', 'ASC')->get()->getResultArray();
        }

        return view('admin/riwayat-pemesanan/index', $data);
    }
}
