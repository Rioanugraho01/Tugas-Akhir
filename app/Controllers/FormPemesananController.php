<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class FormPemesananController extends BaseController
{
    public function index()
    {
        //
    }

    public function form_pemesanan()
    {
        return view('/user/form/form-pemesanan');
    }
}
