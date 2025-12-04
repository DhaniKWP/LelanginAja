<?php

namespace App\Models;
use CodeIgniter\Model;

class TransaksiLelangModel extends Model
{
    protected $table = 'transaksi_lelang';
    protected $primaryKey = 'id_lelang';
    protected $allowedFields = ['id_barang','tanggal_mulai','tanggal_selesai','status'];
}
