<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateTransaksiPembayaran extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_bayar' => [
                'type' => 'SERIAL',
            ],
            'id_pemenang' => [
                'type' => 'INT',
                'null' => false,
            ],
            'metode' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'bukti_transfer' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'default' => 'pending',
            ],
            'tanggal_bayar' => [
                'type' => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP')
            ],
        ]);

        $this->forge->addKey('id_bayar', true);
        $this->forge->addForeignKey('id_pemenang', 'transaksi_pemenang', 'id_pemenang', 'CASCADE', 'CASCADE');

        $this->forge->createTable('transaksi_pembayaran');
    }

    public function down()
    {
        $this->forge->dropTable('transaksi_pembayaran');
    }
}
