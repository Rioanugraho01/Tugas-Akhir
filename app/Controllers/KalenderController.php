<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KetersediaanModel;
use CodeIgniter\I18n\Time;

class KalenderController extends BaseController
{
    public function kalender()
    {
        // Ambil bulan dan tahun yang dipilih dari query string atau default ke bulan dan tahun saat ini
        $bulan = $this->request->getVar('bulan') ?? date('m');
        $tahun = $this->request->getVar('tahun') ?? date('Y');

        // Ambil data ketersediaan berdasarkan bulan dan tahun
        $ketersediaanModel = new KetersediaanModel();
        $ketersediaan = $ketersediaanModel->getKetersediaanBulanTahun($bulan, $tahun);

        // Kirimkan data ke view
        return view('user/penjadwalan/kalender', [
            'ketersediaan' => $ketersediaan,
            'bulan' => $bulan,
            'tahun' => $tahun
        ]);
    }
}


