<?php

namespace App\Controllers;

use App\Models\ProdukModel;

class TugasAkhirController extends BaseController
{
    public function index()
    {
        $produkModel = new ProdukModel();
        $data['produk'] = $produkModel->where('kategori', 'regular')->findAll();

        return view('user/beranda/index', $data);
    }
}
