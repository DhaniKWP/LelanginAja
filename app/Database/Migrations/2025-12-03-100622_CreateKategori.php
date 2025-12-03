<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKategori extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kategori' => [
                'type' => 'SERIAL',
            ],
            'nama_kategori' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
        ]);

        $this->forge->addKey('id_kategori', true);
        $this->forge->createTable('kategori');
    }

    public function down()
    {
        $this->forge->dropTable('kategori');
    }
}
