<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddIdLelangToPembayaran extends Migration
{
    public function up()
    {
        $this->forge->addColumn('transaksi_pembayaran', [
            'id_lelang' => [
                'type' => 'INT',
                'after' => 'id_pemenang',
            ],
        ]);

        // optional tapi SANGAT DISARANKAN
        $this->db->query(
            'ALTER TABLE transaksi_pembayaran
             ADD CONSTRAINT unique_pembayaran_per_lelang
             UNIQUE (id_pemenang, id_lelang)'
        );
    }

    public function down()
    {
        $this->db->query(
            'ALTER TABLE transaksi_pembayaran
             DROP CONSTRAINT IF EXISTS unique_pembayaran_per_lelang'
        );

        $this->forge->dropColumn('transaksi_pembayaran', 'id_lelang');
    }
}
