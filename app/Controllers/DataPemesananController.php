<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class DataPemesananController extends BaseController
{
    public function index()
    {
        //
    }

    public function data_pemesanan()
    {
        return view('admin/data-pemesanan');
    }
}
