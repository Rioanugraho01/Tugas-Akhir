<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUserIdToFormPemesanan extends Migration
{
    public function up()
    {
        $this->forge->addColumn('form_pemesanan', [
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'after'      => 'id_pemesanan',
                'null'       => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('form_pemesanan', 'user_id');
    }
}