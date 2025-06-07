<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProdukTable extends Migration
{
    public function up()
{
    $this->forge->addField([
        'id' => [
            'type' => 'INT',
            'constraint' => 11,
            'unsigned' => true,
            'auto_increment' => true,
        ],
        'gambar' => [
            'type' => 'VARCHAR',
            'constraint' => 255,
            'null' => false,
        ],
        'nama' => [
            'type' => 'VARCHAR',
            'constraint' => 255,
            'null' => false,
        ],
        'deskripsi' => [
            'type' => 'TEXT',
            'null' => false,
        ],
        'kategori' => [
            'type' => 'ENUM',
            'constraint' => ['regular', 'khusus'],
            'null' => false,
        ],
        'created_at' => [
            'type' => 'DATETIME',
            'null' => true,
        ],
        'updated_at' => [
            'type' => 'DATETIME',
            'null' => true,
        ],
    ]);

    $this->forge->addPrimaryKey('id');
    $this->forge->createTable('produk');
}


    public function down()
    {
        $this->forge->dropTable('produk');
    }
}
