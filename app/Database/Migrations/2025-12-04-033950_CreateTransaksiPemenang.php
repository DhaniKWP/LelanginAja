<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTransaksiPemenang extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pemenang' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],

            'id_lelang' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],

            'id_user' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],

            'harga_menang' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
            ],

            'tanggal_menang' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
        ]);

        $this->forge->addKey('id_pemenang', true);

        $this->forge->addForeignKey(
            'id_lelang',
            'transaksi_lelang',
            'id_lelang',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->addForeignKey(
            'id_user',
            'users',
            'id_user',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->createTable('transaksi_pemenang');
    }

    public function down()
    {
        $this->forge->dropTable('transaksi_pemenang');
    }
}
