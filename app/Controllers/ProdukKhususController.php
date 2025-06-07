<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;
use App\Models\ProdukModel;
use App\Models\MacamProdukModel;

class ProdukKhususController extends BaseController
{
    public function produk_khusus()
    {
        $produkModel = new ProdukModel();
        $data['produk'] = $produkModel->where('kategori', 'khusus')->findAll();
        $data['kategori'] = 'khusus';
        return view('/user/produk/produk-khusus', $data);
    }
}
