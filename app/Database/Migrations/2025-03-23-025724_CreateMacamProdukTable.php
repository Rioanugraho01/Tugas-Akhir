<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMacamProdukTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'gambar' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
            'nama'        => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'deskripsi'   => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'harga'       => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => false,
            ],
            'created_at'  => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'updated_at'  => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('macam_produk');
    }

    public function down()
    {
        $this->forge->dropTable('macam_produk');
    }
}
