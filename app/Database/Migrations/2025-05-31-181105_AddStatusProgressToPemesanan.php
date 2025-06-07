<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddStatusProgressToPemesanan extends Migration
{
    public function up()
    {
        $this->forge->addColumn('pemesanan', [
            'status_progress' => [
                'type'       => 'ENUM',
                'constraint' => ['proses pembuatan', 'proses packing', 'siap diambil', 'selesai'],
                'default'    => 'proses pembuatan',
                'after'      => 'status_pembayaran',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('pemesanan', 'status_progress');
    }
}