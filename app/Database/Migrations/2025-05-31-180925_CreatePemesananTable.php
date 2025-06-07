<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePemesananTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                   => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'produk_id'            => ['type' => 'INT', 'unsigned' => true, 'null' => false],
            'macam_produk_id'      => ['type' => 'INT', 'unsigned' => true, 'null' => false],
            'nama'                 => ['type' => 'VARCHAR', 'constraint' => 255],
            'no_hp'                => ['type' => 'VARCHAR', 'constraint' => 20],
            'macam_produk'         => ['type' => 'TEXT', 'null' => true],
            'total_harga'          => ['type' => 'INT', 'null' => false],
            'jumlah_dp'            => ['type' => 'INT', 'null' => true],
            'sisa_pembayaran'      => ['type' => 'INT', 'null' => true],
            'persentase_dp'        => ['type' => 'DECIMAL', 'constraint' => '5,2', 'null' => true],
            'tanggal_pemesanan'    => ['type' => 'DATE', 'null' => true],
            'tanggal_pengambilan'  => ['type' => 'DATE', 'null' => true],
            'jenis_pembayaran'     => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'catatan'              => ['type' => 'TEXT', 'null' => true],
            'status_pemesanan'     => ['type' => 'VARCHAR', 'constraint' => 50, 'default' => 'pending'],
            'status_pembayaran'    => ['type' => 'VARCHAR', 'constraint' => 100, 'default' => 'belum bayar'],
            'bukti_pembayaran'     => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'created_at'           => ['type' => 'DATETIME', 'null' => true],
            'updated_at'           => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('produk_id', 'produk', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('macam_produk_id', 'macam_produk', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pemesanan');
    }

    public function down()
    {
        $this->forge->dropTable('pemesanan');
    }
}