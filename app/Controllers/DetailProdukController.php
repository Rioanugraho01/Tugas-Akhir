<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProdukModel;
use App\Models\MacamProdukModel;

class DetailProdukController extends BaseController
{
    public function detail_produk($id)
    {
        $produkModel = new ProdukModel();
        $macamProdukModel = new MacamProdukModel();

        $produk = $produkModel->find($id);

        if (!$produk) {
            return redirect()->to('/produk')->with('error', 'Produk tidak ditemukan');
        }

        $macamProduk = $macamProdukModel->getByProdukId($id);

        return view('user/macam-produk/produk-macam', [
            'produk' => $produk,
            'macamProduk' => $macamProduk
        ]);
    }
}
