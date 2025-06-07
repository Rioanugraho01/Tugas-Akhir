<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KetersediaanModel;
use CodeIgniter\I18n\Time;

class KalenderController extends BaseController
{
    public function kalender()
    {
        $bulan = $this->request->getVar('bulan') ?? date('m');
        $tahun = $this->request->getVar('tahun') ?? date('Y');

        $ketersediaanModel = new KetersediaanModel();
        $ketersediaan = $ketersediaanModel->getKetersediaanBulanTahun($bulan, $tahun);

        return view('user/penjadwalan/kalender', [
            'ketersediaan' => $ketersediaan,
            'bulan' => $bulan,
            'tahun' => $tahun
        ]);
    }
}


