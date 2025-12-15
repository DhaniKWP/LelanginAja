<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTransaksiRegistrasi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_reg' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_user' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'tanggal_daftar' => [
                'type' => 'TIMESTAMP',
                'null' => false,
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'default'    => 'pending',
            ],
        ]);

        $this->forge->addKey('id_reg', true);
        $this->forge->addForeignKey(
            'id_user',
            'users',
            'id_user',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->createTable('transaksi_registrasi');
    }

    public function down()
    {
        $this->forge->dropTable('transaksi_registrasi');
    }
}
