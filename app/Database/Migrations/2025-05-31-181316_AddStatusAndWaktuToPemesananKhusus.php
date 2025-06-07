<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddStatusAndWaktuToPemesananKhusus extends Migration
{
    public function up()
    {
        $fields = [
            'status_pemesanan' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'default'    => 'pending',
                'after'      => 'catatan',
            ],
            'status_pembayaran' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'default'    => 'belum_dibayar',
                'after'      => 'status_pemesanan',
            ],
            'waktu_pemesanan' => [
                'type'       => 'TIME',
                'null'       => true,
                'after'      => 'tanggal_pemesanan',
            ],
        ];
        $this->forge->addColumn('pemesanan_khusus', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('pemesanan_khusus', 'status_pemesanan');
        $this->forge->dropColumn('pemesanan_khusus', 'status_pembayaran');
        $this->forge->dropColumn('pemesanan_khusus', 'waktu_pemesanan');
    }
}