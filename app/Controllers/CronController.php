<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PemesananModel;

class CronController extends BaseController
{
    protected $pemesananModel;

    public function __construct()
    {
        $this->pemesananModel = new PemesananModel();
    }

    public function kirimWAHMinus1()
    {
        $besok = date('Y-m-d', strtotime('+1 day'));

        $dataPemesanan = $this->pemesananModel
            ->where('tanggal_pengambilan', $besok)
            ->findAll();

        if (!$dataPemesanan) {
            echo "Tidak ada pemesanan untuk besok.\n";
            return;
        }

        foreach ($dataPemesanan as $pemesanan) {
            $nama = $pemesanan['nama_pemesan'] ?? 'Customer';
            $tanggal = date('d-m-Y', strtotime($pemesanan['tanggal_pengambilan']));
            $pesan = "Pengingat: Pemesanan atas nama *$nama* akan diambil besok ($tanggal). Harap disiapkan.";

            $this->kirimWAkeAdmin($pesan);
        }

        echo "Notifikasi H-1 telah dikirim ke admin.\n";
    }

    private function kirimWAkeAdmin($pesan)
    {
        $nomorAdmin = '6282337406335';
        $apiToken = 'cb6doqhkmo7LPsacZTrB';
        $apiUrl = 'https://api.fonnte.com/send';

        $data = [
            'target' => $nomorAdmin,
            'message' => $pesan,
        ];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $apiUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_HTTPHEADER => [
                "Authorization: $apiToken"
            ],
        ]);

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($httpCode == 200) {
            log_message('info', 'WA H-1 berhasil dikirim: ' . $pesan);
            return true;
        } else {
            log_message('error', 'Gagal kirim WA H-1: ' . $response);
            return false;
        }
    }
}
