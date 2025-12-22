<?php

namespace App\Models;
use CodeIgniter\Model;

class PembayaranModel extends Model
{
    protected $table = 'transaksi_pembayaran';
    protected $primaryKey = 'id_bayar';
    protected $allowedFields = ['id_pemenang','id_lelang','metode','bukti_transfer','status','tanggal_bayar'];
}
