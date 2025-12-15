<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTransaksiLelang extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_lelang' => [
                'type' => 'SERIAL',
            ],
            'id_barang' => [
                'type' => 'INT',
            ],
            'tanggal_mulai' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'tanggal_selesai' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'default' => 'aktif',
            ],
        ]);

        $this->forge->addKey('id_lelang', true);
        $this->forge->addForeignKey('id_barang', 'barang', 'id_barang', 'CASCADE', 'CASCADE');

        $this->forge->createTable('transaksi_lelang');
    }

    public function down()
    {
        $this->forge->dropTable('transaksi_lelang');
    }
}
