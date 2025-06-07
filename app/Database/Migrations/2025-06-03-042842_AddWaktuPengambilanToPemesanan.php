<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddWaktuPengambilanToPemesanan extends Migration
{
    public function up()
    {
        $this->forge->addColumn('pemesanan', [
            'waktu_pengambilan' => [
                'type'       => 'TIME',
                'null'       => true,
                'after'      => 'tanggal_pengambilan'
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('pemesanan', 'waktu_pengambilan');
    }
}
