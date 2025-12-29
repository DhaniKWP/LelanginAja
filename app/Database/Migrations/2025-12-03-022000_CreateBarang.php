<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBarang extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_barang' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],

            'nama_barang' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],

            'nama_kategori' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],

            'kondisi_id' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],

            'id_user' => [
                'type'     => 'INT',
                'unsigned' => true,
            ],

            'harga_awal' => [
                'type' => 'INT',
            ],

            'deskripsi' => [
                'type' => 'TEXT',
            ],

            'foto' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],

            'tanggal_pengajuan' => [
                'type' => 'DATETIME',
                'null' => false,
            ],

            'status_pengajuan' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'default'    => 'pending',
            ],
        ]);

        $this->forge->addKey('id_barang', true);

        $this->forge->addForeignKey(
            'kondisi_id',
            'kondisi_barang',
            'id_kondisi',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->addForeignKey(
            'id_user',
            'users',
            'id_user',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->createTable('barang');
    }

    public function down()
    {
        $this->forge->dropTable('barang');
    }
}
