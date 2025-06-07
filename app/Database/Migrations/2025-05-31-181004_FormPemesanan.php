<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FormPemesanan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pemesanan' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'auto_increment' => true,
                'unsigned'       => true,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'nomor_hp' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'nama_acara' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'produk' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'tanggal_pemesanan' => [
                'type' => 'DATE',
            ],
            'jumlah_tamu' => [
                'type'       => 'INT',
                'constraint' => 5,
            ],
            'pembayaran' => [
                'type'       => 'INT',
                'constraint' => 2,
                'comment'    => 'Nilai hanya boleh 10, 20, atau 30 (persen)',
            ],
            'catatan' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ]
        ]);

        $this->forge->addKey('id_pemesanan', true);
        $this->forge->createTable('form_pemesanan');
    }

    public function down()
    {
        $this->forge->dropTable('form_pemesanan');
    }
}