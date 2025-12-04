<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateTransaksiRegistrasi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_reg' => [
                'type' => 'SERIAL',
                'null' => false,
            ],
            'id_user' => [
                'type' => 'INT',
                'null' => false,
            ],
            'tanggal_daftar' => [
                'type' => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP')
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'default' => 'aktif',
            ],
        ]);

        $this->forge->addKey('id_reg', true);
        $this->forge->addForeignKey('id_user', 'users', 'id_user', 'CASCADE', 'CASCADE');

        $this->forge->createTable('transaksi_registrasi');
    }

    public function down()
    {
        $this->forge->dropTable('transaksi_registrasi');
    }
}
