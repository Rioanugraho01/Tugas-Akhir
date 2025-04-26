<?php

namespace App\Controllers;

use App\Models\ProdukModel;

class TugasAkhir extends BaseController
{
    public function index()
    {
        $produkModel = new ProdukModel();
        $data['produk'] = $produkModel->where('kategori', 'regular')->findAll();

        return view('user/beranda/index', $data);
    }

    // Fungsi lain...
}
