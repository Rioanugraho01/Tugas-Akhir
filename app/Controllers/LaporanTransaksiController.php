<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class LaporanTransaksiController extends BaseController
{
    public function index()
    {
        //
    }

    public function laporan_transaksi()
    {
        return view('admin/laporan-transaksi');
    }
}
