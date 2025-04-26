<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class PemesananController extends BaseController
{
    public function index()
    {
        //
    }

    public function pemesanan()
    {
        return view('/user/booking/pemesanan');
    }
}
