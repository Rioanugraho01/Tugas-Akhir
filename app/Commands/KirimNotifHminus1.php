<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use App\Models\PemesananModel;

class KirimNotifHminus1 extends BaseCommand
{
    protected $group       = 'Notifikasi';
    protected $name        = 'kirim:wa-hminus1';
    protected $description = 'Kirim WA ke admin untuk pemesanan yang H-1';

    public function run(array $params)
    {
        $model = new PemesananModel();
        $tomorrow = date('Y-m-d', strtotime('+1 day'));

        $pemesananBesok = $model->where('tanggal_pengambilan', $tomorrow)->findAll();

        foreach ($pemesananBesok as $p) {
            $pesan = "Reminder: Pemesanan dari *{$p['nama']}* (ID #{$p['id']}) akan diambil besok tanggal *{$p['tanggal_pengambilan']}*. Harap dipersiapkan.";

            $this->kirimWA($pesan);
        }

        CLI::write('Notifikasi WA untuk H-1 telah dikirim.', 'green');
    }

    private function kirimWA($pesan)
    {
        $nomorAdmin = '6282337406335';
        $apiToken = 'cb6doqhkmo7LPsacZTrB';
        $apiUrl = 'https://api.fonnte.com/send';

        $data = [
            'target' => $nomorAdmin,
            'message' => $pesan,
        ];

        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: $apiToken"
        ]);

        $response = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($status == 200) {
            log_message('info', "WA terkirim: $pesan");
        } else {
            log_message('error', "Gagal kirim WA: $response");
        }
    }
}
