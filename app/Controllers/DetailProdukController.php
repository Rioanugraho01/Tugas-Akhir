<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProdukModel;
use App\Models\MacamProdukModel;

class DetailProdukController extends BaseController
{
    public function index()
    {
        // Halaman index, bisa digunakan untuk pengaturan lain
    }

    public function detail_produk($id)
{
    $produkModel = new ProdukModel();
    $macamProdukModel = new MacamProdukModel();

    // Ambil detail produk
    $produk = $produkModel->find($id);

    // Debug: Cek apakah produk ditemukan
    if (!$produk) {
        return redirect()->to('/produk')->with('error', 'Produk tidak ditemukan');
    }

    // Ambil macam produk terkait dengan produk tersebut
    $macamProduk = $macamProdukModel->getByProdukId($id);

    // Kirim data produk dan macam produk ke view
    return view('user/macam-produk/produk-macam', [
        'produk' => $produk,
        'macamProduk' => $macamProduk
    ]);
}

    
}
