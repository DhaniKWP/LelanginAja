<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ReorderKategoriBarangOnBarang extends Migration
{
    public function up()
    {
        // Tambah kolom sementara setelah nama_barang
        $this->forge->addColumn('barang', [
            'kategori_new' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
        ]);

        // Copy data kategori_barang lama ke kolom baru (meskipun kosong tidak masalah)
        $this->db->query("UPDATE barang SET kategori_new = kategori_barang");

        // Hapus kolom lama
        $this->forge->dropColumn('barang','kategori_barang');

        // Ganti nama kolom baru ke kategori_barang
        $this->db->query("ALTER TABLE barang RENAME COLUMN kategori_new TO kategori_barang");
    }

    public function down()
    {
        // Kembalikan posisi ke akhir kalau rollback

        // Tambah kolom lama
        $this->forge->addColumn('barang', [
            'kategori_old' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
        ]);

        $this->db->query("UPDATE barang SET kategori_old = kategori_barang");

        // Hapus kategori_barang (versi baru)
        $this->forge->dropColumn('barang','kategori_barang');

        // Rename kembali
        $this->db->query("ALTER TABLE barang RENAME COLUMN kategori_old TO kategori_barang");
    }
}
