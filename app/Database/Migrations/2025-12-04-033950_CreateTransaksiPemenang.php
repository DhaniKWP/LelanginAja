<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateTransaksiPemenang extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pemenang' => [
                'type' => 'SERIAL',
            ],
            'id_lelang' => [
                'type' => 'INT',
            ],
            'id_user' => [
                'type' => 'INT',
            ],
            'harga_menang' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'tanggal_menang' => [
                'type' => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP'),
            ],
        ]);

        $this->forge->addKey('id_pemenang', true);
        $this->forge->addForeignKey('id_lelang', 'transaksi_lelang', 'id_lelang', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_user', 'users', 'id_user', 'CASCADE', 'CASCADE');

        $this->forge->createTable('transaksi_pemenang');
    }

    public function down()
    {
        $this->forge->dropTable('transaksi_pemenang');
    }
}
