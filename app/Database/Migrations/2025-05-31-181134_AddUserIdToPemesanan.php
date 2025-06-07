<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUserIdToPemesanan extends Migration
{
    public function up()
    {
        $fields = [
            'user_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'after' => 'id', // kolom user_id akan diletakkan setelah kolom id
                'null' => false,
            ],
        ];

        $this->forge->addColumn('pemesanan', $fields);

        // Tambahkan foreign key user_id ke tabel users
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        // Drop foreign key dulu sebelum drop kolom
        $this->forge->dropForeignKey('pemesanan', 'pemesanan_user_id_foreign');

        // Drop kolom user_id
        $this->forge->dropColumn('pemesanan', 'user_id');
    }
}