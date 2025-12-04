<?php

namespace App\Models;
use CodeIgniter\Model;

class TransaksiRegistrasiModel extends Model
{
    protected $table = 'transaksi_registrasi';
    protected $primaryKey = 'id_reg';
    protected $allowedFields = ['id_user','tanggal_daftar','status'];
}
