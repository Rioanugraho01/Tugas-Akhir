<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class RiwayatController extends BaseController
{

    public function riwayat()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/user/autentikasi/login')->with('error', 'Silakan login terlebih dahulu untuk melihat riwayat.');
        }
        return view('/user/history-transaksi/riwayat');
    }
}
