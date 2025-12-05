<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'id_barang';

    protected $allowedFields = [
        'nama_barang','kategori_id','kondisi_id','id_user',
        'harga_awal','deskripsi','foto','tanggal_pengajuan',
        'status_pengajuan','status'
    ];

    protected $useTimestamps = false;
}
