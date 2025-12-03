<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePeserta extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_peserta' => ['type' => 'SERIAL'],
            'id_user' => ['type' => 'INT'],
            'alamat' => ['type' => 'VARCHAR', 'constraint' => 255],
            'no_hp' => ['type' => 'VARCHAR', 'constraint' => 20],
        ]);

        $this->forge->addKey('id_peserta', true);
        $this->forge->addForeignKey('id_user', 'users', 'id_user');
        $this->forge->createTable('peserta');
    }

    public function down()
    {
        $this->forge->dropTable('peserta');
    }
}
