<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RemoveFieldsFromBarang extends Migration
{
    public function up()
    {
        $this->forge->dropColumn('barang', ['tanggal_mulai', 'tanggal_selesai', 'status']);
    }

    public function down()
    {
        // Opsional, jika ingin rollback
        $this->forge->addColumn('barang', [
            'tanggal_mulai' => ['type' => 'TIMESTAMP', 'null' => true],
            'tanggal_selesai' => ['type' => 'TIMESTAMP', 'null' => true],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'default'    => 'nonaktif'
            ]
        ]);
    }
}
