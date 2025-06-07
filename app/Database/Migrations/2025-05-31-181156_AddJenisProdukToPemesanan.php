<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddJenisProdukToPemesanan extends Migration
{
    public function up()
    {
        $fields = [
            'jenis_produk' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'default' => 'regular',
                'null' => false,
            ],
        ];

        $this->forge->addColumn('pemesanan', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('pemesanan', 'jenis_produk');
    }
}