<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUserIdToPemesananKhusus extends Migration
{
    public function up()
    {
        // Tambah kolom user_id sebagai INT, nullable dulu untuk menghindari error data existing
        $fields = [
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
                'after' => 'id_pemesanan', // sesuaikan posisi kolom
            ],
        ];

        $this->forge->addColumn('pemesanan_khusus', $fields);

        // Jika ingin bisa juga tambah index atau foreign key (optional)
        // $this->forge->addKey('user_id');
        // $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->forge->dropColumn('pemesanan_khusus', 'user_id');
    }
}