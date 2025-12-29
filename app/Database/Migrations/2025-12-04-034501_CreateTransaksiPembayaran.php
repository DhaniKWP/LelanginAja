<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTransaksiPembayaran extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_bayar' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],

            'id_pemenang' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],

            'id_lelang' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],

            'metode' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],

            'bukti_transfer' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],

            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'default'    => 'pending',
            ],

            'tanggal_bayar' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
        ]);

        $this->forge->addKey('id_bayar', true);

        // UNIQUE (id_pemenang, id_lelang)
        $this->forge->addKey(['id_pemenang', 'id_lelang'], false, true);

        $this->forge->addForeignKey(
            'id_pemenang',
            'transaksi_pemenang',
            'id_pemenang',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->addForeignKey(
            'id_lelang',
            'transaksi_lelang',
            'id_lelang',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->createTable('transaksi_pembayaran');
    }

    public function down()
    {
        $this->forge->dropTable('transaksi_pembayaran');
    }
}
