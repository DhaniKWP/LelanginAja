<?php

namespace App\Models;
use CodeIgniter\Model;

class TransaksiPenawaranModel extends Model
{
    protected $table = 'transaksi_penawaran';
    protected $primaryKey = 'id_penawaran';
    protected $allowedFields = ['id_lelang','id_user','harga_penawaran','waktu_penawaran'];
}

