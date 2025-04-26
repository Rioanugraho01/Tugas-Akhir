<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class TentangKamiController extends BaseController
{
    public function index()
    {
        //
    }

    public function tentang()
    {
        return view('/user/about-us/tentang-kami');
    }
}
