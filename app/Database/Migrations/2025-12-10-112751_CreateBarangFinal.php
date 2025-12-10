<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateBarangFinal extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_barang' => ['type' => 'SERIAL'],
            'nama_barang' => ['type' => 'VARCHAR', 'constraint' => 150],
            'nama_kategori' => ['type' => 'VARCHAR', 'constraint' => 50],
            'kondisi_id' => ['type' => 'INT'],
            'id_user' => ['type' => 'INT'],
            'harga_awal' => ['type' => 'INT'],
            'deskripsi' => ['type' => 'TEXT'],
            'foto' => ['type' => 'VARCHAR', 'constraint' => 255],

            'tanggal_pengajuan' => [
                'type'    => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP'),
            ],

            'status_pengajuan' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'default'    => 'pending'
            ],

            'tanggal_mulai' => ['type' => 'TIMESTAMP', 'null' => true],
            'tanggal_selesai' => ['type' => 'TIMESTAMP', 'null' => true],

            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'default'    => 'nonaktif'
            ]
        ]);

        $this->forge->addKey('id_barang', true);
        $this->forge->addForeignKey('kondisi_id', 'kondisi_barang', 'id_kondisi', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_user', 'users', 'id_user', 'CASCADE', 'CASCADE');

        $this->forge->createTable('barang');
    }

    public function down()
    {
        $this->forge->dropTable('barang');
    }
}
