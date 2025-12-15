<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePeserta extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_peserta' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_user' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],
            'alamat' => [
                'type' => 'TEXT',
            ],
            'no_hp' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'is_active' => [
                'type'    => 'BOOLEAN',
                'default' => false,
            ],
            'tanggal_disetujui' => [
                'type' => 'TIMESTAMP',
                'null' => true, // WAJIB nullable
            ],
        ]);

        $this->forge->addKey('id_peserta', true);
        $this->forge->addForeignKey(
            'id_user',
            'users',
            'id_user',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->createTable('peserta');
    }

    public function down()
    {
        $this->forge->dropTable('peserta');
    }
}
