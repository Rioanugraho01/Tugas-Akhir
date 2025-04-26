<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKetersediaanJadwal extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'       => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'tanggal'  => [
                'type' => 'DATE',
            ],
            'status'   => [
                'type'    => 'ENUM',
                'constraint' => ['tersedia', 'penuh'],
                'default' => 'tersedia',
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('ketersediaan_jadwal');
    }

    public function down()
    {
        $this->forge->dropTable('ketersediaan_jadwal');
    }
}
