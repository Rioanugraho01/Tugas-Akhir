<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;
use App\Models\ProdukModel;
use App\Models\MacamProdukModel;

class ProdukRegularController extends BaseController
{
    public function index()
    {
        //
    }

    public function produk_regular()
    {
        $produkModel = new ProdukModel();
        $data['produk'] = $produkModel->where('kategori', 'regular')->findAll();
        $data['kategori'] = 'regular';
        return view('/user/produk/produk-regular', $data);
    }

}
