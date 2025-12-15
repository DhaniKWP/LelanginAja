<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKondisiBarang extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kondisi' => [
                'type' => 'SERIAL',
            ],
            'nama_kondisi' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
        ]);

        $this->forge->addKey('id_kondisi', true);
        $this->forge->createTable('kondisi_barang');
    }

    public function down()
    {
        $this->forge->dropTable('kondisi_barang');
    }
}
