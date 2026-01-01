<?php

namespace App\Models;
use CodeIgniter\Model;

class TransaksiPemenangModel extends Model
{
    protected $table = 'transaksi_pemenang';
    protected $primaryKey = 'id_pemenang';

    protected $allowedFields = [
        'id_lelang',
        'id_user',
        'harga_menang',
        'tanggal_menang'
    ];

    protected $useTimestamps = false;
}
