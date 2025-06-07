<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddWaktuPemesananToFormPemesanan extends Migration
{
    public function up()
    {
        $fields = [
            'waktu_pemesanan' => [
                'type' => 'TIME',
                'null' => false,
                'default' => '00:00:00',
            ],
        ];
        $this->forge->addColumn('form_pemesanan', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('form_pemesanan', 'waktu_pemesanan');
    }
}